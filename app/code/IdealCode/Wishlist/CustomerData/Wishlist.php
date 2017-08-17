<?php

namespace IdealCode\Wishlist\CustomerData;

class Wishlist extends \Magento\Wishlist\CustomerData\Wishlist
{
    /**
     * {@inheritdoc}
     */
    protected function getCounter()
    {
        /** @var \Magento\Wishlist\Helper\Data $helper */
        $helper = $this->wishlistHelper;
        return $helper->getItemCount();
    }
}
