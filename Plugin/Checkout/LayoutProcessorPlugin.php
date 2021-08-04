<?php
namespace AHT\CustomCheckout\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    public function afterProcess(LayoutProcessor $subject, array $jsLayout)
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['delivery-step']['children']
        ['field-group-delivery']['children']['delivery-comment'] = [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => 'deliveryStepFields',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/textarea',
                'id' => 'delivery_comment_field',
                'cols' => 15,
                'rows' => 5
            ],
            'dataScope' => 'deliveryStepFields.delivery_comment',
            'label' => 'Delivery comment',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'sortOrder' => 150,
            'id' => 'comment_field'
        ];

        return $jsLayout;
    }

}
