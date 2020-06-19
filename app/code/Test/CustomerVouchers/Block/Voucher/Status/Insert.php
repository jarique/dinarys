<?php

namespace Test\CustomerVouchers\Block\Voucher\Status;

class Insert extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        return parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('customervouchers/voucher_status/save');
    }
}
