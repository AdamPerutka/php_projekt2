<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'functions.php';    
require_once('config.z2.php');
// // Define the WSDL
// $wsdl = "http://localhost/api/food.wsdl";

// // Define the namespace
// $namespace = "http://localhost/api/";

// // Define the SOAP server
// $options = array(
//     'uri' => $namespace,
// );
// $server = new SoapServer($wsdl, $options);
// Define the SOAP server class
class MySoapServer
{
    private $pdo;

    public function __construct()
    {
        // Initialize the PDO connection
        $this->pdo;
    }

    public function addFood($day, $name, $price)
    {
        // Prepare the INSERT query
        $stmt = $this->pdo->prepare('INSERT INTO jedalny_listok (den, jedlo_nazov, cena) VALUES (:den, :jedlo_nazov, :cena)');

        // Bind the parameters and execute the query
        $stmt->bindParam(':den', $day);
        $stmt->bindParam(':jedlo_nazov', $name);
        $stmt->bindParam(':cena', $price);
        $stmt->execute();

        // Return the ID of the new row
        return $this->pdo->lastInsertId();
    }

    public function getAllFood()
    {
        // Prepare the SELECT query
        $stmt = $this->pdo->prepare('SELECT * FROM jedalny_listok');

        // Execute the query and fetch all rows
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the rows as an array
        return $rows;
    }

    public function getHtmlTable()
    {
        // Get all rows from the table
        $rows = $this->getAllFood();

        // Generate the HTML table
        $html = '<table>';
        $html .= '<thead><tr><th>Den</th><th>Jedlo</th><th>Cena</th></tr></thead>';
        $html .= '<tbody>';
        foreach ($rows as $row) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['den']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['jedlo_nazov']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['cena']) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        // Return the HTML table
        return $html;
    }
}

// Create a new instance of the SOAP server and register the methods
$server = new SoapServer(null, array('uri' => 'https://site181.webte.fei.stuba.sk/zadanie2/'));
$server->setClass('MySoapServer');

// Handle the SOAP request
$server->handle();
