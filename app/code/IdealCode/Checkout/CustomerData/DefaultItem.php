<?php

namespace IdealCode\Checkout\CustomerData;

class DefaultItem extends \Magento\Checkout\CustomerData\DefaultItem
{
    /** @var \Magento\Checkout\Helper\Cart */
    protected $cartHelper;

    /**
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Msrp\Helper\Data $msrpHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Catalog\Helper\Product\ConfigurationPool $configurationPool
     * @param \Magento\Checkout\Helper\Data $checkoutHelper
     * @param \Magento\Checkout\Helper\Cart $cartHelper
     */
    public function __construct(
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Msrp\Helper\Data $msrpHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Catalog\Helper\Product\ConfigurationPool $configurationPool,
        \Magento\Checkout\Helper\Data $checkoutHelper,
        \Magento\Checkout\Helper\Cart $cartHelper
    ) {
        $this->cartHelper = $cartHelper;
        parent::__construct($imageHelper, $msrpHelper, $urlBuilder, $configurationPool, $checkoutHelper);
    }

    /**
     * {@inheritdoc}
     */
    protected function doGetItemData()
    {
        $result = parent::doGetItemData();
        $result['remove_url'] = $this->cartHelper->getDeletePostJson($this->item);

        return $result;
    }
}
