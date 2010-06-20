<?php

require(dirname(__FILE__) . '/../lib/ThreeScaleInterface.php');

$host = "http://server.3scale.net";

// Put your provider authentication key here:
$provider_key = "3scale-xxx";

// Put some user key here (you can test it with the one from test contract):
$user_key = "3scale-yyy";

$client = new ThreeScaleClient($provider_key);

// Auth the users key
$response = $client->authorize($user_key);

// Check the response type
if ($response->isSuccess()) {
	// All fine, proceeed & pull the usages
	$usages = $response->getUsages();
	
	echo "Success: ".$response->getPlan();
	echo "Success: ".var_export($usages,true);

	// Handle the current issues with the test keys
	if (count($usages)>0) {
		$usage  = $usages[0];
		echo "Success: ".var_export($usage,true);		  
	}
} else {
	// Something's wrong with this user.
	$errors = $response->getErrors();
	$error  = $errors[0];
	echo "Error: ".var_export($error->getMessage(),true);			
}
	
// Report some usages
$response = $client->report(
	array(
	  array('user_key' => "a47bf3fd07cdef0957bfc154c2a4cac0",  'usage' => array('hits' => 1)),
	  array('user_key' => "a47bf3fd07cdef0957bfc154c2a4cac0", 'usage' => array('hits' => 1))
	)
);
		  
?>
