<?php

class TestController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$params=$this->_request->getParams();
    	

    	// Set the configuration parameters
    	$config = array(
    			'adapter'      => 'Zend_Http_Client_Adapter_Socket',
    			'ssltransport' => 'tls'
    	);
    	
    	// Instantiate a client object
    	$client = new Zend_Http_Client('http://preproduccion.travelnet.com.mx/package/api/method/loginTNW', $config);
    	//$client->setParameterPost(array('usuario' => 'travelnet','password' => 'migTN7319'));
    	$client->setRawData('{"usuario": "travelnet","password": "migTN7319"}');
    	
    	// The following request will be sent over a TLS secure connection.
    	$response = $client->request();

    	//echo $response->getRawBody();
    	$var = json_decode( $response->getBody() );
    	echo "<pre>".print_r($var,true)."</pre>";die;
    	
    	//echo $response->getMessage();
    	
    }
}

