<?php

namespace Test\CustomerVouchers\Model\ResourceModel\VoucherStatus;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init('Test\CustomerVouchers\Model\VoucherStatus', 'Test\CustomerVouchers\Model\ResourceModel\VoucherStatus');
    }
}
