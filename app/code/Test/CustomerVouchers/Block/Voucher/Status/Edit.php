<?php

namespace Test\CustomerVouchers\Block\Voucher\Status;

class Edit extends \Magento\Framework\View\Element\Template
{
    /** @var \Test\CustomerVouchers\Model\VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus */
    private $voucherStatusResource;

    /** @var \Magento\Framework\Registry */
    private $coreRegistry;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Test\CustomerVouchers\Model\VoucherStatusFactory $voucherStatusFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus $voucherStatusResource,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * @return \Test\CustomerVouchers\Model\VoucherStatus
     */
    public function getRecord()
    {
        $id = $this->coreRegistry->registry('edit_record_id');
        $this->coreRegistry->unregister('edit_record_id');

        $voucherStatus = $this->voucherStatusFactory->create();
        $this->voucherStatusResource->load($voucherStatus, $id);

        return $voucherStatus;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('customervouchers/voucher_status/save');
    }
}
