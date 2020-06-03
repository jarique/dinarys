<?php

namespace Test\CustomerVouchers\Api;

/**
 * Interface VoucherManagementInterface
 * @api
 */
interface VoucherManagementInterface
{
    /**
     * @param string $param
     * @return string
     */
    public function create($param);
}
