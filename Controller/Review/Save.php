<?php

namespace Xvrmallafre\StoreReviews\Controller\Review;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterface;
use Xvrmallafre\StoreReviews\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;

/**
 * Class Save
 *
 * @package Xvrmallafre\StoreReviews\Controller\Review
 */
class Save extends Action
{
    /**
     * @var UrlInterface
     */
    protected $url;

    /**
     * @var ReviewCollectionFactory
     */
    protected $reviewCollection;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * Constructor
     *
     * @param Context $context
     * @param UrlInterface $url
     * @param ReviewCollectionFactory $reviewCollection
     * @param StoreManagerInterface $storeManager
     * @param DateTime $dateTime
     */
    public function __construct(
        Context $context,
        UrlInterface $url,
        ReviewCollectionFactory $reviewCollection,
        StoreManagerInterface $storeManager,
        DateTime $dateTime
    ) {
        parent::__construct($context);

        $this->url = $url;
        $this->reviewCollection = $reviewCollection;
        $this->storeManager = $storeManager;
        $this->dateTime = $dateTime;
    }

    /**
     * Execute view action
     *
     * @return void
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $baseUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_WEB);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);


        if (!$this->hasPostValidFields($post) || !$this->radioValuesAreInRange($post)) {
            $this->messageManager->addErrorMessage(
                __('An error has occurred. Please try again later.')
            );

            return $resultRedirect->setUrl($baseUrl);
        }

        $collection = $this->reviewCollection->create();
        $collection->addFieldToFilter(ReviewInterface::HASH, $post[ReviewInterface::HASH])
            ->addFieldToFilter(ReviewInterface::IS_MSG_SENT, ['eq' => true])
            ->addFieldToFilter(ReviewInterface::SUBMITTED_AT, ['null' => true]);

        if ($collection->getSize() === 1) {
            $review = $collection->getFirstItem();

            if (!array_key_exists(ReviewInterface::COMMENT, $post)) {
                $post[ReviewInterface::COMMENT] = null;
            }

            $post[ReviewInterface::SUBMITTED_AT] = $this->dateTime->gmtDate();
            $post[ReviewInterface::VISIBLE] = true;
            unset($post[ReviewInterface::HASH]);
            unset($post['form_key']);

            $originalData = $review->getOrigData();
            $newData = array_merge($originalData, $post);
            $review->setData($newData);

            $review->save();
        }

        $this->messageManager->addSuccessMessage(
            __('You have successfully submitted your review. Thanks for your time.')
        );

        return $resultRedirect->setUrl($baseUrl);
    }

    /**
     * @param array $post
     * @return bool
     */
    protected function hasPostValidFields(array $post)
    {
        foreach ($this->getFieldsToValidate() as $fieldToValidate) {
            if (!array_key_exists($fieldToValidate, $post)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $post
     * @return bool
     */
    protected function radioValuesAreInRange(array $post)
    {
        $min = 1;
        $max = 5;

        foreach ($this->getRadioFields() as $radioField) {
            if (!(($min <= $post[$radioField]) && ($post[$radioField] <= $max))) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    protected function getRadioFields()
    {
        return [
            ReviewInterface::PRODUCT,
            ReviewInterface::CUSTOMER_SUPPORT,
            ReviewInterface::DELIVERY,
        ];
    }

    /**
     * @return array
     */
    protected function getFieldsToValidate()
    {
        return array_merge($this->getRadioFields(), [ReviewInterface::HASH]);
    }
}
