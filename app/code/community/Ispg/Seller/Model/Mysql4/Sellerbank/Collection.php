<?php

class Ispg_Seller_Model_Mysql4_Sellerbank_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('seller/sellerbank');
    }
}