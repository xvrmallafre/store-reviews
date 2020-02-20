<?php

namespace Xvrmallafre\StoreReviews\Model;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Xvrmallafre\StoreReviews\Model
 */
class Config extends AbstractHelper
{
    const XML_PATH_MENU = 'xvrmallafre_storereviews/';
    const ADMIN_GENERAL_PATH = 'general/';

    /**
     * @param string $field
     * @param int $storeId
     * @return string
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param null|int $storeId
     * @return string
     */
    public function isEnabled($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_MENU . self::ADMIN_GENERAL_PATH . 'enabled', $storeId);
    }

    /**
     * @param null|int $storeId
     * @return string
     */
    public function areCommentsEnabled($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_MENU . self::ADMIN_GENERAL_PATH . 'comments_enabled', $storeId);
    }

    /**
     * @param null|int $storeId
     * @return string
     */
    public function offsetDaysSendEmail($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_MENU . self::ADMIN_GENERAL_PATH . 'send_message_days', $storeId);
    }
}
