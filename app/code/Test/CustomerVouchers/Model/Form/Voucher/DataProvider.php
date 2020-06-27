<?php

namespace Test\CustomerVouchers\Model\Form\Voucher;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    private $loadedData = [];

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Test\CustomerVouchers\Model\ResourceModel\Voucher\CollectionFactory $voucherCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $voucherCollectionFactory->create();

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getWithJoinedStatus();
        /** @var \Test\CustomerVouchers\Model\Voucher $item */
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        return $this->loadedData;
    }
}
