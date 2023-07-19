<?php
require_once '../functions.php';    
require_once('../config.z2.php');
$name = $_GET['name'];
$html = getMenuFromDB($pdo, $name);
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
libxml_use_internal_errors(false);
$xpath = new DOMXPath($doc);
echo '<br>';

$stmt = $pdo->prepare('SELECT COUNT(*) FROM jedalny_listok WHERE meno = ?');
$stmt->execute([$name]);
$count = $stmt->fetchColumn();

if ($count == 0) {
$stmt = $pdo->prepare('INSERT INTO jedalny_listok (den, jedlo_nazov, cena, meno) VALUES (:den, :jedlo_nazov, :cena, :meno)');

$days = ['pondelok', 'utorok', 'streda', 'stvrtok', 'piatok'];
echo '<br>';

echo "Meno: " . $name  ;
echo '<br>';
foreach ($days as $day) {
    $day_name = $doc->getElementById($day.'_t')->textContent;
    $day_name = mb_strtolower($day_name);
    
    $dishes = [];
    $elements = $xpath->query('//div[@id="'.$day.'"]//b');
    foreach ($elements as $element) {
        $dish = trim($element->textContent);
        $dish = ucfirst(mb_strtolower($dish));
        if (!empty($dish)) {
            $dishes[] = $dish;
        }    
    }
    $elements = $xpath->query('//div[@id="'.$day.'"]//h4');
    foreach ($elements as $element) {
        $dish = trim($element->textContent);
        $dish = ucfirst(mb_strtolower($dish));
        if (!empty($dish)) {
            $dishes[] = $dish;
        }    }
foreach ($dishes as $dish) {
    $stmt->execute(array(
        ':den' => $day_name,
        ':jedlo_nazov' => $dish,
        ':cena' => '7.00€',
        ':meno' => 'restauracia-drag'
    ));
}
echo '<br>';

echo "Den " . $day . " uspesne zapisany! " ;
}
}
else{
    echo "" . $name ." je uz raz rozparsovana!";
}
if (isset($_GET['r_url'])) {
    $R_URL = $_GET['r_url'];

$redirect_url = $R_URL;
$delay_time = 3;
header("Refresh: $delay_time; URL=$redirect_url");

echo '<a>';
echo '<br>';
echo "You will be redirected to $redirect_url in $delay_time seconds...";
echo '</a>';
}
die();
?>


