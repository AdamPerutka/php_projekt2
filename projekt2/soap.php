<?php

// include database connection information
include 'config.z2.php';

// define the class that implements the SOAP service methods
class JedalnyListokAPI {
    public function insertIntoJedalnyListok($den, $meno, $cena) {

        // prepare the SQL statement and bind parameters
        $stmt = $pdo->prepare('INSERT INTO jedalny_listok (den, meno, cena) VALUES (?, ?, ?)');
        $stmt->bind_param('isd', $den, $meno, $cena);

        // execute the statement and return the result
        if (!$stmt->execute()) {
            throw new Exception('Failed to execute SQL statement: ' . $stmt->error);
        }
        return "OK";
    }
}

// create a new SOAP server and add the service class to it
$server = new SoapServer("https://site181.webte.fei.stuba.sk/zadanie2/soap.wsdl");
$server->setClass("JedalnyListokAPI");

// handle incoming SOAP requests
$server->handle();

?>
