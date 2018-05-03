<?php

namespace App\Helpers;

use Config;
use PayPal\Api\Authorization;
use PayPal\Api\Amount;
use PayPal\Api\Capture;
use Paypal;
use Log;
use GuzzleHttp;

class PayPalHandler {
	private $_apiContext;

	public function __construct() {
		$this->_apiContext = PayPal::ApiContext ( 
				config ( 'services.paypal.client_id' ), 
				config ( 'services.paypal.secret' ) 
		);

		$this->_apiContext->setConfig ( array (
				'mode' => 'sandbox',
				'service.EndPoint' => 'https://api.sandbox.paypal.com',
				'http.ConnectionTimeOut' => 30,
				'log.LogEnabled' => true,
				'log.FileName' => storage_path ( 'logs/paypal.log' ),
				'log.LogLevel' => 'FINE' 
		) );
	}
	
	protected function convertSARtoUSD($amt) {
		// Prepare cURL request
		$method = 'GET';
		$url = Config::get('constants.YahooCurrencyAPI.SAR');
		
		// Initialization GuzzleHttp Client for a send request
		$client = new GuzzleHttp\Client ();
		$request = $client->get($url);
		$response = json_decode($request->getBody());
		$conversionRate = (float) $response->query->results->rate->Rate;

		return $amt * $conversionRate; 
	}
	
	public function authAndCapture($authorization_id, $amount) {
		$amount = $this->convertSARtoUSD($amount);
		$authorization = new Authorization();
		$authorization->setId($authorization_id);

		$amt = new Amount();
		$amt->setCurrency("USD")->setTotal($amount);
		
		$capture = new Capture();
		$capture->setAmount($amt);
		
		try {
			$getCapture = $authorization->capture($capture, $this->_apiContext);

			return $getCapture;
		} 
		catch (PayPal\Exception\PayPalConnectionException $ex) {
			// Log capture request
			Log::info ($ex->getCode()); // Prints the Error Code
			Log::info ($ex->getData()); // Prints the detailed error message
			$error = json_decode( $ex->getData(), true );
				
			return [ 'error' => $error['message'] ];
		} 
		catch (Exception $ex) {
			Log::info ($ex->getData());
			$error = json_decode( $ex->getData(), true );
			
			return [ 'error' => $error['message'] ];
		}
	}

	public function authAndVoid($authorization_id) {
		$authorization = Authorization::get($authorization_id, $this->_apiContext);
		try {
			$void = $authorization->void($this->_apiContext);
		}	
		catch (PayPal\Exception\PayPalConnectionException $ex) {
			// Log capture request
			Log::info ($ex->getCode()); // Prints the Error Code
			Log::info ($ex->getData()); // Prints the detailed error message
			$error = json_decode( $ex->getData(), true );
			
			return [ 'error' => $error['message'] ];
		}
		catch (Exception $ex) {
			Log::info ($ex->getData());
			$error = json_decode( $ex->getData(), true );
			
			return [ 'error' => $error['message'] ];
		}

		return $void;
	}
}
