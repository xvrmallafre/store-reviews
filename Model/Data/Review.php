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
     * Get increment_id
     * @return string
     */
    public function getIncrementId()
    {
        return $this->_get(self::INCREMENT_ID);
    }

    /**
     * Set increment_id
     * @param string $incrementId
     * @return ReviewInterface
     */
    public function setIncrementId($incrementId)
    {
        return $this->setData(self::INCREMENT_ID, $incrementId);
    }

    /**
     * Get delivery
     * @return int
     */
    public function getDelivery()
    {
        return $this->_get(self::DELIVERY);
    }

    /**
     * Set delivery
     * @param int $delivery
     * @return ReviewInterface
     */
    public function setDelivery($delivery)
    {
        return $this->setData(self::DELIVERY, $delivery);
    }

    /**
     * Get product
     * @return int
     */
    public function getProduct()
    {
        return $this->_get(self::PRODUCT);
    }

    /**
     * Set product
     * @param int $product
     * @return ReviewInterface
     */
    public function setProduct($product)
    {
        return $this->setData(self::PRODUCT, $product);
    }

    /**
     * Get customer support
     * @return int
     */
    public function getCustomerSupport()
    {
        return $this->_get(self::CUSTOMER_SUPPORT);
    }

    /**
     * Set product
     * @param int $customerSupport
     * @return ReviewInterface
     */
    public function setCustomerSupport($customerSupport)
    {
        return $this->setData(self::CUSTOMER_SUPPORT, $customerSupport);
    }

    /**
     * Get comment
     * @return string|null
     */
    public function getComment()
    {
        return $this->_get(self::COMMENT);
    }

    /**
     * Set comment
     * @param string|null $comment
     * @return ReviewInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Get hash
     * @return string
     */
    public function getHash()
    {
        return $this->_get(self::HASH);
    }

    /**
     * Set hash
     * @param string $hash
     * @return ReviewInterface
     */
    public function setHash($hash)
    {
        return $this->setData(self::HASH, $hash);
    }

    /**
     * Get is msg sent
     * @return bool
     */
    public function getIsMsgSent()
    {
        return $this->_get(self::IS_MSG_SENT);
    }

    /**
     * Set is msg sent
     * @param bool $isMsgSent
     * @return ReviewInterface
     */
    public function setIsMsgSent($isMsgSent)
    {
        return $this->setData(self::IS_MSG_SENT, $isMsgSent);
    }

    /**
     * Get submitted at
     * @return string|null
     */
    public function getSubmittedAt()
    {
        return $this->_get(self::SUBMITTED_AT);
    }

    /**
     * Set is msg sent
     * @param string|null $submittedAt
     * @return ReviewInterface
     */
    public function setSubmittedAt($submittedAt)
    {
        return $this->setData(self::SUBMITTED_AT, $submittedAt);
    }

    /**
     * Get visible
     * @return bool|int
     */
    public function getVisible()
    {
        return $this->_get(self::VISIBLE);
    }

    /**
     * Get visible
     * @param bool|int $visible
     * @return ReviewInterface
     */
    public function setVisible($visible)
    {
        return $this->setData(self::VISIBLE, $visible);
    }
}
