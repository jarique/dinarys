<?php

namespace Test\CustomerVouchers\Controller\Adminhtml\Voucher;

class Delete extends \Magento\Backend\App\Action
{
    /** @var \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory */
    private $voucherFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\Voucher */
    private $voucherResource;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory $voucherFactory,
        \Test\CustomerVouchers\Model\ResourceModel\Voucher $voucherResource
    ) {
        $this->voucherFactory = $voucherFactory;
        $this->voucherResource = $voucherResource;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $voucher = $this->voucherFactory->create();

        try {
            $this->voucherResource->load($voucher, $id);
            $this->voucherResource->delete($voucher);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage('Something went wrong!');

            return $this->_redirect('customervouchers/voucher/index');
        }

        $this->messageManager->addSuccessMessage('Voucher deleted!');

        return $this->_redirect('customervouchers/voucher/index');
    }
}
