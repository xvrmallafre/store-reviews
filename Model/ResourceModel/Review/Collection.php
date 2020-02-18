<?php

namespace Xvrmallafre\StoreReviews\Model\ResourceModel\Review;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Xvrmallafre\StoreReviews\Model\ResourceModel\Review;

/**
 * Class Collection
 *
 * @package Xvrmallafre\StoreReviews\Model\ResourceModel\Review
 */
class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'review_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Xvrmallafre\StoreReviews\Model\Review::class,
            Review::class
        );
    }
}

