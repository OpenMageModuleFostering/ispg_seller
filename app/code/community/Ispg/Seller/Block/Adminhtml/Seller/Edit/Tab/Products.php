<?php

class Ispg_Seller_Block_Adminhtml_Seller_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      /*$this->setId('sellerProductsGrid');
      $this->setDefaultSort('prdids');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);*/
  }

  protected function _prepareCollection()
  {
      $orderDetailsArr = Mage::getModel('seller/seller')->getOrderDetailsById($this->getRequest()->getParam('id'));
      $collection = Mage::getModel('seller/sellerproducts')->getCollection();
      $collection->getSelect()->where('order_id=?',$orderDetailsArr['order_id']);
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('name', array(
          'header'    => Mage::helper('seller')->__('Product Name'),
          'align'     =>'left',
          'width'     => '150px',
          'index'     => 'name',
      ));

      $this->addColumn('price', array(
          'header'    => Mage::helper('seller')->__('Price'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'price',
      ));

      $this->addColumn('qty', array(
          'header'    => Mage::helper('seller')->__('Quantity'),
          'align'     =>'left',
          'width'     => '50px',
          'index'     => 'qty',
      ));

      $this->addColumn('subtotal', array(
          'header'    => Mage::helper('seller')->__('Subtotal'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'subtotal',
      ));
      
      return parent::_prepareColumns();
  }

}