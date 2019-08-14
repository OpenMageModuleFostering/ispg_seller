<?php

class Ispg_Seller_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getCustomerInfo()
    {
        $customer=Mage::getSingleton('customer/session')->getCustomer();
        if(!$customer->getIsActive())
            Mage::getSingleton('customer/session')->setBeforeAuthUrl(Mage::helper("core/url")->getCurrentUrl());
        return $customer;
    }

    public function checkCustomerLogin()
    {
        if($this->getCustomerInfo()->getIsActive())
            return true;
        else
            return false;
    }

    public function getPrdName($prdid)
    {
        $_product = Mage::getModel('catalog/product')->load($prdid);
        return ($_product->getName());
    }

    public function getPrdPrice($prdid)
    {
        $_product = Mage::getModel('catalog/product')->load($prdid);
        $original_price=$_product->getPrice();
        $reduction_price=($this->getPriceReduction()/100)*$original_price;
        return ($original_price-$reduction_price);
    }

    public function getPriceReduction()
    {
        $price_reduction=Mage::getStoreConfig('seller_option/sellprices/reduction');
        if($price_reduction==''){
            $price_reduction=0.0;
        }
        return $price_reduction;
    }

    public function getCartTotal($sellcart)
    {
        $total=0;
        foreach($sellcart as $prdId=>$prdInfoArr){
            $singlePrice=$this->getPrdPrice($prdId);
            $qty=$prdInfoArr['quantity'];
            $total=$total+($singlePrice*$qty);
        }
        return $total;
    }

    public function getTimestamp($datetime)
    {
        $datetimeArr=explode(" ",$datetime);
        $dateArr=explode("-",$datetimeArr[0]);
        $timeArr=explode(":",$datetimeArr[1]);
        return mktime($timeArr[0],$timeArr[1],$timeArr[2],$dateArr[1],$dateArr[2],$dateArr[0]);
    }

    public function getCurrencySymbol()
    {
        return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
    }

}