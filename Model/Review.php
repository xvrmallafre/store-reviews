<?php

namespace Xvrmallafre\StoreReviews\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterface;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterfaceFactory;
use Xvrmallafre\StoreReviews\Model\ResourceModel\Review\Collection;

/**
 * Class Review
 *
 * @package Xvrmallafre\StoreReviews\Model
 */
class Review extends AbstractModel
{

    protected $reviewDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'store_review';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param ReviewInterfaceFactory $reviewDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\Review $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ReviewInterfaceFactory $reviewDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\Review $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->reviewDataFactory = $reviewDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve review model with review data
     * @return ReviewInterface
     */
    public function getDataModel()
    {
        $reviewData = $this->getData();

        $reviewDataObject = $this->reviewDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $reviewDataObject,
            $reviewData,
            ReviewInterface::class
        );

        return $reviewDataObject;
    }
}

