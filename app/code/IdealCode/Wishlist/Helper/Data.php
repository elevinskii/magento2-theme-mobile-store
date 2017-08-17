<?php

namespace IdealCode\Wishlist\Helper;

class Data extends \Magento\Wishlist\Helper\Data
{
    /**
     * {@inheritdoc}
     */
    public function calculate()
    {
        parent::calculate();

        if (!$this->getCustomer()) {
            /** @var \Magento\Wishlist\Model\ResourceModel\Item\Collection $collection */
            $collection = $this->getWishlistItemCollection()->setInStockFilter(true);
            $isDisplayQty = $this->isDisplayQty();
            $count = $isDisplayQty ? $collection->getItemsQty() : $collection->getSize();

            $this->_customerSession->setWishlistDisplayType($isDisplayQty);
            $this->_customerSession->setDisplayOutOfStockProducts(
                $this->scopeConfig->getValue(
                    self::XML_PATH_CATALOGINVENTORY_SHOW_OUT_OF_STOCK,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );
            $this->_customerSession->setWishlistItemCount($count);
        }
        return $this;
    }
}
