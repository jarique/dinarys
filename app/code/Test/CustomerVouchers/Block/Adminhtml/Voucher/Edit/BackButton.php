<?php

namespace Test\CustomerVouchers\Block\Adminhtml\Voucher\Edit;

class BackButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /** @var \Magento\Framework\UrlInterface */
    private $urlBuilder;

    public function __construct(\Magento\Backend\Block\Widget\Context $context)
    {
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('customervouchers/voucher/index')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    private function getUrl($route, $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
