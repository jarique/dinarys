<?php

namespace Test\CustomerVouchers\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class VoucherStatus extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'test_customer_vouchers_voucher_status';

    protected function _construct()
    {
        $this->_init('Test\CustomerVouchers\Model\ResourceModel\VoucherStatus');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->getData('status_code');
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setStatusCode(string $code)
    {
        $this->setData('status_code', $code);

        return $this;
    }
}
