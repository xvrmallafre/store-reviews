<?php

namespace Xvrmallafre\StoreReviews\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterface;
use Xvrmallafre\StoreReviews\Api\Data\ReviewSearchResultsInterface;

/**
 * Interface ReviewRepositoryInterface
 *
 * @package Xvrmallafre\StoreReviews\Api
 */
interface ReviewRepositoryInterface
{

    /**
     * Save Review
     * @param ReviewInterface $review
     * @return ReviewInterface
     * @throws LocalizedException
     */
    public function save(
        ReviewInterface $review
    );

    /**
     * Retrieve Review
     * @param string $reviewId
     * @return ReviewInterface
     * @throws LocalizedException
     */
    public function get($reviewId);

    /**
     * Retrieve Review matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReviewSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Review
     * @param ReviewInterface $review
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        ReviewInterface $review
    );

    /**
     * Delete Review by ID
     * @param string $reviewId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($reviewId);
}

