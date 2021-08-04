<?php
namespace AHT\CustomCheckout\Block\Adminhtml\Order;

use AHT\CustomCheckout\Api\Data\CustomFieldsInterface;
use AHT\CustomCheckout\Api\CustomFieldsRepositoryInterface;

class Delivery extends \Magento\Framework\View\Element\Template
{

    protected $_registry;
    protected $_customFieldsRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        CustomFieldsRepositoryInterface $customFieldsRepository,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_customFieldsRepository = $customFieldsRepository;
        $this->_isScopePrivate = true;
        parent::__construct($context, $data);
    }

    public function getCurrentOrder() {
        return $this->_registry->registry('current_order');
    }

    public function getDeliveryInfo() {
        $a = $this->_customFieldsRepository->getCustomFields($this->getCurrentOrder());
        return $a;
    }

//    public function getIdOrder() {
//        $a = $this->_customFieldsRepository->getCustomFields($this->getCurrentOrder());
//        return $a;
//    }
    public function getOrderId() {
        return $this->getRequest()->getParam('order_id');
    }

    public function getEditLink($label = '')
    {
        if (empty($label)) {
            $label = __('Edit');
        }
        $url = $this->getUrl('sales/order/delivery', ['id' => $this->getOrderId()]);
        return '<a href="' . $this->escapeUrl($url) . '">' . $this->escapeHtml($label) . '</a>';
    }
}
