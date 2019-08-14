<?php
class Ispg_Seller_Block_Sellorders extends Mage_Core_Block_Template
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

    public function customerOrders()
    {
        $custId=Mage::helper('seller')->getCustomerInfo()->getId();
        return Mage::getModel('seller/seller')->getCustomerOrderDetails($custId);
    }

    public function orderDetails($ordId)
    {
        return Mage::getModel('seller/seller')->getProductDetails($ordId);
    }

    public function getPaymentStatus($stsId)
    {
        switch($stsId){
            case 1:
                $stsStatus="Pending";
                break;
            case 2:
                $stsStatus="Done";
                break;
        }
        return $stsStatus;
    }

    public function getOrderStatus($stsId)
    {
        switch($stsId){
            case 1:
                $stsStatus="Pending";
                break;
            case 2:
                $stsStatus="Done";
                break;
            case 3:
                $stsStatus="Rejected";
                break;
        }
        return $stsStatus;
    }

}