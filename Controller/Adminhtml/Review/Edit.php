<?php

namespace Xvrmallafre\StoreReviews\Controller\Adminhtml\Review;

/**
 * Class Edit
 *
 * @package Xvrmallafre\StoreReviews\Controller\Adminhtml\Review
 */
class Edit extends \Xvrmallafre\StoreReviews\Controller\Adminhtml\Review
{
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('review_id');
        $model = $this->_objectManager->create(\Xvrmallafre\StoreReviews\Model\Review::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Review no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('xvrmallafre_storereviews_review', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Review') : __('New Review'),
            $id ? __('Edit Review') : __('New Review')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Reviews'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Review %1', $model->getId()) : __('New Review'));
        return $resultPage;
    }
}
