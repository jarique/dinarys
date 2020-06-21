<?php

namespace Test\CustomerVouchers\Block\Voucher;

class Index extends \Magento\Framework\View\Element\Template
{
    /** @var \Test\CustomerVouchers\Model\ResourceModel\Voucher\CollectionFactory */
    private $voucherCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Test\CustomerVouchers\Model\ResourceModel\Voucher\CollectionFactory $voucherCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->voucherCollectionFactory = $voucherCollectionFactory;
    }

    /**
     * @return \Test\CustomerVouchers\Model\ResourceModel\Voucher\Collection
     */
    public function getResult()
    {
        return $this->voucherCollectionFactory->create()->getWithJoinedStatus();
    }
}
