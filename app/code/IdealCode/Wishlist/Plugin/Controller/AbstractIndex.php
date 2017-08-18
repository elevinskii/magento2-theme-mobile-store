<?php

namespace IdealCode\Wishlist\Plugin\Controller;

class AbstractIndex
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
