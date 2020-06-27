<?php

namespace Test\CustomerVouchers\Controller\Adminhtml\Voucher;

class Edit extends \Magento\Backend\App\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    private $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Edit voucher')));

        return $resultPage;
    }
}
