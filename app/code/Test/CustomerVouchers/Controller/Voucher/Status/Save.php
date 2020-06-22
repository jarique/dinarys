<?php

namespace Test\CustomerVouchers\Controller\Voucher\Status;

class Save extends \Magento\Framework\App\Action\Action
{
    /** @var \Test\CustomerVouchers\Model\VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus */
    private $voucherStatusResource;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Test\CustomerVouchers\Model\VoucherStatusFactory $voucherStatusFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus $voucherStatusResource
    ) {
        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();
            $voucherStatus = $this->voucherStatusFactory->create();

            if (!empty($input['id'])) {
                $this->voucherStatusResource->load($voucherStatus, $input['id']);
            }
            if (!empty($input['status_code'])) {
                $voucherStatus->setStatusCode($input['status_code']);
                $this->voucherStatusResource->save($voucherStatus);

                $this->messageManager->addSuccessMessage('Voucher status saved!');
            } else {
                $this->messageManager->addErrorMessage('Something went wrong!');
            }
        }

        return $this->_redirect('customervouchers/voucher_status/index');
    }
}
