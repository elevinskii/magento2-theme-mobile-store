<?php

namespace IdealCode\Wishlist\Model;

class AuthenticationState extends \Magento\Wishlist\Model\AuthenticationState
{
    /** @var \Magento\Framework\App\Request\Http */
    protected $request;

    /**
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return !in_array($this->request->getActionName(), ['add', 'remove']);
    }
}
