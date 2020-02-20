<?php

namespace Xvrmallafre\StoreReviews\Controller\Review;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Xvrmallafre\StoreReviews\Model\Config;
use Xvrmallafre\StoreReviews\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterface;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Controller\Review
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * @var ReviewCollectionFactory
     */
    protected $reviewCollection;
    /**
     * @var Config
     */
    private $config;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param UrlInterface $url
     * @param ReviewCollectionFactory $reviewCollection
     * @param Config $config
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        UrlInterface $url,
        ReviewCollectionFactory $reviewCollection,
        Config $config
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);

        $this->url = $url;
        $this->reviewCollection = $reviewCollection;
        $this->config = $config;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $noRouteUrl = $this->url->getUrl('noroute');

        if ($this->config->isEnabled()) {
            $params = $this->getRequest()->getParams();

            if (array_key_exists(ReviewInterface::HASH, $params)) {
                $collection = $this->reviewCollection->create();
                $collection->addFieldToFilter(ReviewInterface::HASH, $params[ReviewInterface::HASH])
                    ->addFieldToFilter(ReviewInterface::IS_MSG_SENT, ['eq' => true])
                    ->addFieldToFilter(ReviewInterface::SUBMITTED_AT, ['null' => true]);
                if ($collection->getSize() === 1) {
                    return $this->resultPageFactory->create();
                }
            }
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setUrl($noRouteUrl);
    }
}
