<?php

namespace Test\CustomerVouchers\Observer;

class ActionObserver implements \Magento\Framework\Event\ObserverInterface
{
    /** @var \Magento\Customer\Model\Session */
    private $customerSession;

    /** @var \Magento\Framework\App\ResponseFactory */
    private $responseFactory;

    /** @var \Magento\Framework\UrlInterface */
    private $url;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->customerSession = $customerSession;
        $this->responseFactory = $responseFactory;
        $this->url = $url;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $controllerName  = $observer->getControllerAction()->getRequest()->getControllerName();

        if (in_array($controllerName, ['voucher', 'voucher_status']) && !$this->customerSession->isLoggedIn()) {
            $redirectionUrl = $this->url->getUrl('customer/account/login');

            $observer->getControllerAction()->getResponse()->setRedirect($redirectionUrl);
        }
    }
}
