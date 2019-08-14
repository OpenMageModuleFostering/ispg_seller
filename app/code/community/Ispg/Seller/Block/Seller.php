<?php
class Ispg_Seller_Block_Seller extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
    /*public function getSeller()     
     { 
        if (!$this->hasData('seller')) {
            $this->setData('seller', Mage::registry('seller'));
        }
        return $this->getData('seller');
        
    }*/

     public function getSellercart()     
     { 
        if (!$this->hasData('sellcart')) {
            $this->setData('sellcart', Mage::registry('sellcart'));
        }
        return $this->getData('sellcart');
        
    }

}