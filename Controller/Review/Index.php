<?php

namespace Xvrmallafre\StoreReviews\Controller\Review;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
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
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param UrlInterface $url
     * @param ReviewCollectionFactory $reviewCollection
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        UrlInterface $url,
        ReviewCollectionFactory $reviewCollection
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);

        $this->url = $url;
        $this->reviewCollection = $reviewCollection;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        //return $this->resultPageFactory->create();
        $params = $this->getRequest()->getParams();
        $noRouteUrl = $this->url->getUrl('noroute');

        if (array_key_exists(ReviewInterface::HASH, $params)) {
            $collection = $this->reviewCollection->create();
            $collection->addFieldToFilter(ReviewInterface::HASH, $params[ReviewInterface::HASH])
                ->addFieldToFilter(ReviewInterface::IS_MSG_SENT, ['eq' => true])
                ->addFieldToFilter(ReviewInterface::SUBMITTED_AT, ['null' => true]);
            if ($collection->getSize() === 1) {
                return $this->resultPageFactory->create();
            }
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setUrl($noRouteUrl);
    }
}
