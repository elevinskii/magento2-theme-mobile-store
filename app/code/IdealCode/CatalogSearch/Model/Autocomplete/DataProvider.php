<?php

namespace IdealCode\CatalogSearch\Model\Autocomplete;

class DataProvider extends \Magento\CatalogSearch\Model\Autocomplete\DataProvider
{
    /** @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory */
    protected $productRepository;

    /** @var \Magento\Catalog\Helper\Image */
    protected $imageHelper;

    /** @var \Magento\Framework\Pricing\PriceCurrencyInterface */
    protected $priceCurrency;

    /**
     * @param \Magento\Search\Model\QueryFactory $queryFactory
     * @param \Magento\Search\Model\Autocomplete\ItemFactory $itemFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        \Magento\Search\Model\QueryFactory $queryFactory,
        \Magento\Search\Model\Autocomplete\ItemFactory $itemFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->imageHelper = $imageHelper;
        $this->priceCurrency = $priceCurrency;
        parent::__construct($queryFactory, $itemFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        $query = $this->queryFactory->get()->getQueryText();
        $result = [];

        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $collection */
        $collection = $this->productCollectionFactory->create();
        $collection ->addAttributeToSelect(['name', 'thumbnail', 'price', 'special_price'])
                    ->addAttributeToFilter('name', ['like' => '%'.$query.'%'])
                    ->setPageSize(3);

        /** @var \Magento\Catalog\Model\Product $product */
        foreach($collection as $product) {
            $result[] = $this->itemFactory->create([
                'name' => $product->getName(),
                'url' => $product->getProductUrl(),
                'image' => $this->getProductImage($product),
                'price' => $this->priceCurrency->format($product->getPrice(), false),
                'final_price' => $this->priceCurrency->format($product->getFinalPrice(), false)
            ]);
        }

        return $result;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return array
     */
    protected function getProductImage(
        \Magento\Catalog\Model\Product $product
    ) {
        $imageHelper = $this->imageHelper->init($product, 'search_suggest_product_thumbnail');
        return [
            'src' => $imageHelper->getUrl(),
            'alt' => $imageHelper->getLabel(),
            'width' => $imageHelper->getWidth(),
            'height' => $imageHelper->getHeight()
        ];
    }
}
