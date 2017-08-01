<?php
/**
 * Minicart block
 */
namespace IdealCode\MobileStore\Block\Cart;

class Sidebar extends \Magento\Checkout\Block\Cart\Sidebar
{
    /**
     * @return string
     */
    function getCurrentStoreLocale()
    {
        return $this->_scopeConfig->getValue(
            \Magento\Directory\Helper\Data::XML_PATH_DEFAULT_LOCALE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}

