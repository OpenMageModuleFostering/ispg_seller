<?php
class Ispg_Seller_Block_Button extends Mage_Core_Block_Template
{

    /**
     * Retrieve current product model
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getSellProduct()
    {
        if (!Mage::registry('product') && $this->getProductId()) {
            $product = Mage::getModel('catalog/product')->load($this->getProductId());
            Mage::register('product', $product);
        }
        return Mage::registry('product');
    }

    public function getCustomerInfo()
    {
        return Mage::helper('seller')->getCustomerInfo();
    }

    public function getSellerUrl()
    {
        if($this->getCustomerInfo()->getIsActive())
            $sellerUrl=$this->getUrl('seller');
        else 
            $sellerUrl=$this->getUrl('customer/account/login/');
        return $sellerUrl;
    }

}