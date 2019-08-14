<?php

class Ispg_Seller_Block_Adminhtml_Seller_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      //$this->removeButton('add');
      $this->setId('sellerGrid');
      $this->setDefaultSort('seller_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('seller/seller')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('order_id', array(
          'header'    => Mage::helper('seller')->__('Order Number'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'order_id',
      ));

      $this->addColumn('email', array(
          'header'    => Mage::helper('seller')->__('Customer Email ID'),
          'align'     =>'left',
          'width'     => '100px',
          'index'     => 'email',
      ));

      $this->addColumn('payment_status', array(
          'header'    => Mage::helper('seller')->__('Payment Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'payment_status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Pending',
              2 => 'Done',
          ),
      ));

      $this->addColumn('order_status', array(
          'header'    => Mage::helper('seller')->__('Order Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'order_status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Pending',
              2 => 'Done',
              3 => 'Rejected',
          ),
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('seller')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      $this->addColumn('status', array(
          'header'    => Mage::helper('seller')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('seller')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('seller')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('seller')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('seller')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('seller_id');
        $this->getMassactionBlock()->setFormFieldName('seller');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('seller')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('seller')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('seller/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('seller')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('seller')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}