<?php

class Ispg_Seller_Model_Mysql4_Seller extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the seller_id refers to the key field in your database table.
        $this->_init('seller/seller', 'seller_id');
    }
}