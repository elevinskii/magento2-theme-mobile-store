<?php

namespace IdealCode\Catalog\Model\Product\ProductList;

class Toolbar extends \Magento\Catalog\Model\Product\ProductList\Toolbar
{
    const ORDER_PARAM_NAME = 'order';
    const DIRECTION_PARAM_NAME = 'dir';
    const LIMIT_PARAM_NAME = 'limit';

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return $this->request->getParam(self::ORDER_PARAM_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function getDirection()
    {
        return $this->request->getParam(self::DIRECTION_PARAM_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function getLimit()
    {
        return $this->request->getParam(self::LIMIT_PARAM_NAME);
    }
}
