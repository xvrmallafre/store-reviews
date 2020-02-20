<?php

namespace Xvrmallafre\StoreReviews\Controller\Adminhtml\Review;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Xvrmallafre\StoreReviews\Model\Review;

/**
 * Class Edit
 *
 * @package Xvrmallafre\StoreReviews\Controller\Adminhtml\Review
 */
class Edit extends \Xvrmallafre\StoreReviews\Controller\Adminhtml\Review
{
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('review_id');
        $model = $this->_objectManager->create(Review::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);

            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Review no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('store_review', $model);

        // 3. Build edit form
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Review') : __('New Review'),
            $id ? __('Edit Review') : __('New Review')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Reviews'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __(
            'Edit Review %1',
            $model->getId()
        ) : __('New Review'));

        return $resultPage;
    }
}
