<?php

return [

	/**
	 * Facebook Application Information
	 */
	'facebookApp' => [
		'id' => '185471678482931',
		'secret' => '1dee3c745aa1b3c93638c0851d831743',
		'callbackUrl' => 'http://localhost/saloonappbackend/public/index.php/auth/facebook/callback/',
	],
	
	'status' => [
		'OK' => 200
	],

	'vendor' => [
		'nearby_distance' => 50,
	],

	'app'=>[

		'about'=>"about",
		'terms_agreement'=>"terms_agreement"
	],

	'twilio' => [

		'sid' => 'ACd25d6a8ce4f1ee3e4ac4e0458c296a9d',
		'token' => 'e5225bcda36652585a6da6e046fd892f',
		'from' => '+1 856-288-7812',
		'ssl_verify' => true
	],
];