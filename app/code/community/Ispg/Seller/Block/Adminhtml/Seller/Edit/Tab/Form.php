<?php

class Ispg_Seller_Block_Adminhtml_Seller_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('seller_form', array('legend'=>Mage::helper('seller')->__('Order information')));
     
      $fieldset->addField('order_id', 'text', array(
          'label'     => Mage::helper('seller')->__('Order Number'),
          'class'     => 'required-entry',
          'readonly'  => 'readonly',
          'required'  => true,
          'name'      => 'order_id',
      ));

      $fieldset->addField('email', 'text', array(
          'label'     => Mage::helper('seller')->__('Customer Email ID'),
          'class'     => 'required-entry',
          'readonly'  => 'readonly',
          'required'  => true,
          'name'      => 'email',
      ));

      $fieldset->addField('payment_status', 'select', array(
          'label'     => Mage::helper('seller')->__('Payment Status'),
          'name'      => 'payment_status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('seller')->__('Pending'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('seller')->__('Done'),
              ),
          ),
      ));

      $fieldset->addField('order_status', 'select', array(
          'label'     => Mage::helper('seller')->__('Order Status'),
          'name'      => 'order_status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('seller')->__('Pending'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('seller')->__('Done'),
              ),

              array(
                  'value'     => 3,
                  'label'     => Mage::helper('seller')->__('Rejected'),
              ),

          ),
      ));

      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('seller')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('seller')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('seller')->__('Disabled'),
              ),
          ),
      ));
     
      /*$fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('seller')->__('Content'),
          'title'     => Mage::helper('seller')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));*/
     
      if ( Mage::getSingleton('adminhtml/session')->getSellerData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSellerData());
          Mage::getSingleton('adminhtml/session')->setSellerData(null);
      } elseif ( Mage::registry('seller_data') ) {
          $form->setValues(Mage::registry('seller_data')->getData());
      }
      return parent::_prepareForm();
  }
}