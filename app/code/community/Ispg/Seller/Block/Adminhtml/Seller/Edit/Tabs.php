<?php

class Ispg_Seller_Block_Adminhtml_Seller_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('seller_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('seller')->__('Sell Order Details'));
  }

  protected function _beforeToHtml()
  {
      // Orders List  
      $this->addTab('form_section', array(
          'label'     => Mage::helper('seller')->__('Order Information'),
          'title'     => Mage::helper('seller')->__('Order Information'),
          'content'   => $this->getLayout()->createBlock('seller/adminhtml_seller_edit_tab_form')->toHtml(),
      ));

      // Products List  
      $this->addTab('products_section', array(
          'label'     => Mage::helper('seller')->__('Products Information'),
          'title'     => Mage::helper('seller')->__('Products Information'),
          'content'   => $this->getLayout()->createBlock('seller/adminhtml_seller_edit_tab_products')->toHtml(),
      ));

      // Bank Info 
      $this->addTab('bankinfo_section', array(
          'label'     => Mage::helper('seller')->__('Bank Information'),
          'title'     => Mage::helper('seller')->__('Bank Information'),
          'content'   => $this->getLayout()->createBlock('seller/adminhtml_seller_edit_tab_bankinfo')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}