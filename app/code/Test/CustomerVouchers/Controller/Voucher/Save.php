<?php

namespace Test\CustomerVouchers\Controller\Voucher;

class Save extends \Magento\Framework\App\Action\Action
{
    /** @var \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory */
    private $voucherFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\Voucher */
    private $voucherResource;

    /** @var \Test\CustomerVouchers\Model\VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus */
    private $voucherStatusResource;

    /** @var \Magento\Customer\Api\CustomerRepositoryInterface */
    private $customerRepositoryInterface;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Test\CustomerVouchers\Api\Data\VoucherInterfaceFactory $voucherFactory,
        \Test\CustomerVouchers\Model\ResourceModel\Voucher $voucherResource,
        \Test\CustomerVouchers\Model\VoucherStatusFactory $voucherStatusFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus $voucherStatusResource,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->voucherFactory = $voucherFactory;
        $this->voucherResource = $voucherResource;
        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;
        $this->customerRepositoryInterface = $customerRepositoryInterface;

        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();
            $voucher = $this->voucherFactory->create();

            if (!empty($input['id'])) {
                $this->voucherResource->load($voucher, $input['id']);
            }

            if (!empty($input['voucher_customer']) && !empty($input['voucher_status']) && !empty($input['voucher_code'])) {
                $customer = $this->customerRepositoryInterface->getById($input['voucher_customer']);

                $voucherStatus = $this->voucherStatusFactory->create();
                $this->voucherStatusResource->load($voucherStatus, $input['voucher_status'], 'status_code');

                $voucher->setStatusId($voucherStatus->getId());
                $voucher->setVoucherCode($input['voucher_code']);
                $voucher->getExtensionAttributes()->setCustomer($customer);
                $this->voucherResource->save($voucher);

                $this->messageManager->addSuccessMessage('Voucher status saved!');
            } else {
                $this->messageManager->addErrorMessage('Something went wrong!');
            }
        }

        return $this->_redirect('customervouchers/voucher/index');
    }
}
