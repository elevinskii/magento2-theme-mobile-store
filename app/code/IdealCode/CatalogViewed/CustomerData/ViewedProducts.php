<?php

namespace IdealCode\CatalogViewed\CustomerData;

class ViewedProducts implements \Magento\Customer\CustomerData\SectionSourceInterface
{
    /** @var \Magento\Reports\Block\Product\Viewed */
    protected $viewed;

    /**
     * @param \Magento\Reports\Block\Product\Viewed $viewed
     */
    public function __construct(
        \Magento\Reports\Block\Product\Viewed $viewed
    ) {
        $this->viewed = $viewed;
    }

    /**
     * {@inheritdoc}
     */
    public function getSectionData()
    {
        return [
            'items' => $this->getItems()
        ];
    }

    /**
     * Get items data
     *
     * @return array
     */
    protected function getItems()
    {
        $items = [];
        foreach ($this->viewed->getItemsCollection() as $item) {
            $items[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'url' => $item->getProductUrl()
            ];
        }

        return $items;
    }
}
