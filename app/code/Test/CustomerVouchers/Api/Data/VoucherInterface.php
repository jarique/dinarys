<?php

namespace Test\CustomerVouchers\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface VoucherInterface
 */
interface VoucherInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId(int $customerId);

    /**
     * @return int
     */
    public function getStatusId();

    /**
     * @param int $statusId
     * @return $this
     */
    public function setStatusId(int $statusId);

    /**
     * @return string
     */
    public function getVoucherCode();

    /**
     * @param string $code
     * @return $this
     */
    public function setVoucherCode(string $code);

    /**
     * @return \Test\CustomerVouchers\Api\Data\VoucherExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Test\CustomerVouchers\Api\Data\VoucherExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Test\CustomerVouchers\Api\Data\VoucherExtensionInterface $extensionAttributes
    );
}
