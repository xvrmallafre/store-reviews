<?php

namespace Xvrmallafre\StoreReviews\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Review
 *
 * @package Xvrmallafre\StoreReviews\Model\ResourceModel
 */
class Review extends AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('store_reviews', 'review_id');
    }
}

