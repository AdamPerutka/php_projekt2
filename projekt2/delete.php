
<?php

if (isset($_GET['name'])) {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config.z2.php');
$URL = $_GET['url'];

$site_to_delete = $_GET['name'];
// echo  $site_to_delete;
$stmt1 = $pdo->prepare("DELETE FROM sites WHERE name = ?");
$stmt1->execute([$site_to_delete]);
$count1 = $stmt1->rowCount();
echo '<br>';

if ($count1 > 0) {
 echo "Record deleted successfully from sites table";
} else {
    $errorInfo = $stmt1->errorInfo();
    // echo "Error: " . $errorInfo[2];
     echo "Error deleting record from sites table " ;
}
$stmt2 = $pdo->prepare("DELETE FROM jedalny_listok WHERE meno = ?");
$stmt2->execute([$site_to_delete]);
$count2 = $stmt2->rowCount();
echo '<br>';

if ($count2 > 0) {
 echo "Record deleted successfully from jedalny_listok table";
} else {
    echo "Error: " . $errorInfo[2];
    echo "Error deleting record from jedalny_listok table";
}
$stmt = $pdo->prepare('SELECT COUNT(*) FROM sites');
$stmt->execute();
$count = $stmt->fetchColumn();
echo '<br>';
if ($count == 0) {
    $pdo->exec('ALTER TABLE sites AUTO_INCREMENT = 1');
    echo "Sites ID successfully reset!";
}
else
{
    echo "No need to reset ID, sites table not empty";

}
echo '<br>';

$stmt = $pdo->prepare('SELECT COUNT(*) FROM jedalny_listok');
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count == 0) {
    $pdo->exec('ALTER TABLE jedalny_listok AUTO_INCREMENT = 1');
    echo "Jedalny_listok ID successfully reset!";

}
else
{
    echo "No need to reset ID, jedalny_listok table not empty";

}


$redirect_url = $URL;
$delay_time = 3;
header("Refresh: $delay_time; URL=$redirect_url");

echo '<a>';
echo '<br>';
echo "You will be redirected to $redirect_url in $delay_time seconds...";
echo '</a>';
}

else if(isset($_GET['name']))
{

    require_once('config.z2.php');
    $URL = $_GET['url'];
    
  
    $stmt2 = $pdo->prepare("DELETE FROM jedalny_listok");
    $stmt2->execute();
    $count2 = $stmt2->rowCount();
    echo '<br>';
    
    if ($count2 > 0) {
     echo "Record deleted successfully from jedalny_listok table";
    } else {
        echo "Error: " . $errorInfo[2];
        echo "Error deleting record from jedalny_listok table";
    }
    echo '<br>';
    
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM jedalny_listok');
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        $pdo->exec('ALTER TABLE jedalny_listok AUTO_INCREMENT = 1');
        echo "Jedalny_listok ID successfully reset!";
    
    }
    else
    {
        echo "No need to reset ID, jedalny_listok table not empty";
    
    }
    
    
    $redirect_url = $URL;
    $delay_time = 3;
    header("Refresh: $delay_time; URL=$redirect_url");
    
    echo '<a>';
    echo '<br>';
    echo "You will be redirected to $redirect_url in $delay_time seconds...";
    echo '</a>';
    
    
    }
else
{

require_once('config.z2.php');
$URL = $_GET['url'];

$site_to_delete = $_GET['name'];
// echo  $site_to_delete;
$stmt1 = $pdo->prepare("DELETE FROM sites");
$stmt1->execute();
$count1 = $stmt1->rowCount();
echo '<br>';

if ($count1 > 0) {
 echo "Record deleted successfully from sites table";
} else {
    $errorInfo = $stmt1->errorInfo();
    // echo "Error: " . $errorInfo[2];
     echo "Error deleting record from sites table " ;
}
$stmt2 = $pdo->prepare("DELETE FROM jedalny_listok");
$stmt2->execute();
$count2 = $stmt2->rowCount();
echo '<br>';

if ($count2 > 0) {
 echo "Record deleted successfully from jedalny_listok table";
} else {
    echo "Error: " . $errorInfo[2];
    echo "Error deleting record from jedalny_listok table";
}
$stmt = $pdo->prepare('SELECT COUNT(*) FROM sites');
$stmt->execute();
$count = $stmt->fetchColumn();
echo '<br>';
if ($count == 0) {
    $pdo->exec('ALTER TABLE sites AUTO_INCREMENT = 1');
    echo "Sites ID successfully reset!";
}
else
{
    echo "No need to reset ID, sites table not empty";

}
echo '<br>';

$stmt = $pdo->prepare('SELECT COUNT(*) FROM jedalny_listok');
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count == 0) {
    $pdo->exec('ALTER TABLE jedalny_listok AUTO_INCREMENT = 1');
    echo "Jedalny_listok ID successfully reset!";

}
else
{
    echo "No need to reset ID, jedalny_listok table not empty";

}


$redirect_url = $URL;
$delay_time = 3;
header("Refresh: $delay_time; URL=$redirect_url");

echo '<a>';
echo '<br>';
echo "You will be redirected to $redirect_url in $delay_time seconds...";
echo '</a>';


}


?>