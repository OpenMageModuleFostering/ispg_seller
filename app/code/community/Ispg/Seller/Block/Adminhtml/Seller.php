<?php
class Ispg_Seller_Block_Adminhtml_Seller extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_seller';
    $this->_blockGroup = 'seller';
    $this->_headerText = Mage::helper('seller')->__('Orders Manager');
    //$this->_addButtonLabel = Mage::helper('seller')->__('Add Item');
    parent::__construct();
    $this->_removeButton('add');
  }
}