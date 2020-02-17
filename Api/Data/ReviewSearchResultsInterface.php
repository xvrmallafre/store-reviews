<?php

namespace Xvrmallafre\StoreReviews\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ReviewSearchResultsInterface
 *
 * @package Xvrmallafre\StoreReviews\Api\Data
 */
interface ReviewSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Review list.
     * @return ReviewInterface[]
     */
    public function getItems();

    /**
     * Set review list.
     * @param ReviewInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

