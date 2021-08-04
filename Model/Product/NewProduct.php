<?php

namespace AHT\CustomCheckout\Model\Product;

class NewProduct
{
    private $newproduct;

    private $state;

    public function __construct(
        \Magento\Catalog\Model\ProductFactory $newproduct,
        \Magento\Framework\App\State $state
    ) {
        $this->newproduct = $newproduct;
        $this->state = $state;
    }

    public function createProduct()
    {
        $product = $this->newproduct->create();

        $product->setSku('my-sku'); // Set your sku here
        $product->setName('Sample Simple Product'); // Name of Product
        $product->setAttributeSetId(4); // Attribute set id
        $product->setStatus(1); // Status on product enabled/ disabled 1/0
        $product->setWeight(10); // weight of product
        $product->setVisibility(4); // visibilty of product (catalog / search / catalog, search / Not visible individually)
        $product->setTaxClassId(0); // Tax class id
        $product->setTypeId('simple'); // type of product (simple/virtual/downloadable/configurable)
        $product->setPrice(100); // price of product
        $product->setStockData(
            array(
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'is_in_stock' => 1,
                'qty' => 999999999
            )
        );
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
        $product->save();
    }


}
