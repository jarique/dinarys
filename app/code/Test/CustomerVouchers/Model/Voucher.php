<?php

namespace Test\CustomerVouchers\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

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

    public function getDefaultValues()
    {
        return 'voucher';
    }
}
