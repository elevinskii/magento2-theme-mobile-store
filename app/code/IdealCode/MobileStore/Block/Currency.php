<?php
/**
 * Currency dropdown block
 */
namespace IdealCode\MobileStore\Block;

class Currency extends \Magento\Directory\Block\Currency
{
    /**
     * @return string
     */
    public function getCurrentCurrencySymbol()
    {
        return $this->_currencyFactory->create()->load($this->getCurrentCurrencyCode())->getCurrencySymbol();
    }
}
