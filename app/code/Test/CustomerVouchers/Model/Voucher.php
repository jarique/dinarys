<?php

namespace Test\CustomerVouchers\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\DataObject\IdentityInterface;
use Test\CustomerVouchers\Api\Data\VoucherInterface;

class Voucher extends AbstractExtensibleModel implements IdentityInterface, VoucherInterface
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
     * {@inheritdoc}
     */
    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomerId(int $customerId)
    {
        $this->setData('customer_id', $customerId);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusId()
    {
        return $this->getData('status_id');
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusId(int $statusId)
    {
        $this->setData('status_id', $statusId);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVoucherCode()
    {
        return $this->getData('voucher_code');
    }

    /**
     * {@inheritdoc}
     */
    public function setVoucherCode(string $code)
    {
        $this->setData('voucher_code', $code);

        return $this;
    }

    /**
     * @return \Test\CustomerVouchers\Api\Data\VoucherExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @param \Test\CustomerVouchers\Api\Data\VoucherExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Test\CustomerVouchers\Api\Data\VoucherExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
