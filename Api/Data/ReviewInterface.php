<?php

namespace Xvrmallafre\StoreReviews\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface ReviewInterface
 *
 * @package Xvrmallafre\StoreReviews\Api\Data
 */
interface ReviewInterface extends ExtensibleDataInterface
{

    const REVIEW_ID = 'review_id';
    const INCREMENT_ID = 'increment_id';
    const DELIVERY = 'delivery';
    const PRODUCT = 'product';
    const CUSTOMER_SUPPORT = 'customer_support';
    const VISIBLE = 'visible';
    const HASH = 'hash';

    /**
     * Get increment_id
     * @return string
     */
    public function getIncrementId();

    /**
     * Set increment_id
     * @param string $incrementId
     * @return ReviewInterface
     */
    public function setIncrementId($incrementId);

    /**
     * Get review_id
     * @return int
     */
    public function getReviewId();

    /**
     * Set review_id
     * @param int $reviewId
     * @return ReviewInterface
     */
    public function setReviewId($reviewId);

    /**
     * Get delivery
     * @return int
     */
    public function getDelivery();

    /**
     * Set delivery
     * @param int $delivery
     * @return ReviewInterface
     */
    public function setDelivery($delivery);

    /**
     * Get product
     * @return int
     */
    public function getProduct();

    /**
     * Set product
     * @param int $product
     * @return ReviewInterface
     */
    public function setProduct($product);

    /**
     * Get customer support
     * @return int
     */
    public function getCustomerSupport();

    /**
     * Set product
     * @param int $customerSupport
     * @return ReviewInterface
     */
    public function setCustomerSupport($customerSupport);

    /**
     * Get comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set comment
     * @param string|null $review
     * @return ReviewInterface
     */
    public function setComment($review);

    /**
     * Get hash
     * @return string
     */
    public function getHash();

    /**
     * Set hash
     * @param string $hash
     * @return ReviewInterface
     */
    public function setHash($hash);

    /**
     * Get store id
     * @return int
     */
    public function getStoreId();

    /**
     * Set store id
     * @param int $storeId
     * @return ReviewInterface
     */
    public function setStoreId($storeId);

    /**
     * Get is msg sent
     * @return bool
     */
    public function getIsMsgSent();

    /**
     * Set is msg sent
     * @param bool $isMsgSent
     * @return ReviewInterface
     */
    public function setIsMsgSent($isMsgSent);

    /**
     * Get submitted at
     * @return string|null
     */
    public function getSumbitedAt();

    /**
     * Set is msg sent
     * @param string|null $submitedAt
     * @return ReviewInterface
     */
    public function setSumbitedAt($submitedAt);
}