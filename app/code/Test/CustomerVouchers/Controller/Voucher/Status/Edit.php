<?php

namespace Test\CustomerVouchers\Controller\Voucher\Status;

class Edit extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\App\Request\Http */
    private $request;

    /** @var \Magento\Framework\View\Result\PageFactory */
    private $resultPageFactory;

    /** @var \Magento\Framework\Registry */
    private $coreRegistry;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->request = $request;
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->request->getParam('id');

        $this->coreRegistry->register('edit_record_id', $id);

        return $this->resultPageFactory->create();
    }
}
