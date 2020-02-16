<?php

namespace Xvrmallafre\StoreReviews\Controller\Adminhtml;

/**
 * Class Review
 *
 * @package Xvrmallafre\StoreReviews\Controller\Adminhtml
 */
abstract class Review extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Xvrmallafre_StoreReviews::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Xvrmallafre'), __('Xvrmallafre'))
            ->addBreadcrumb(__('Review'), __('Review'));
        return $resultPage;
    }
}

