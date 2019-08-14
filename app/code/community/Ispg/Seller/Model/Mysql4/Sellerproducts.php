<?php

class Ispg_Seller_Model_Mysql4_Sellerproducts extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the 'prdids' refers to the key field in your database table.
        $this->_init('seller/sellerproducts', 'prdids');
    }
}