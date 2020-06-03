<?php

namespace Test\CustomerVouchers\Model;

use Test\CustomerVouchers\Api\VoucherManagementInterface;

class VoucherManagement implements VoucherManagementInterface
{
    /**
     * @param string $param
     * @return string
     */
    public function create($param)
    {
        return 'Api create called!';
    }
}
