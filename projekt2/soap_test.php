<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Create SOAP client
// Define your SOAP server class
// Create SOAP client

// Define the SOAP client
$client = new SoapClient('https://site181.webte.fei.stuba.sk/zadanie2/soap.wsdl');

// Prepare the input parameters
$params = array(
    'den' => 'pondelok',
    'meno' => 'Example Meal',
    'cena' => 9.99
);

// Call the SOAP function and store the response
$response = $client->insertIntoJedalnyListok($params);

// Display the response
echo $client;

?>

