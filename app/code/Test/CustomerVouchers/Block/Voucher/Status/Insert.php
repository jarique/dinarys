<?php

namespace Test\CustomerVouchers\Block\Voucher\Status;

class Insert extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return null
     */
    public function getRecord()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('customervouchers/voucher_status/save');
    }
}
