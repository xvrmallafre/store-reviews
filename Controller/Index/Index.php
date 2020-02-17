<?php

namespace Xvrmallafre\StoreReviews\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Controller\Index
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
        $norouteUrl = $this->url->getUrl('noroute');

        //if (/* StoreConfig is reviews module disabled, redirect to 404 */) {

        //}

        return $this->resultPageFactory->create();
    }
}
