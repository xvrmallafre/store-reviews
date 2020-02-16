<?php

namespace Xvrmallafre\StoreReviews\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Xvrmallafre\StoreReviews\Api\Data\ReviewExtensionInterface;
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

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return ReviewExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param ReviewExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        ReviewExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

