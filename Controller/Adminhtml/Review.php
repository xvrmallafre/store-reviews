<?php

namespace Xvrmallafre\StoreReviews\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Registry;

/**
 * Class Review
 *
 * @package Xvrmallafre\StoreReviews\Controller\Adminhtml
 */
abstract class Review extends Action
{
    const ADMIN_RESOURCE = 'Xvrmallafre_StoreReviews::review';

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE);

        return $resultPage;
    }
}

