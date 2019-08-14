<?php

class Ispg_Seller_Block_Adminhtml_Seller_Edit_Tab_Bankinfo extends Mage_Adminhtml_Block_Widget_Grid
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
      $collection = Mage::getModel('seller/sellerbank')->getCollection();
      $collection->getSelect()->where('customer_id=?',$orderDetailsArr['customer_id']);
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('firstname', array(
          'header'    => Mage::helper('seller')->__('First Name'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'firstname',
      ));

      $this->addColumn('lastname', array(
          'header'    => Mage::helper('seller')->__('Last Name'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'lastname',
      ));

      $this->addColumn('telephone', array(
          'header'    => Mage::helper('seller')->__('Telephone'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'telephone',
      ));

      $this->addColumn('acc_name', array(
          'header'    => Mage::helper('seller')->__('Account Name'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'acc_name',
      ));

      $this->addColumn('acc_num', array(
          'header'    => Mage::helper('seller')->__('Account Number'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'acc_num',
      ));

      $this->addColumn('acc_bank', array(
          'header'    => Mage::helper('seller')->__('Bank'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'acc_bank',
      ));

      $this->addColumn('acc_branch', array(
          'header'    => Mage::helper('seller')->__('Branch'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'acc_branch',
      ));

      $this->addColumn('acc_ifsc', array(
          'header'    => Mage::helper('seller')->__('IFSC'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'acc_ifsc',
      ));

      return parent::_prepareColumns();
  }

}