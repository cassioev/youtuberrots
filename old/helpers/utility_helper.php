<?php
defined('BASEPATH') OR exit('No direct script access allowed');



function asset_url(){
   return base_url().'assets/';
}

function is_localhost(){
	  
	if (strpos($_SERVER['SERVER_NAME'],'localhost') !== false) 
	    return true;
	 else 
	    return false;
	

}

function random_bg(){
	  
	return rand(1, 5);

}













function get_oauth2_token($code) {

	$client_id =  '783258645866-b3caj961rqa1mgjgjta6o4c9krbsodad.apps.googleusercontent.com';
	$client_secret = 'ORIx_FxnR8lHjWdVJblISMIv';

	if(is_localhost())
		$redirect_uri = 'http://localhost/youtuberoots/';
	else
		$redirect_uri = 'https://youtuberoots.000webhostapp.com/youtuberoots';


	$oauth2token_url = "https://accounts.google.com/o/oauth2/token";
	$clienttoken_post = array(
		"code" => $code,
		"client_id" => $client_id,
		"client_secret" => $client_secret,
		"redirect_uri" => $redirect_uri,
		"grant_type" => "authorization_code"
	);

	$curl = curl_init($oauth2token_url);

	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	$json_response = curl_exec($curl);

	curl_close($curl);

	$authObj = json_decode($json_response, true);
	
	return $authObj;

}

?>