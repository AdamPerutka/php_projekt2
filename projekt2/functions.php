
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config.z2.php');


function getPageContent($db, $url, $name) {
    // Funkcia ktora pomocou cURL ulozi stranku definovanu v $url
    // a ulozi do databazy pod nazvom $name.

    // cURL inicializacia
    $ch = curl_init();

    // Konfiguracia cURL: zadam stranku, ktoru chcem parsovat a navratovy typ -> 1=string.
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Vykonanie cURL dopytu.
    $output = curl_exec($ch);

    // Slusne ukoncim a uvolnim cURL.
    curl_close($ch);

    // Vlozim obsah stranky do databazy.
    $sql = "INSERT INTO sites (name, html) VALUES (:name, :html)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":html", $output, PDO::PARAM_STR);

    if ($stmt->execute()) {
    } else {
        echo "Ups. Nieco sa pokazilo";
    }

    unset($stmt);
}
function getMenuFromDB($db, $name) {
    // Funkcia ziska html obsah z databazy.
    $page_content = "";
    $sql = "SELECT html FROM sites WHERE name = :name LIMIT 1";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        $page_content = $row["html"];
    } else {
            echo "Nenachadza sa v tabulke";
            $R_URL = $_GET['r_url'];
    // print_r($_GET);


    $redirect_url = $R_URL;
    $delay_time = 3;
    header("Refresh: $delay_time; URL=$redirect_url");

    echo '<a>';
    echo '<br>';
    echo "You will be redirected to $redirect_url in $delay_time seconds...";
    echo '</a>';

    }

    return $page_content;

}
function rozparsovat1($name, $pdo)
{
    
}