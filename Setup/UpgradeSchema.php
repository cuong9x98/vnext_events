<?php
namespace AHT\CustomCheckout\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;

class UpgradeSchema implements UpgradeSchemaInterface
{
    private $product;

    public function __construct
    (
        \AHT\CustomCheckout\Model\Product\NewProduct $product
    )
    {
       $this->product = $product;
    }

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->product->createProduct();
        }


        $setup->endSetup();
    }

}
