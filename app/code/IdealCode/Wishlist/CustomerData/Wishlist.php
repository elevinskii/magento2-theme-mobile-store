<?php

namespace IdealCode\Wishlist\CustomerData;

class Wishlist extends \Magento\Wishlist\CustomerData\Wishlist
{
    /**
     * {@inheritdoc}
     */
    public function getSectionData()
    {
        $data = parent::getSectionData();
        $data['extra'] = $data['counter'] ? $this->getExtra() : [];

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    protected function getCounter()
    {
        /** @var \Magento\Wishlist\Helper\Data $helper */
        $helper = $this->wishlistHelper;
        return $helper->getItemCount();
    }

    /**
     * Get extra information for wishlist items
     */
    protected function getExtra()
    {
        /** @var \Magento\Wishlist\Helper\Data $helper */
        $helper = $this->wishlistHelper;
        $collection = $helper->getWishlistItemCollection()->setInStockFilter();

        $items = [];
        /** @var \Magento\Wishlist\Model\Item $wishlistItem */
        foreach($collection as $wishlistItem) {
            $product = $wishlistItem->getProduct();
            $items[] = [
                'id' => $product->getId(),
                'remove' => $helper->getRemoveParams($wishlistItem, true)
            ];
        }

        return $items;
    }
}
