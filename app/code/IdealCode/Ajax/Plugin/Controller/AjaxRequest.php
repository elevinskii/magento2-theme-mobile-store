<?php

namespace IdealCode\Ajax\Plugin\Controller;

class AjaxRequest
{
    /** @var \Magento\Framework\Message\ManagerInterface */
    protected $messageManager;

    /** @var \Magento\Framework\Json\Helper\Data */
    protected $jsonHelper;

    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    ) {
        $this->messageManager = $messageManager;
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * @param \Magento\Framework\App\Action\Action $subject
     * @param $result
     */
    public function afterExecute(
        \Magento\Framework\App\Action\Action $subject,
        $result
    ) {
        if($subject->getRequest()->isAjax()) {
            $isSuccess = count($this->messageManager->getMessages()->getErrors()) == 0;

            $subject->getResponse()->representJson(
                $this->jsonHelper->jsonEncode(['success' => $isSuccess])
            );
        }
    }
}
