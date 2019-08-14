<?php

class Ispg_Seller_Model_Seller extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('seller/seller');
    }

    public function getOrderNumber()     
    {
        $defaultOrder="1000";
        $resource = Mage::getSingleton('core/resource');
        $read= $resource->getConnection('core_read');

        $sellersTable = $resource->getTableName('seller');

            
        $selectHighestOrder = $read->select()
           ->from($sellersTable,array('order_id'))
           ->order('order_id DESC') 
           ->limit(1,0);
               
        $sellers_orders = $read->fetchRow($selectHighestOrder);

        //echo "<pre>";print_r($sellers_ordersaddress['order_id']);
        if($sellers_orders['order_id']==''){
            $new_orderId=$defaultOrder;
        } else {
            $new_orderId=$sellers_orders['order_id']+1;
        }
        //echo $new_orderId;exit;
        
        return $new_orderId;
    } 

    public function createOrder($sellCart)     
    {
        $orderId=$this->insertOrder($this->getOrderNumber()); 
        //$totalPrice=Mage::helper('seller')->getCartTotal($sellCart);
        foreach($sellCart as $prId=>$prIdQtyArr){
            //$_product = Mage::getModel('catalog/product')->load($prId);
            $product_name=Mage::helper('seller')->getPrdName($prId);
            $product_price=Mage::helper('seller')->getPrdPrice($prId);
            $qty=$prIdQtyArr['quantity'];
            $prdInfoArr=array(
                                'prdids'=>'',
                                'order_id'=>$orderId,
                                'product_id'=>$prId,
                                'name'=>$product_name,
                                'price'=>$product_price,
                                'qty'=>$qty,
                                'subtotal'=>($product_price*$qty)
                               );
            $this->insertProducts($prdInfoArr);
        }
    }

    public function insertOrder($orderId)     
    {
        $orderInfoArr=array(
                            'seller_id'=>'',
                            'order_id'=>$orderId,
                            'customer_id'=>Mage::helper('seller')->getCustomerInfo()->getId(),
                            'email'=>Mage::helper('seller')->getCustomerInfo()->getEmail(),
                            'payment_status'=>1,
                            'order_status'=>1,
                            'status'=>1,
                            'created_time'=>date('Y-m-d h:i:s'),
                            'update_time'=>date('Y-m-d h:i:s')
                           );
        //echo "<pre>";print_r($orderInfoArr);

        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $ordinfoTable = $connection->getTableName('seller');
        $connection->beginTransaction();
        $connection->insert($ordinfoTable,$orderInfoArr); 
        $connection->commit(); 

        return $orderId;                 
    } 

    public function insertProducts($prdInfoArr)     
    {
        //echo "<pre>";print_r($prdInfoArr);  
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $prdsinfoTable = $connection->getTableName('sellerproducts');
        $connection->beginTransaction();
        $connection->insert($prdsinfoTable,$prdInfoArr); 
        $connection->commit(); 

    }

    public function insertBankinfo($bankInfoArr)     
    {
        $customerId=Mage::helper('seller')->getCustomerInfo()->getId();
        $bankInfoArr['bankinfoid']='';
        $bankInfoArr['customer_id']=$customerId;
        //echo "<pre>";print_r($bankInfoArr);  

        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        $bankinfoTable = $connection->getTableName('sellerbank');
        $connection->beginTransaction();
        if($this->checkCustomerExists($customerId)){
            //echo "<pre>Exists"; 
            unset($bankInfoArr['bankinfoid']);
            $where = $connection->quoteInto('customer_id =?',$customerId);
            $connection->update($bankinfoTable, $bankInfoArr, $where);
        } else {
            //echo "<pre>NoExists";
            $connection->insert($bankinfoTable,$bankInfoArr);
        }
        $connection->commit();

    }

    public function checkCustomerExists($customerId)     
    {
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $bankinfoTable = $read->getTableName('sellerbank');
            
        $cstArr = $read->select()
           ->from($bankinfoTable,array('customer_id'))
           ->where('customer_id=?',$customerId);
               
        $csts = $read->fetchAll($cstArr);

        if(count($csts)>0){
            return true;
        } else {
            return false;
        }
    }

    public function getOrderDetailsById($sellerId)     
    {
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $ordinfoTable = $read->getTableName('seller');
            
        $cstArr = $read->select()
           ->from($ordinfoTable,'*')
           ->where('seller_id=?',$sellerId);
               
        $csts = $read->fetchAll($cstArr);
        return $csts[0];
    }

    public function getCustomerOrderDetails($custId)     
    {
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $ordinfoTable = $read->getTableName('seller');
            
        $cstArr = $read->select()
           ->from($ordinfoTable,'*')
           ->where('customer_id=?',$custId)
           ->order('seller_id DESC');
               
        $csts = $read->fetchAll($cstArr);
        return $csts;
    }

    public function getProductDetails($ordId)     
    {
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $prdsinfoTable = $read->getTableName('sellerproducts');
            
        $cstArr = $read->select()
           ->from($prdsinfoTable,'*')
           ->where('order_id=?',$ordId);
               
        $csts = $read->fetchAll($cstArr);
        return $csts;
    }

}