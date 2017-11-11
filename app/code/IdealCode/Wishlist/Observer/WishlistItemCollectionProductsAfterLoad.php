<?php

namespace IdealCode\Wishlist\Observer;

class WishlistItemCollectionProductsAfterLoad implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $productCollection = $observer->getData('product_collection');
        $productCollection->clear()->addAttributeToSelect(['image']);
    }
}
