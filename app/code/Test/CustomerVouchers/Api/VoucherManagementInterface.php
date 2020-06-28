<?php

namespace Test\CustomerVouchers\Api;

/**
 * Interface VoucherManagementInterface
 * @api
 */
interface VoucherManagementInterface
{
    /**
     * @return array
     */
    public function getVouchers();

    /**
     * @param int $id
     * @return array
     */
    public function getVouchersByCustomerId(int $id);

    /**
     * @return array
     */
    public function getCurrentCustomerVouchers();

    /**
     * @param int $customerId
     * @param int $statusId
     * @param string $code
     * @return int
     */
    public function createVoucher(int $customerId, int $statusId, string $code);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteVoucher(int $id);

    /**
     * @return array
     */
    public function getVoucherStatuses();

    /**
     * @param string $code
     * @return int
     */
    public function createVoucherStatus(string $code);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteVoucherStatus(int $id);
}
