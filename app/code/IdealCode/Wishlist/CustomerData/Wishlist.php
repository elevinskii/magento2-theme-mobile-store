<?php

namespace IdealCode\Wishlist\CustomerData;

class Wishlist extends \Magento\Wishlist\CustomerData\Wishlist
{
    /**
     * {@inheritdoc}
     */
    public function getSectionData()
    {
        $counter = $this->getCounter();
        return [
            'counter' => $counter,
            'extra' => $counter ? $this->getExtra() : []
        ];
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
     *
     * @return array
     */
    protected function getExtra()
    {
        $collection = $this->wishlistHelper->getWishlistItemCollection()->setInStockFilter();

        $items = [];
        /** @var \Magento\Wishlist\Model\Item $wishlistItem */
        foreach($collection as $wishlistItem) {
            $items[] = [
                'id' => $wishlistItem->getProductId(),
                'wishlistId' => $wishlistItem->getId()
            ];
        }

        return $items;
    }
}
