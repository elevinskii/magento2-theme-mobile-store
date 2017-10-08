<?php

namespace IdealCode\Catalog\Model\Product\ProductList;

class Toolbar extends \Magento\Catalog\Model\Product\ProductList\Toolbar
{
    const LIMIT_PARAM_NAME = 'limit';

    /**
     * {@inheritdoc}
     */
    public function getLimit()
    {
        return $this->request->getParam(self::LIMIT_PARAM_NAME);
    }
}
