<?php

namespace IdealCode\Wishlist\Block\Customer\Wishlist;

class Items extends \Magento\Catalog\Block\Product\AbstractProduct
{
    /**
     * @return array
     */
    public function getLoadedProductCollection()
    {
        $result = [];
        /** @var \Magento\Wishlist\Model\Item $item */
        foreach($this->getItems() as $item) {
            $result[] = $item->getProduct();
        }

        return $result;
    }
}
