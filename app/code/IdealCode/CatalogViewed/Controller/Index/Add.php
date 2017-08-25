<?php

namespace IdealCode\CatalogViewed\Controller\Index;

use Magento\Framework\Exception\NotFoundException;

class Add extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\Data\Form\FormKey\Validator */
    protected $formKeyValidator;

    /** @var \Magento\Store\Model\StoreManagerInterface */
    protected $storeManager;

    /** @var \Magento\Reports\Model\Product\Index\ViewedFactory */
    protected $viewedFactory;

    /** @var \Magento\Customer\Model\Session */
    protected $session;

    /** @var \Magento\Customer\Model\Visitor */
    protected $visitor;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Reports\Model\Product\Index\ViewedFactory $viewedFactory
     * @param \Magento\Customer\Model\Session $session
     * @param \Magento\Customer\Model\Visitor $visitor
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Reports\Model\Product\Index\ViewedFactory $viewedFactory,
        \Magento\Customer\Model\Session $session,
        \Magento\Customer\Model\Visitor $visitor
    ) {
        $this->formKeyValidator = $formKeyValidator;
        $this->storeManager = $storeManager;
        $this->viewedFactory = $viewedFactory;
        $this->session = $session;
        $this->visitor = $visitor;

        parent::__construct($context);
    }

    /**
     * Add product to viewed
     */
    public function execute()
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();

        /** @var \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator */
        $formKeyValidator = $this->formKeyValidator;
        if(!$formKeyValidator->validate($request)) {
            throw new NotFoundException(__('Page not found.'));
        }

        $data['product_id'] = $request->getParam('productId');
        $data['store_id'] = $this->storeManager->getStore()->getId();
        if($this->session->isLoggedIn()) {
            $data['customer_id'] = $this->session->getCustomerId();
        } else {
            $data['visitor_id'] = $this->visitor->getId();
        }

        /** @var \Magento\Reports\Model\Product\Index\Viewed $viewed */
        $viewed = $this->viewedFactory->create();
        $viewed->setData($data)->save()->calculate();
    }
}
