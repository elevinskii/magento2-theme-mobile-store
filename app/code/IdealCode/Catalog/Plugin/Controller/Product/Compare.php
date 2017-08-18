<?php

namespace IdealCode\Catalog\Plugin\Controller\Product;

class Compare
{
    /**
     * @param \Magento\Framework\App\Action\Action $subject
     * @param $result
     * @return mixed
     */
    public function afterExecute(\Magento\Framework\App\Action\Action $subject, $result)
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $subject->getRequest();
        if(!$request->isAjax()) {
            return $result;
        }
    }
}
