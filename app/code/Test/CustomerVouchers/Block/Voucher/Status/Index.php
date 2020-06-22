<?php

namespace Test\CustomerVouchers\Block\Voucher\Status;

class Index extends \Magento\Framework\View\Element\Template
{
    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\CollectionFactory */
    private $voucherStatusCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\CollectionFactory $voucherStatusCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->voucherStatusCollectionFactory = $voucherStatusCollectionFactory;
    }

    /**
     * @return \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus\Collection
     */
    public function getResult()
    {
        return $this->voucherStatusCollectionFactory->create();
    }
}
