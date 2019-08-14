<?php

class Ispg_Seller_Block_Adminhtml_Seller_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'seller';
        $this->_controller = 'adminhtml_seller';
        
        $this->_updateButton('save', 'label', Mage::helper('seller')->__('Save Order'));
        $this->_updateButton('delete', 'label', Mage::helper('seller')->__('Delete Order'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('seller_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'seller_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'seller_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('seller_data') && Mage::registry('seller_data')->getId() ) {
            return Mage::helper('seller')->__("Edit Order '%s'", $this->htmlEscape(Mage::registry('seller_data')->getOrderId()));
        } else {
            return Mage::helper('seller')->__('Add Order');
        }
    }
}