<?php

namespace Xvrmallafre\StoreReviews\Block\Reviews;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Block\Reviews
 */
class Review extends Template
{

    protected $hash;

    /**
     * Constructor
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->hash = $this->getRequest()->getParam('hash');
    }
}
