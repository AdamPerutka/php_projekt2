<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'functions.php';    
require_once('config.z2.php');

if (isset($_GET['name'])) {

$URL = $_GET['url'];
$name = $_GET['name'];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM sites WHERE name = ?");
$stmt->execute([$name]);
if ($stmt->fetchColumn() == 0) {

    $result = getPageContent($pdo, $URL, $name);

    echo "Site downloaded successfully";
} else {
    echo "Name already exists in table";
}



}
else{
    $name1 = "restauracia-venza";
    $name2 = "restauracia-drag";
    $name3 = "free-food";

    $url1 = "https://www.novavenza.sk/tyzdenne-menu";
    $url2 = "https://www.restauracia-drag.sk/restauracia-drag"; 
    $url3 = "http://www.freefood.sk/menu/#fayn-food";

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM sites WHERE name = ?");
    $stmt->execute([$name1]);
    if ($stmt->fetchColumn() == 0) {
    
        $result = getPageContent($pdo, $url1, $name1);
    
        echo "Site $name1 downloaded successfully";
        echo '<br>';
    } else {
        echo "Name $name1 already exists in table";
        echo '<br>';

    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM sites WHERE name = ?");
    $stmt->execute([$name2]);
    if ($stmt->fetchColumn() == 0) {
    
        $result = getPageContent($pdo, $url2, $name2);
    
        echo "Site $name2 downloaded successfully";
        echo '<br>';
    } else {
        echo "Name $name2 already exists in table";
        echo '<br>';

    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM sites WHERE name = ?");
    $stmt->execute([$name3]);
    if ($stmt->fetchColumn() == 0) {
    
        $result = getPageContent($pdo, $url3, $name3);
        echo "Site $name3 downloaded successfully";
        echo '<br>';
    } else {
        echo "Name $name3 already exists in table";
        echo '<br>';

    }
    
  
    
}
$R_URL = $_GET['r_url'];
// print_r($_GET);


$redirect_url = $R_URL;
$delay_time = 3;
header("Refresh: $delay_time; URL=$redirect_url");

echo '<a>';
echo '<br>';
echo "You will be redirected to $redirect_url in $delay_time seconds...";
echo '</a>';

?>