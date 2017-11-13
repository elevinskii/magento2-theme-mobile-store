<?php

namespace IdealCode\Customer\Block\Form;

class Login extends \Magento\Customer\Block\Form\Login
{
    /**
     * @return string
     */
    public function getBeforeAuthUrl()
    {
        if($this->_customerSession->getBeforeAuthUrl()) {
            return $this->_customerSession->getBeforeAuthUrl();
        }

        return $this->_urlBuilder->getCurrentUrl();
    }
}
