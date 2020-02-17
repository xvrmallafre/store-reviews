<?php

namespace Xvrmallafre\StoreReviews\Controller\Adminhtml\Review;

use Exception;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Xvrmallafre\StoreReviews\Model\Review;

/**
 * Class Delete
 *
 * @package Xvrmallafre\StoreReviews\Controller\Adminhtml\Review
 */
class Delete extends \Xvrmallafre\StoreReviews\Controller\Adminhtml\Review
{

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('review_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(Review::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Review.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['review_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Review to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

