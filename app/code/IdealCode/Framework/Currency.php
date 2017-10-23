<?php

namespace IdealCode\Framework;

class Currency extends \Magento\Framework\Currency
{
    /**
     * @param \Magento\Framework\App\CacheInterface $appCache
     * @param null $options
     * @param null $locale
     */
    public function __construct(
        \Magento\Framework\App\CacheInterface $appCache,
        $options = null,
        $locale = null
    ) {
        $options = is_string($options) ? ['currency' => $options] : $options;
        parent::__construct($appCache, $options, $locale);
    }
}
