<?php

namespace Test\CustomerVouchers\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Group;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as GroupCollectionFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Test\CustomerVouchers\Model\Voucher as Subject;

class VoucherPlugin
{
    /** @var CustomerRepositoryInterface */
    private $customerRepositoryInterface;

    /** @var GroupCollectionFactory */
    private $groupCollectionFactory;

    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        GroupCollectionFactory $groupCollectionFactory
    ) {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->groupCollectionFactory = $groupCollectionFactory;
    }

    /**
     * @param Subject $subject
     * @param int $customerId
     * @return int
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function beforeSetCustomerId(Subject $subject, int $customerId)
    {
        /** @var Group $group */
        $group = $this->groupCollectionFactory->create()
            ->addFieldToFilter('customer_group_code', 'Privileged Customers')
            ->getFirstItem();

        /** @var \Magento\Customer\Api\Data\CustomerInterface $customer */
        $customer = $this->customerRepositoryInterface->getById($customerId);
        if ($customer->getGroupId() != $group->getId()) {
            throw new LocalizedException(__('Customer isn\'t in a privileged group'));
        }

        return $customerId;
    }
}
