<?php
namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use GuzzleHttp;
use Log;
use Config;

class GoogleHandler
{

	private $url;

	private $token;

	private $fields;

	/**
	 * Create a new instance.
	 *
	 * @return void
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}

	/**
	 * Verify google user token
	 * 
	 * @return \App\Libraries\mixed
	 */
	public function verifyToken()
	{
		$this->url = 'https://www.googleapis.com/oauth2/v3/tokeninfo';

		return $this->send();
	}

	/**
	 * Send Guzzle request
	 * 
	 * @return mixed|boolean
	 */
	public function send()
	{
		$client = new GuzzleHttp\Client(['http_errors' => false]);
		
		$response = $client->get($this->url, [
				'query' => [
					'id_token' => $this->token
				]
		]);

		$status  = $response->getStatusCode();
		Log::info(print_r($response,true));

		if($status == Config::get('constants.status.OK'))
		{
			$content = $response->getBody()->getContents();
			Log::info($content);
			return json_decode($content);
		}

		return false;
	}
}