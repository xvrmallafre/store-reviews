<?php

namespace Xvrmallafre\StoreReviews\Api;

/**
 * Interface ReviewRepositoryInterface
 *
 * @package Xvrmallafre\StoreReviews\Api
 */
interface ReviewRepositoryInterface
{

    /**
     * Save Review
     * @param \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface $review
     * @return \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface $review
    );

    /**
     * Retrieve Review
     * @param string $reviewId
     * @return \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($reviewId);

    /**
     * Retrieve Review matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Xvrmallafre\StoreReviews\Api\Data\ReviewSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Review
     * @param \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface $review
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface $review
    );

    /**
     * Delete Review by ID
     * @param string $reviewId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($reviewId);
}

