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
    echo '<br>';

echo "Meno: " . $name  ;
echo '<br>';
$days = ['day_1', 'day_2', 'day_3', 'day_4', 'day_5'];

$day_names = [
    'day_1' => 'pondelok',
    'day_2' => 'utorok',
    'day_3' => 'streda',
    'day_4' => 'štvrtok',
    'day_5' => 'piatok',
];

$stmt = $pdo->prepare("INSERT INTO jedalny_listok (den, jedlo_nazov, cena, meno) VALUES (:den, :jedlo_nazov, :cena, :meno)");
foreach ($days as $day) {
    $day_name = $day_names[$day];
    $day_div = $xpath->query("//div[@id='$day']")->item(0);
    $food_elements = $xpath->query(".//ul[contains(@class, 'menu-listing')]/li", $day_div);
    foreach ($food_elements as $food_element) {
        $leftbar_div = $xpath->query(".//div[contains(@class, 'leftbar')]", $food_element)->item(0);
        $rightbar_div = $xpath->query(".//div[contains(@class, 'rightbar')]", $food_element)->item(0);
        
        $food_name = $leftbar_div->getElementsByTagName('h5')->item(0)->textContent;
        $food_name = ucwords(mb_strtolower(trim($food_name), "UTF-8"));
        
        if (substr($food_name, -1) === ',') {
            $next_element = $leftbar_div->getElementsByTagName('h5')->item(1);
            while ($next_element && $next_element->nodeName !== 'h5') {
                if ($next_element->nodeName === '#text' && trim($next_element->textContent) !== '') {
                    $food_name .= ' ' . ucwords(mb_strtolower(trim($next_element->textContent), "UTF-8"));
                }
                $next_element = $next_element->nextSibling;
            }
        }
        $price = '';
        $price_element = $rightbar_div->getElementsByTagName('h5')->item(0);
        if (strpos($price_element->textContent, '€') !== false) {
            $price = trim($price_element->textContent);
        }
        $name = "restauracia-venza";
     
        if (!empty($food_name) && !empty($price)) {
            $stmt->bindParam(':den', $day_name);
            $stmt->bindParam(':jedlo_nazov', $food_name);
            $stmt->bindParam(':cena', $price);
            $stmt->bindParam(':meno', $name);
            $stmt->execute();
        }
    }
    echo '<br>';

    echo "Den " . $day_name . " uspesne zapisany! " ;
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

