<?php

namespace IdealCode\Wishlist\Controller;

class WishlistProvider extends \Magento\Wishlist\Controller\WishlistProvider
{
    /** @var \Magento\Customer\Model\Visitor */
    protected $_customerVisitor;

    /**
     * @param \Magento\Wishlist\Model\WishlistFactory $wishlistFactory
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Customer\Model\Visitor $customerVisitor
     */
    public function __construct(
        \Magento\Wishlist\Model\WishlistFactory $wishlistFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Customer\Model\Visitor $customerVisitor
    ) {
        $this->_customerVisitor = $customerVisitor;
        parent::__construct($wishlistFactory, $customerSession, $messageManager, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function getWishlist($wishlistId = null)
    {
        parent::getWishlist($wishlistId);
        if ($this->wishlist) {
            return $this->wishlist;
        }

        try {
            /** @var \Magento\Wishlist\Model\Wishlist $wishlist */
            $wishlist = $this->wishlistFactory->create();
            $visitorId = $this->_customerVisitor->getId();

            $wishlist->loadByVisitorId($visitorId, true);

            if (!$wishlist->getId()) {
                throw new \Magento\Framework\Exception\NoSuchEntityException(
                    __('The requested Wish List doesn\'t exist.')
                );
            }
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $this->messageManager->addError($e->getMessage());
            return false;
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('We can\'t create the Wish List right now.'));
            return false;
        }

        $this->wishlist = $wishlist;
        return $wishlist;
    }
}
