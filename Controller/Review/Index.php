<?php

namespace Xvrmallafre\StoreReviews\Controller\Review;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Controller\Review
 */
class Index extends Action
{
    protected $resultPageFactory;

    protected $url;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param UrlInterface $url
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        UrlInterface $url
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);

        $this->url = $url;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $norouteUrl = $this->url->getUrl('noroute');

        if (in_array('hash', $params)) {
            //TODO: filter the hash to the collection. If hash exists and not submited already, load the page.
            // if not, redirect to a 404 page.

            return $this->resultPageFactory->create();
        }


        return $this->getResponse()->setRedirect($norouteUrl);
    }
}
