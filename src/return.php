<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Store.php');

$store = new Store();
$response = $store->requestPayment(99.17);
var_dump($response);
echo '<a href="'.$store->getPaypalRedirectUrl($response['TOKEN']).'">lien</a>';

if($_GET) {
	$payerID = $_GET['PayerID'];
	$tokenID = $_GET['token'];

	$getPayment = $store->getPayment($tokenID, $payerID);
	if($getPayment) {
		$store->capturePayment($tokenID, $payerID);
	}
}

?>