<?php

namespace App\Helpers;

use GuzzleHttp;
use Log;
use Config;

class PushNotificationHandler {
	private $url;
	
	/**
	 * Create a new instance.
	 *
	 * @return void
	 */
	public function __construct() {

	$this->url = 'https://fcm.googleapis.com/fcm/send';
	}
	
	/**
	 * Push Notification GCM
	 *
	 * @param string $appType        	
	 * @param string $token        	
	 * @param string $text        	
	 * @return mixed|unknown
	 */
	public static function pushNotification($appType, $token, $text) {
		$request = [ ];
		// Request for Android
		if ($appType == 'zabs-app-android') {
			$request = [ 
					"to" => "$token",
					"data" => [ 
							"title" => "ZabsApp",
							"message" => "$text" 
					] 
			];
		}
		// Request for iOS
		if ($appType == 'zabs-app-ios') {
			$request = [ 
					"registration_ids" => [ 
							"$token" 
					],
					"notification" => [
							"title" => "ZabsApp",
							"body" => "$text",
							"badge" => "0",
							"sound" => "default"
					],
					"priority" => "high" 
			];
		}

		$jsonRequest = json_encode ($request);
		// Prepare cURL request
		$method = 'POST';
		$url = 'https://fcm.googleapis.com/fcm/send';
		$headers = [ 
				'Content-type' => 'application/json',
				'Authorization' => 'key=' . Config::get ( 'push-notification.' . $appType . '.apiKey' ) 
		];


		$guzzleRequest = new GuzzleHttp\Psr7\Request ( $method, $url, $headers, $jsonRequest );

		// Initialization GuzzleHttp Client for a send request
		$client = new GuzzleHttp\Client ();
		// Hit a cURL request for GCM
		$guzzleResponse = $client->send ( $guzzleRequest );


		// Log push notification request
		Log::info ( print_r ( $guzzleRequest, true ) );
		
		// Log push notification response
		Log::info ( print_r ( $guzzleResponse, true ) );
		
		return true;
	}
}
