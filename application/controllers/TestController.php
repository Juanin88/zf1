<?php

/**
 * 
 * @author JGarfias
 *
 */
class TestController extends Zend_Controller_Action {


    public function indexAction() {
    	
    }
    
 
    public function testAction() {
    	//
    	try {
    	echo Application_Model_Services_Test::test();
    	} catch (Exception $e) {
    		echo $e;
    	}
    }
    
    public function getOperationAction() {
    	
    	$user = 'ee17b0fb-8138-4401-8e52-4876101b1faf';
    	$password = 'g7bi=b9bZiPu';
    	$srPago = new Application_Model_Services_SrPago();
    
    	$this->_helper->json( $srPago->getSrPagoOperations( $srPago->getToken($user, $password) ) );
    	

    }
    
}