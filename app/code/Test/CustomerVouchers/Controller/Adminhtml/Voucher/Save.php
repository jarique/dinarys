<?php

namespace Test\CustomerVouchers\Controller\Adminhtml\Voucher;

class Save extends \Magento\Backend\App\Action
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
        \Magento\Backend\App\Action\Context $context,
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

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPostValue();
            $voucher = $this->voucherFactory->create();

            if (!empty($data['entity_id'])) {
                $this->voucherResource->load($voucher, $data['entity_id']);
            }

            if (!empty($data['customer_id']) && !empty($data['status_code']) && !empty($data['voucher_code'])) {
                $customer = $this->customerRepositoryInterface->getById($data['customer_id']);

                $voucherStatus = $this->voucherStatusFactory->create();
                $this->voucherStatusResource->load($voucherStatus, $data['status_code'], 'status_code');

                $voucher->setStatusId($voucherStatus->getId());
                $voucher->setVoucherCode($data['voucher_code']);
                $voucher->getExtensionAttributes()->setCustomer($customer);
                $this->voucherResource->save($voucher);

                $this->messageManager->addSuccessMessage('Voucher saved!');
            } else {
                $this->messageManager->addErrorMessage('Something went wrong!');
            }
        }

        return $this->_redirect('customervouchers/voucher/index');
    }
}
