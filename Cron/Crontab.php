<?php

namespace Xvrmallafre\StoreReviews\Cron;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\UrlInterface;
use Magento\Sales\Model\OrderRepository;
use Psr\Log\LoggerInterface;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterface;
use Xvrmallafre\StoreReviews\Model\Config;
use Xvrmallafre\StoreReviews\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;

/**
 * Class Crontab
 *
 * @package Xvrmallafre\StoreReviews\Cron
 */
class Crontab
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var ReviewCollectionFactory
     */
    protected $reviewCollection;

    /**
     * @var DateTime
     */
    protected $dateTime;
    /**
     * @var UrlInterface
     */
    protected $url;
    /**
     * @var Config
     */
    protected $config;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     * @param TransportBuilder $transportBuilder
     * @param OrderRepository $order
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ReviewCollectionFactory $reviewCollection
     * @param DateTime $dateTime
     * @param UrlInterface $url
     * @param Config $config
     */
    public function __construct(
        LoggerInterface $logger,
        TransportBuilder $transportBuilder,
        OrderRepository $order,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ReviewCollectionFactory $reviewCollection,
        DateTime $dateTime,
        UrlInterface $url,
        Config $config
    ) {
        $this->logger = $logger;
        $this->transportBuilder = $transportBuilder;
        $this->orderRepository = $order;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->reviewCollection = $reviewCollection;
        $this->dateTime = $dateTime;
        $this->url = $url;
        $this->config = $config;
    }

    /**
     * Execute the cron
     *
     * @return void
     * @throws LocalizedException
     * @throws MailException
     */
    public function execute()
    {
        if ($this->config->isEnabled()) {
            $days = $this->config->offsetDaysSendEmail();
            $offsetDate = $this->createDate($this->dateTime->gmtDate(), $days);

            $reviewCollection = $this->reviewCollection->create();
            $reviewCollection->addFieldToFilter(ReviewInterface::IS_MSG_SENT, ['eq' => false])
                ->addFieldToFilter(ReviewInterface::SUBMITTED_AT, ['null' => true])
                ->addFieldToFilter('created_at', ['lt' => $offsetDate]);

            foreach ($reviewCollection as $review) {
                if ($this->sendReviewEmail(
                    $review->getIncrementId(),
                    $this->getReviewUrlWithHash($review->getHash())
                )
                ) {
                    $review->setIsMsgSent(true);
                    $review->save();
                }
            }
        }
    }

    /**
     * @param $now
     * @param int $days
     * @return false|string
     */
    protected function createDate($now, int $days)
    {
        return date('Y-m-d H:i:s', strtotime($now . ' -' . $days . ' days'));
    }

    /**
     * @param string $incrementId
     * @param string $url
     * @return $this
     * @throws LocalizedException
     * @throws MailException
     */
    protected function sendReviewEmail(string $incrementId, string $url)
    {
        $orderData = $this->getStoreIdFromOrder($incrementId);

        $transport = $this->transportBuilder->setTemplateIdentifier('storereviews_create_review')
            ->setTemplateOptions(['area' => 'frontend', 'store' => $orderData['store_id']])
            ->setTemplateVars(['hashUrl' => $url])
            ->setFromByScope('general')
            ->addTo($orderData['customer_email'])
            ->getTransport();

        $transport->sendMessage();

        return $this;
    }

    /**
     * @param string $incrementId
     * @return array
     */
    protected function getStoreIdFromOrder(string $incrementId)
    {
        $this->searchCriteriaBuilder->addFilter('increment_id', $incrementId);
        $order = $this->orderRepository->getList(
            $this->searchCriteriaBuilder->create()
        );
        $orderData = $order->getFirstItem()->getData();

        return [
            'store_id' => $orderData['store_id'],
            'customer_email' => $orderData['customer_email']
        ];
    }

    /**
     * @param string $hash
     * @return string
     */
    protected function getReviewUrlWithHash(string $hash)
    {
        return $this->url->getUrl('reviews/review', ['_query' => ['hash' => $hash]]);
    }
}
