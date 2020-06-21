<?php

namespace Test\CustomerVouchers\Block\Voucher;

class Edit extends \Magento\Framework\View\Element\Template
{
    /** @var \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory */
    private $voucherFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\Voucher */
    private $voucherResource;

    /** @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory */
    private $customerCollectionFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\CollectionFactory */
    private $voucherStatusCollectionFactory;

    /** @var \Magento\Framework\Registry */
    private $coreRegistry;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory $voucherFactory,
        \Test\CustomerVouchers\Model\ResourceModel\Voucher $voucherResource,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\CollectionFactory $voucherStatusCollectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->voucherFactory = $voucherFactory;
        $this->voucherResource = $voucherResource;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->voucherStatusCollectionFactory = $voucherStatusCollectionFactory;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * @return \Test\CustomerVouchers\Model\Voucher
     */
    public function getRecord()
    {
        $id = $this->coreRegistry->registry('edit_record_id');
        $this->coreRegistry->unregister('edit_record_id');

        $voucher = $this->voucherFactory->create();
        $this->voucherResource->load($voucher, $id);

        return $voucher;
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
