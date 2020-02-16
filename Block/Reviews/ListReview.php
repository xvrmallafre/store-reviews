<?php

namespace Xvrmallafre\StoreReviews\Block\Reviews;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Block\Index
 */
class ListReview extends \Magento\Framework\View\Element\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}
