<?php

namespace IdealCode\CatalogViewed\Block;

class ViewedAdd extends \Magento\Catalog\Block\Product\AbstractProduct
{
    /** @var \Magento\Framework\Data\Helper\PostHelper */
    protected $postHelper;

    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param array $data
     * @param \Magento\Framework\Data\Helper\PostHelper $postHelper
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        array $data = [],
        \Magento\Framework\Data\Helper\PostHelper $postHelper
    ) {
        $this->postHelper = $postHelper;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve viewed add url
     *
     * @return string
     */
    public function getViewedAddParams()
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->getProduct();

        /** @var \Magento\Framework\Url $urlBuilder */
        $urlBuilder = $this->_urlBuilder;
        $url = $urlBuilder->getUrl('viewed/index/add');

        return $this->postHelper->getPostData($url, ['productId' => $product->getId()]);
    }
}
