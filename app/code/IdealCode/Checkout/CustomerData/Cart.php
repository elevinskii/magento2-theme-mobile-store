<?php

namespace IdealCode\Checkout\CustomerData;

class Cart extends \Magento\Checkout\CustomerData\Cart
{
    /** @var \IdealCode\Catalog\Helper\Data */
    protected $catalogHelper;

    /**
     * Cart constructor.
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Catalog\Model\ResourceModel\Url $catalogUrl
     * @param \Magento\Checkout\Model\Cart $checkoutCart
     * @param \Magento\Checkout\Helper\Data $checkoutHelper
     * @param \Magento\Checkout\CustomerData\ItemPoolInterface $itemPoolInterface
     * @param \Magento\Framework\View\LayoutInterface $layout
     * @param \IdealCode\Catalog\Helper\Data $catalogHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Model\ResourceModel\Url $catalogUrl,
        \Magento\Checkout\Model\Cart $checkoutCart,
        \Magento\Checkout\Helper\Data $checkoutHelper,
        \Magento\Checkout\CustomerData\ItemPoolInterface $itemPoolInterface,
        \Magento\Framework\View\LayoutInterface $layout,
        \IdealCode\Catalog\Helper\Data $catalogHelper,
        array $data = []
    ) {
        $this->catalogHelper = $catalogHelper;

        parent::__construct(
            $checkoutSession,
            $catalogUrl,
            $checkoutCart,
            $checkoutHelper,
            $itemPoolInterface,
            $layout,
            $data
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getSectionData()
    {
        $result = parent::getSectionData();
        $result['summary_label'] = $this->catalogHelper->getAmountLabel($result['summary_count']);

        return $result;
    }
}
