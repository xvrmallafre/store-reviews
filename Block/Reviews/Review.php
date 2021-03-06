<?php

namespace Xvrmallafre\StoreReviews\Block\Reviews;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Xvrmallafre\StoreReviews\Api\Data\ReviewInterface;
use Xvrmallafre\StoreReviews\Model\Config;

/**
 * Class Index
 *
 * @package Xvrmallafre\StoreReviews\Block\Reviews
 */
class Review extends Template
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * Constructor
     *
     * @param Context $context
     * @param array $data
     * @param Config $config
     */
    public function __construct(
        Context $context,
        array $data = [],
        Config $config
    ) {
        parent::__construct($context, $data);

        $this->config = $config;
    }

    /**
     * @return $this|Template
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->pageConfig->getTitle()->set(__('Create review'));

        return $this;
    }

    /**
     * @return array
     */
    public function getRadioOptions()
    {
        return [
            ReviewInterface::DELIVERY,
            ReviewInterface::PRODUCT,
            ReviewInterface::CUSTOMER_SUPPORT,
        ];
    }

    /**
     * @param string $option
     * @return string
     */
    public function getFieldTitle(string $option)
    {
        if ($option === ReviewInterface::CUSTOMER_SUPPORT) {
            $option = str_replace('_', ' ', $option);
        }

        return ucfirst($option);
    }

    /**
     * @param string $option
     * @return array
     */
    public function getRadioIdAndValue(string $option)
    {
        $optionArr = [];

        foreach ($this->getRadioValues() as $radioValue) {
            $optionArr[$radioValue] = [
                'id' => $option . '-star-' . $radioValue,
                'value' => $radioValue,
            ];
        }

        return $optionArr;
    }

    /**
     * @return array
     */
    protected function getRadioValues()
    {
        return [5, 4, 3, 2, 1];
    }

    /**
     * @return bool
     */
    public function isCommentBoxEnabled()
    {
        return $this->config->areCommentsEnabled();
    }

    /**
     * @return string
     */
    public function getCommentBoxName()
    {
        return ReviewInterface::COMMENT;
    }

    /**
     * @return string
     */
    public function getSubmitPostUrl()
    {
        return $this->getUrl('*/*/save');
    }

    /**
     * @return mixed
     */
    public function getHashParam()
    {
        return $this->getRequest()->getParam('hash');
    }
}
