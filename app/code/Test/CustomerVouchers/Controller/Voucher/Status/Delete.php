<?php

namespace Test\CustomerVouchers\Controller\Voucher\Status;

class Delete extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\App\Request\Http */
    private $request;

    /** @var \Test\CustomerVouchers\Model\VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus */
    private $voucherStatusResource;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Test\CustomerVouchers\Model\VoucherStatusFactory $voucherStatusFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus $voucherStatusResource
    ) {
        $this->request = $request;
        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;

        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Exception
     */
    public function execute()
    {
        $id = $this->request->getParam('id');

        $voucherStatus = $this->voucherStatusFactory->create();
        $this->voucherStatusResource->load($voucherStatus, $id);
        $this->voucherStatusResource->delete($voucherStatus);

        $this->messageManager->addSuccessMessage('Voucher status deleted!');

        return $this->_redirect('customervouchers/voucher_status/index');
    }
}
