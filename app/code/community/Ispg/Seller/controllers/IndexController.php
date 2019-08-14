<?php
class Ispg_Seller_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
        /*$ss = $this->getRequest()->getParam('ss');
        if($ss==1){
            Mage::getSingleton('core/session')->unsSellercart();
            exit;                
        }*/

    	$postData = $this->getRequest()->getPost();
        $sellFormData = $this->getRequest()->getPost('sellform');
        //echo "<pre>";print_r($sellFormData);
        //echo "SellForm-".count($sellFormData);
        $sellCart=Mage::getSingleton('core/session')->getSellercart(); 

        if(Mage::helper('seller')->checkCustomerLogin() && ($postData['prId']!='' || count($sellCart)>0)){

            $customer_id=Mage::helper('seller')->getCustomerInfo()->getId();

            if(array_key_exists($postData['prId'], $sellCart)){
                $sellCart[$postData['prId']]['quantity']=$sellCart[$postData['prId']]['quantity']+1;
            } elseif(count($sellFormData)>0) {
                foreach($sellFormData as $sellprdId=>$sellqtyArr){
                    $sellCart[$sellprdId]['quantity']=$sellqtyArr['qty'];
                }
            } elseif($postData['prId']!='') {
                $sellCart[$postData['prId']]=array(
                                                      'product_id'  => $postData['prId'],
                                                      'quantity'    => 1
                                                  );
            }

            Mage::getSingleton('core/session')->setSellercart($sellCart);
            $sessionCart=Mage::getSingleton('core/session')->getSellercart();
            Mage::register('sellcart', $sessionCart);            
            //echo "<pre>";print_r($sessionCart);
        }
            
        $this->loadLayout();     
        $this->renderLayout();


    }

    public function rmvfromcartAction()
    {
        $prdId = $this->getRequest()->getParam('ss');
        $sessionCart=Mage::getSingleton('core/session')->getSellercart();
        unset($sessionCart[$prdId]);
        Mage::getSingleton('core/session')->setSellercart($sessionCart);
        $this->_redirect('seller');
    }

    public function checkoutAction()
    {
        $sessionCart=Mage::getSingleton('core/session')->getSellercart();
        if(count($sessionCart)==0)
            $this->_redirect('seller');
        Mage::register('sellcart', $sessionCart);            

        $this->loadLayout();     
        $this->renderLayout();
        
    }

    public function submitsellerAction()
    {
        $postData = $this->getRequest()->getPost();
        $sessionCart=Mage::getSingleton('core/session')->getSellercart();
        if(count($sessionCart)==0){
            $this->_redirect('seller');
        } else {
            //Mage::register('sellcart', $sessionCart);    
            Mage::getModel('seller/seller')->createOrder($sessionCart);        
            Mage::getModel('seller/seller')->insertBankinfo($postData);
            Mage::getSingleton('core/session')->unsSellercart();
        }

        $this->loadLayout();     
        $this->renderLayout();
        
    }

    public function sellordersAction()
    {
        if(!Mage::helper('seller')->checkCustomerLogin()){
            $this->_redirect('customer/account/login/');
        } else {
            $this->loadLayout();     
            $this->renderLayout();
        }
    }

}