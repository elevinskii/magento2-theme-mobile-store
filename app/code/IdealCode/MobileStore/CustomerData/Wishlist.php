<?php
/**
 * Extend wishlist customer section
 */
namespace IdealCode\MobileStore\CustomerData;

class Wishlist
{
    /**
     * @param \Magento\Wishlist\CustomerData\Wishlist $object
     * @param $result
     * @return mixed
     */
    function afterGetSectionData(\Magento\Wishlist\CustomerData\Wishlist $object, $result)
    {
        $result['count'] = count($result['items']);
        return $result;
    }
}
