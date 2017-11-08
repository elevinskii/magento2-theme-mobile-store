<?php

namespace IdealCode\CatalogViewed\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /** @var \Magento\Catalog\Block\Product\AbstractProduct */
    protected $abstractProduct;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Catalog\Block\Product\AbstractProduct $abstractProduct
    ) {
        $this->abstractProduct = $abstractProduct;
        parent::__construct($context);
    }

    /**
     * Retrieve viewed add url
     *
     * @return array
     */
    public function getViewedAddParams()
    {
        return [
            'action' => $this->_urlBuilder->getUrl('viewed/index/add'),
            'data' => ['productId' => $this->abstractProduct->getProduct()->getId()]
        ];
    }
}
