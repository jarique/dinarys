<?php

namespace Test\CustomerVouchers\Observer;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Group;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as GroupCollectionFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Test\CustomerVouchers\Model\ResourceModel\Voucher as VoucherResource;
use Test\CustomerVouchers\Model\ResourceModel\Voucher\CollectionFactory as VoucherCollectionFactory;

class VoucherObserver implements ObserverInterface
{
    /** @var GroupCollectionFactory */
    private $groupCollectionFactory;

    /** @var VoucherCollectionFactory */
    private $voucherCollectionFactory;

    /** @var VoucherResource */
    private $voucherResource;

    public function __construct(
        GroupCollectionFactory $groupCollectionFactory,
        VoucherCollectionFactory $voucherCollectionFactory,
        VoucherResource $voucherResource
    ) {
        $this->groupCollectionFactory = $groupCollectionFactory;
        $this->voucherCollectionFactory = $voucherCollectionFactory;
        $this->voucherResource = $voucherResource;
    }

    /**
     * @param Observer $observer
     * @throws \Exception
     */
    public function execute(Observer $observer)
    {
        /** @var Group $group */
        $group = $this->groupCollectionFactory->create()
            ->addFieldToFilter('customer_group_code', 'Privileged Customers')
            ->getFirstItem();

        /** @var CustomerInterface $customer */
        $customer = $observer->getData('customer');

        if ($customer->getGroupId() != $group->getId()) {
            /** @var \Test\CustomerVouchers\Model\ResourceModel\Voucher\Collection $voucherCollection */
            $voucherCollection = $this->voucherCollectionFactory->create()
                ->filterByCustomerId($customer->getId())
                ->load();
            /** @var \Test\CustomerVouchers\Model\Voucher $voucher */
            foreach ($voucherCollection as $voucher) {
                $this->voucherResource->delete($voucher);
            }
        }
    }
}
