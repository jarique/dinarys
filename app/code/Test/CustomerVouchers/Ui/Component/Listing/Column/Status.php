<?php

namespace Test\CustomerVouchers\Ui\Component\Listing\Column;

class Status extends \Magento\Ui\Component\Listing\Columns\Column
{
    /** @var \Test\CustomerVouchers\Model\VoucherStatusFactory */
    private $voucherStatusFactory;

    /** @var \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus */
    private $voucherStatusResource;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Test\CustomerVouchers\Model\VoucherStatusFactory $voucherStatusFactory,
        \Test\CustomerVouchers\Model\ResourceModel\VoucherStatus $voucherStatusResource,
        array $components = [],
        array $data = []
    ) {
        $this->voucherStatusFactory = $voucherStatusFactory;
        $this->voucherStatusResource = $voucherStatusResource;

        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');

                $voucherStatus = $this->voucherStatusFactory->create();
                $this->voucherStatusResource->load($voucherStatus, $item['status_id']);

                $item[$name] = $voucherStatus->getStatusCode();
            }
        }

        return $dataSource;
    }
}
