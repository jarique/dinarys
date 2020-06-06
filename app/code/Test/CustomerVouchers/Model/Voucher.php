<?php

namespace Test\CustomerVouchers\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Voucher extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'test_customer_vouchers_voucher';

    protected function _construct()
    {
        $this->_init('Test\CustomerVouchers\Model\ResourceModel\Voucher');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId(int $customerId)
    {
        $this->setData('customer_id', $customerId);

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->getData('status_id');
    }

    /**
     * @param int $statusId
     * @return $this
     */
    public function setStatusId(int $statusId)
    {
        $this->setData('status_id', $statusId);

        return $this;
    }

    /**
     * @return string
     */
    public function getVoucherCode()
    {
        return $this->getData('voucher_code');
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setVoucherCode(string $code)
    {
        $this->setData('voucher_code', $code);

        return $this;
    }
}
