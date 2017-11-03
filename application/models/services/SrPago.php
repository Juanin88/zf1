<?php
/**
 * 
 * @author JGarfias
 *
 */
class Application_Model_Services_SrPago {
	
	/**
	 * 
	 */
	public function __construct() {
		$this->config = array(
				'adapter'      => 'Zend_Http_Client_Adapter_Socket',
				'ssltransport' => 'tls'
		);
	}
	
	/**
	 * 
	 * @param string $user
	 * @param string $password
	 * @return string
	 */
	public function getToken($user,$password) {

		$url = "https://sandbox-api.srpago.com/v1/auth/login/application";
		
		// Instantiate a client object
		$client = new Zend_Http_Client($url, $this->config);
		$client->setHeaders('Content-type','application/json');
		$client->setRawData('{"application_bundle":""}');
		$client->setAuth($user,$password);
		$client->setMethod("POST");
		
		$tokenArray = json_decode( $client->request()->getBody());
		
		return $tokenArray->connection->token;
		
	}

	/**
	 * 
	 * @param string $token
	 * @return object
	 */
	public function getSrPagoOperations($token) {

		$urlOperations = "https://sandbox-api.srpago.com/v1/operations";
		
		// Instantiate a client object
		$client = new Zend_Http_Client($urlOperations, $this->config);
		$client->setHeaders('AuthorizationToken','Bearer '.$token);
		$client->setMethod("GET");
		
		$operations = json_decode( $client->request()->getBody());
		
		return $operations;
	}
}