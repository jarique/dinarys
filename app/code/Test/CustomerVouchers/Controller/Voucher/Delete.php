<?php

namespace Test\CustomerVouchers\Controller\Voucher;

class Delete extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\App\Request\Http */
    private $request;

    /** @var \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory */
    private $voucherFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\Voucher */
    private $voucherResource;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory $voucherFactory,
        \Test\CustomerVouchers\Model\ResourceModel\Voucher $voucherResource
    ) {
        $this->request = $request;
        $this->voucherFactory = $voucherFactory;
        $this->voucherResource = $voucherResource;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Exception
     */
    public function execute()
    {
        $id = $this->request->getParam('id');

        $voucher = $this->voucherFactory->create();
        $this->voucherResource->load($voucher, $id);
        $this->voucherResource->delete($voucher);

        $this->messageManager->addSuccessMessage('Voucher deleted!');

        return $this->_redirect('customervouchers/voucher/index');
    }
}
