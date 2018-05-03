<?php 

namespace App\Services;
use Response;

class ApiResponse  {

	protected $status;

	public function __construct($status = '200')
	{
		$this->status = $status;
	} 

	public static function json($response, $status = '200')
	{
		$resp = array(
				'status' => $status,
				'response' => $response
			);

		return Response::json($resp, 200);
	}
}
