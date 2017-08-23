<?php

namespace IdealCode\Catalog\CustomerData;

class CompareProducts extends \Magento\Catalog\CustomerData\CompareProducts
{
    /** @var \Magento\Catalog\Api\ProductRepositoryInterface */
    protected $productRepository;

    /** @var \Magento\Catalog\Helper\ImageFactory */
    protected $imageFactory;

    /**
     * @param \Magento\Catalog\Helper\Product\Compare $helper
     * @param \Magento\Catalog\Model\Product\Url $productUrl
     * @param \Magento\Catalog\Helper\Output $outputHelper
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Magento\Catalog\Helper\ImageFactory $imageFactory
     */
    public function __construct(
        \Magento\Catalog\Helper\Product\Compare $helper,
        \Magento\Catalog\Model\Product\Url $productUrl,
        \Magento\Catalog\Helper\Output $outputHelper,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Helper\ImageFactory $imageFactory
    ) {
        $this->productRepository = $productRepository;
        $this->imageFactory = $imageFactory;
        parent::__construct($helper, $productUrl, $outputHelper);
    }

    /**
     * {@inheritdoc}
     */
    protected function getItems()
    {
        $items = parent::getItems();
        foreach ($items as &$item) {
            /** @var \Magento\Catalog\Model\Product $product */
            $product = $this->productRepository->getById($item['id']);
            $item['image'] = $this->getImageData($product);
        }
        return $items;
    }

    /**
     * Retrieve product image data
     *
     * @param $product
     * @return array
     */
    protected function getImageData($product)
    {
        /** @var \Magento\Catalog\Helper\Image $image */
        $image = $this->imageFactory->create();
        $image->init($product, 'compare_sidebar_block');

        return [
            'template' => 'Magento_Catalog/product/image' .($image->getFrame() ? '' : '_with_borders'),
            'src' => $image->getUrl(),
            'alt' => $image->getLabel(),
            'width' => $image->getWidth(),
            'height' => $image->getHeight()
        ];
    }
}
