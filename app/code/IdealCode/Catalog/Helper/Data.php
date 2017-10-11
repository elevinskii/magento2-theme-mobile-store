<?php

namespace IdealCode\Catalog\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param $count
     * @return string
     */
    public function getAmountLabel($count)
    {
        $titles = [__('item'), __('items'), __('items2')];
        $locale = $this->scopeConfig->getValue(
            \Magento\Directory\Helper\Data::XML_PATH_DEFAULT_LOCALE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        if($locale == 'ru_RU') {
            /** @see https://gist.github.com/realmyst/1262561 */
            $cases = [2, 0, 1, 1, 1, 2];
            return $count.' '.$titles[($count % 100 > 4 && $count % 100 < 20) ? 2 : $cases[($count % 10 < 5) ? $count % 10 : 5]];
        } else {
            return $count.' '.$titles[$count == 1 ? 0 : 1];
        }
    }
}
