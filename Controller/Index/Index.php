<?php

namespace Xvrmallafre\StoreReviews\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Xvrmallafre\StoreReviews\Model\Config;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Controller\Index
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
     * @var Config
     */
    protected $config;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param UrlInterface $url
     * @param Config $config
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        UrlInterface $url,
        Config $config
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);

        $this->url = $url;
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
            return $this->resultPageFactory->create();
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setUrl($noRouteUrl);
    }
}
