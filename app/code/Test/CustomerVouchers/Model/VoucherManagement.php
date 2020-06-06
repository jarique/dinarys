<?php

namespace Test\CustomerVouchers\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Test\CustomerVouchers\Api\VoucherManagementInterface;
use Test\CustomerVouchers\Model\ResourceModel\Voucher as VoucherResource;
use Test\CustomerVouchers\Model\ResourceModel\Voucher\CollectionFactory as VoucherCollectionFactory;
use Test\CustomerVouchers\Model\ResourceModel\VoucherStatus as VoucherStatusResource;
use Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\CollectionFactory as VoucherStatusCollectionFactory;

class VoucherManagement implements VoucherManagementInterface
{
    /** @var VoucherFactory */
    private $voucherFactory;

    /** @var VoucherResource */
    private $voucherResource;

    /** @var VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var VoucherStatusResource */
    private $voucherStatusResource;

    /** @var VoucherCollectionFactory */
    private $voucherCollectionFactory;

    /** @var VoucherStatusCollectionFactory */
    private $voucherStatusCollectionFactory;

    /** @var CustomerRepositoryInterface */
    private $customerRepositoryInterface;

    public function __construct(
        VoucherFactory $voucherFactory,
        VoucherResource $voucherResource,
        VoucherStatusFactory $voucherStatusFactory,
        VoucherStatusResource $voucherStatusResource,
        VoucherCollectionFactory $voucherCollectionFactory,
        VoucherStatusCollectionFactory $voucherStatusCollectionFactory,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->voucherFactory = $voucherFactory;
        $this->voucherResource = $voucherResource;
        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;
        $this->voucherCollectionFactory = $voucherCollectionFactory;
        $this->voucherStatusCollectionFactory = $voucherStatusCollectionFactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }

    /**
     * @return array
     */
    public function getVouchers()
    {
        return $this->voucherCollectionFactory->create()
            ->load()
            ->getData();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getVouchersByCustomerId(int $id)
    {
        return $this->voucherCollectionFactory->create()
            ->filterByCustomerId($id)
            ->load()
            ->getData();
    }

    /**
     * @param int $customerId
     * @param int $statusId
     * @param string $code
     * @return int
     * @throws AlreadyExistsException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function createVoucher(int $customerId, int $statusId, string $code)
    {
        $this->customerRepositoryInterface->getById($customerId);

        /** @var VoucherStatus $voucherStatus */
        $voucherStatus = $this->voucherStatusFactory->create();
        $this->voucherStatusResource->load($voucherStatus, $statusId);
        if (!$voucherStatus->getId()) {
            throw NoSuchEntityException::singleField('statusId', $statusId);
        }

        /** @var Voucher $voucher */
        $voucher = $this->voucherFactory->create();
        $voucher->setCustomerId($customerId);
        $voucher->setStatusId($statusId);
        $voucher->setVoucherCode($code);
        $this->voucherResource->save($voucher);

        return $voucher->getId();
    }

    /**
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteVoucher(int $id)
    {
        /** @var Voucher $voucher */
        $voucher = $this->voucherFactory->create();
        $this->voucherResource->load($voucher, $id);
        if (!$voucher->getId()) {
            throw NoSuchEntityException::singleField('entityId', $id);
        }

        try {
            $this->voucherResource->delete($voucher);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('The "%1" voucher couldn\'t be removed.', $id));
        }

        return true;
    }

    /**
     * @return array
     */
    public function getVoucherStatuses()
    {
        return $this->voucherStatusCollectionFactory->create()
            ->load()
            ->getData();
    }

    /**
     * @param string $code
     * @return int
     * @throws AlreadyExistsException
     */
    public function createVoucherStatus(string $code)
    {
        /** @var voucherStatus $voucher */
        $voucherStatus = $this->voucherStatusFactory->create();
        $voucherStatus->setStatusCode($code);
        $this->voucherStatusResource->save($voucherStatus);

        return $voucher->getId();
    }

    /**
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteVoucherStatus(int $id)
    {
        /** @var VoucherStatus $voucherStatus */
        $voucherStatus = $this->voucherStatusFactory->create();
        $this->voucherStatusResource->load($voucherStatus, $id);
        if (!$voucherStatus->getId()) {
            throw NoSuchEntityException::singleField('entityId', $id);
        }

        try {
            $this->voucherStatusResource->delete($voucherStatus);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('The "%1" voucher status couldn\'t be removed.', $id));
        }

        return true;
    }
}
