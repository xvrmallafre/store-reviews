<?php

namespace Xvrmallafre\StoreReviews\Api\Data;

/**
 * Interface ReviewInterface
 *
 * @package Xvrmallafre\StoreReviews\Api\Data
 */
interface ReviewInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const REVIEW = 'review';
    const REVIEW_ID = 'review_id';

    /**
     * Get review_id
     * @return string|null
     */
    public function getReviewId();

    /**
     * Set review_id
     * @param string $reviewId
     * @return \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface
     */
    public function setReviewId($reviewId);

    /**
     * Get review
     * @return string|null
     */
    public function getReview();

    /**
     * Set review
     * @param string $review
     * @return \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface
     */
    public function setReview($review);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Xvrmallafre\StoreReviews\Api\Data\ReviewExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Xvrmallafre\StoreReviews\Api\Data\ReviewExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Xvrmallafre\StoreReviews\Api\Data\ReviewExtensionInterface $extensionAttributes
    );
}

