<?php

require_once '../functions.php';    

require_once('../config.z2.php');
$name = $_GET['name'];

$stmt = $pdo->prepare('SELECT COUNT(*) FROM jedalny_listok WHERE meno = ?');
$stmt->execute([$name]);
$count = $stmt->fetchColumn();

if ($count == 0) {
$output = getMenuFromDB($pdo, $name);
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($output);
libxml_use_internal_errors(false);

echo '<br>';
$freeFoodPart = $dom->getElementById("fayn-food");
$menuList = $freeFoodPart->childNodes[3]->lastElementChild;

$mon = $menuList->firstElementChild;


$tue = $mon->nextElementSibling;
$wen = $tue->nextElementSibling;
$thu = $wen->nextElementSibling;
$fri = $menuList->lastElementChild;

$week = array(
    'mon' => $mon,
    'tue' => $tue,
    'wen' => $wen,
    'thu' => $thu,
    'fri' => $fri
    );

$date_day = $tue->firstElementChild->textContent;

$monday_menu = $tue->lastElementChild;

$polievka = $monday_menu->firstElementChild;
$monday_menu->removeChild($polievka);

$menu1 = $monday_menu->firstElementChild;
$monday_menu->removeChild($menu1);

$menu2 = $monday_menu->firstElementChild;
$monday_menu->removeChild($menu2);

$menu3 = $monday_menu->firstElementChild;
$monday_menu->removeChild($menu3);

$brand = $menu3->getElementsByTagName('span')[0];
$price = $menu3->getElementsByTagName('span')[1];
$menu3->removeChild($brand);
$menu3->removeChild($price);

$dom->loadHTML($output);
$xpath = new DOMXPath($dom);
 
$menu_lists = $xpath->query('//ul[contains(@class, "daily-offer")]');
$fayn_food = $menu_lists[1];
echo '<br>';

echo "Meno: " . $name  ;
echo '<br>';

foreach ($fayn_food->childNodes as $day) {
    if ($day->nodeType === XML_ELEMENT_NODE) {
        $datum = explode(',', $day->firstElementChild->textContent);
        $den = $datum[0];
        $datum_db = trim($datum[1]);

        foreach ($day->lastElementChild->childNodes as $ponuka) 
        {
            $typ = $ponuka->firstElementChild;
            $cena = $ponuka->lastElementChild;

            $ponuka->removeChild($typ); 
            $ponuka->removeChild($cena); 
          
           
            $jedlo_nazov = $ponuka->textContent;
            $cena = $cena->textContent;
     

            try {
                        $sql = ("INSERT INTO jedalny_listok (den, datum, jedlo_nazov, cena, meno)
                                        VALUES (:den,:datum, :jedlo_nazov, :cena, :meno)");
                $stmt = $pdo->prepare($sql);
                
                $stmt->bindParam(':den', $den);
                $stmt->bindParam(':datum', $datum_db);
                $stmt->bindParam(':jedlo_nazov', $jedlo_nazov);
                $stmt->bindParam(':cena', $cena);
                $stmt->bindParam(':meno', $name);
                
                
                $stmt->execute();
            } catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
        }

        echo '<br>';

        echo "Den " . $den . " uspesne zapisany! " ;

    }
}
}
else{
    echo "restauracia: " . $name ." je uz raz rozparsovana!";
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

