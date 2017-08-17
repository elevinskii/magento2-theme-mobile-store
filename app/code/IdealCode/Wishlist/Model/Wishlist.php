<?php

namespace IdealCode\Wishlist\Model;

class Wishlist extends \Magento\Wishlist\Model\Wishlist
{
    /**
     * Load wishlist by visitor id
     *
     * @param int $visitorId
     * @param bool $create Create wishlist if don't exists
     * @return $this
     */
    public function loadByVisitorId($visitorId, $create = false)
    {
        if ($visitorId === null) {
            return $this;
        }
        $visitorId = (int)$visitorId;

        /** @var \Magento\Wishlist\Model\ResourceModel\Wishlist $resource */
        $resource = $this->_getResource();
        $resource->load($this, $visitorId, 'visitor_id');
        if (!$this->getId() && $create) {
            $this->setVisitorId($visitorId);
            $this->setSharingCode($this->_getSharingRandomCode());
            $this->save();
        }

        return $this;
    }
}
