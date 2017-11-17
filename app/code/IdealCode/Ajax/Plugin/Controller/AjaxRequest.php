<?php

namespace IdealCode\Ajax\Plugin\Controller;

class AjaxRequest
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $pageFactory;

    /** @var \Magento\Framework\Message\ManagerInterface */
    protected $messageManager;

    /** @var \Magento\Framework\Json\Helper\Data */
    protected $jsonHelper;

    /**
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Json\Helper\Data $jsonHelper
    ) {
        $this->pageFactory = $pageFactory;
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
            $result = [
                'success' => count($this->messageManager->getMessages()->getErrors()) == 0
            ];

            $reloadBlock = $subject->getRequest()->getParam('reload-block');
            if($reloadBlock) {
                /** @var \Magento\Framework\View\Layout $layout */
                $layout = $this->pageFactory->create()->addHandle($reloadBlock['handle'])->getLayout();
                /** @var \Magento\Framework\View\Element\AbstractBlock $block */
                $block = $layout->getBlock($reloadBlock['name']);
                $result['block'] = $block ? $block->toHtml() : '';
            }

            $subject->getResponse()->representJson(
                $this->jsonHelper->jsonEncode($result)
            );
        }
    }
}
