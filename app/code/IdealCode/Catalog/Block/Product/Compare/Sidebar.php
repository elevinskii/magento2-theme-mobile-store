<?php

namespace IdealCode\Catalog\Block\Product\Compare;

class Sidebar extends \Magento\Framework\View\Element\Template
{
    /** @var \Magento\Catalog\Helper\Product\Compare */
    protected $helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     * @param \Magento\Catalog\Helper\Product\Compare $helper
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        \Magento\Catalog\Helper\Product\Compare $helper
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Get data for clear list from helper
     * @return string
     */
    public function getDataClearList()
    {
        return $this->helper->getPostDataClearList();
    }
}
