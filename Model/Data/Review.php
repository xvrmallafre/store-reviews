<?php

namespace Xvrmallafre\StoreReviews\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterface;

/**
 * Class Review
 *
 * @package Xvrmallafre\StoreReviews\Model\Data
 */
class Review extends AbstractExtensibleObject implements ReviewInterface
{

    /**
     * Get review_id
     * @return string|null
     */
    public function getReviewId()
    {
        return $this->_get(self::REVIEW_ID);
    }

    /**
     * Set review_id
     * @param string $reviewId
     * @return ReviewInterface
     */
    public function setReviewId($reviewId)
    {
        return $this->setData(self::REVIEW_ID, $reviewId);
    }

    /**
     * Get review
     * @return string|null
     */
    public function getReview()
    {
        return $this->_get(self::REVIEW);
    }

    /**
     * Set review
     * @param string $review
     * @return ReviewInterface
     */
    public function setReview($review)
    {
        return $this->setData(self::REVIEW, $review);
    }
}
