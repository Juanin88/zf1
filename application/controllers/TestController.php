<?php

/**
 * 
 * @author JGarfias
 *
 */
class TestController extends Zend_Controller_Action
{


    public function indexAction()
    {
    	
    }
    
 
    public function testAction() {

    }
    
    public function getOperationAction() {
    	
    	$user = 'ee17b0fb-8138-4401-8e52-4876101b1faf';
    	$password = 'g7bi=b9bZiPu';
    	
    	$srPago = new Application_Model_Services_SrPago();
    
    	$this->_helper->json( $srPago->getSrPagoOperations( $srPago->getToken($user, $password) ) );
    	
    }
    
    
}

