<?php

namespace Xvrmallafre\StoreReviews\Api\Data;

/**
 * Interface ReviewSearchResultsInterface
 *
 * @package Xvrmallafre\StoreReviews\Api\Data
 */
interface ReviewSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Review list.
     * @return \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface[]
     */
    public function getItems();

    /**
     * Set review list.
     * @param \Xvrmallafre\StoreReviews\Api\Data\ReviewInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

