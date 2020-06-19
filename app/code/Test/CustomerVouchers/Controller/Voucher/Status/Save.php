<?php

namespace Test\CustomerVouchers\Controller\Voucher\Status;

class Save extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    private $resultPageFactory;

    /** @var \Test\CustomerVouchers\Model\VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus */
    private $voucherStatusResource;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Test\CustomerVouchers\Model\VoucherStatusFactory $voucherStatusFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus $voucherStatusResource
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;

        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();

            if ($input['status_code']) {
                $voucherStatus = $this->voucherStatusFactory->create();
                $voucherStatus->setStatusCode($input['status_code']);

                $this->voucherStatusResource->save($voucherStatus);

                $this->messageManager->addSuccessMessage('Voucher status saved!');
            }
        }

        return $this->_redirect('customervouchers/voucher_status/index');
    }
}
