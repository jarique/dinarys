<?php

namespace Test\CustomerVouchers\Block\Voucher;

class Insert extends \Magento\Framework\View\Element\Template
{
    /** @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory */
    private $customerCollectionFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\CollectionFactory */
    private $voucherStatusCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\CollectionFactory $voucherStatusCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->voucherStatusCollectionFactory = $voucherStatusCollectionFactory;
    }

    /**
     * @return null
     */
    public function getRecord()
    {
        return null;
    }

    /**
     * @return \Magento\Customer\Model\ResourceModel\Customer\Collection
     */
    public function getCustomers()
    {
        return $this->customerCollectionFactory->create();
    }

    /**
     * @return \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\Collection
     */
    public function getStatuses()
    {
        return $this->voucherStatusCollectionFactory->create();
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('customervouchers/voucher/save');
    }
}
