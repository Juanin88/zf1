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
    	
    	$parameters = array(
    			'usuario' => 'travelnet',
    			'password' => 'migTN7319',
    	);	
    
    	$client->setRawData( json_encode($parameters) );
    	
    	// The following request will be sent over a TLS secure connection.
    	$response = $client->request();

    	//echo $response->getRawBody();
    	$var = json_decode( $response->getBody() );
    	echo $var->PARAMS->method;

    	echo "<pre>".print_r($var,true)."</pre>";die;
    	
    	//echo $response->getMessage();
    	
    }
    
 
    public function testAction() {

    }
    
    public function getOperationAction() {
    	
    	$config = array(
    			'adapter'      => 'Zend_Http_Client_Adapter_Socket',
    			'ssltransport' => 'tls'
    	);
    	
    	$user = 'ee17b0fb-8138-4401-8e52-4876101b1faf';
    	$password = 'g7bi=b9bZiPu';
    	
    	$data = '{"application_bundle":""}';
    	$url = "https://sandbox-api.srpago.com/v1/auth/login/application";
    	
    	// Instantiate a client object
    	$client = new Zend_Http_Client($url, $config);
    	$client->setHeaders('Content-type','application/json');
    	$client->setRawData($data);
    	$client->setAuth($user,$password);
    	$client->setMethod("POST");
    	
    	$tokenArray = json_decode( $client->request()->getBody());
    	//echo '<pre>'.print_r($tokenArray,true).'</pre>';
    	
    	$token = $tokenArray->connection->token;
    	//echo $token . '<hr>';
    	$urlOperations = "https://sandbox-api.srpago.com/v1/operations";
    	
    	// Instantiate a client object
    	$client = new Zend_Http_Client($urlOperations, $config);
    	$client->setHeaders('AuthorizationToken','Bearer '.$token);
    	$client->setMethod("GET");
    	
    	//echo $client->request()->getBody();
    	$operations = json_decode( $client->request()->getBody());
    	//echo '<pre>'.print_r($operations,true).'</pre>';
    	
    	$this->_helper->json($operations);
    	
    }
    
    
}

