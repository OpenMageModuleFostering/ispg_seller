<?php

class Ispg_Seller_Model_Sellerbank extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('seller/sellerbank');
    }


}