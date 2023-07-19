<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'config.z2.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        read_listok($pdo);
        break;
    case 'POST':
        create_listok($pdo, $_POST);
        break;
    case 'PUT':
        parse_str(file_get_contents('php://input'), $_PUT);
        update_listok($pdo, $_GET['id'], $_PUT);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        delete_listok($pdo, $id);
        break;
}

/**
 * READ from Games
 * @param $pdo
 * @return void
 */
function read_listok($pdo)
{
    $stmt = $pdo->query('SELECT * from jedalny_listok;');
    $listok = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($listok);
}

/**
 * CREATE method for olympic games
 * @param $pdo
 * @param $data
 * @return void
 */
function create_listok($pdo, $data)
{
    $stmt = $pdo->prepare('INSERT INTO jedalny_listok (den, datum, jedlo_nazov, meno, cena) VALUES (:den, :datum, :jedlo_nazov, :meno, :cena);');
    $stmt->bindParam(':jedlo_nazov', $data['jedlo_nazov']);
    $stmt->bindParam(':meno', $data['meno']);
    $stmt->bindParam(':cena', $data['cena']);
    $stmt->bindParam(':den', $data['den']);
    $stmt->bindParam(':datum', $data['datum']);
    $stmt->execute();
    echo json_encode(array('success' => 'Data created successfully'));
}

/**
 * UPDATE method for games
 * @param $pdo
 * @param $id
 * @param $data
 * @return void
 */
function update_listok($pdo, $id, $data)
{
    $stmt = $pdo->prepare('UPDATE jedalny_listok SET den = :den, datum = :datum, jedlo_nazov = :jedlo_nazov, meno = :meno, cena = :cena WHERE id = :id;');

    // $stmt = $pdo->prepare('UPDATE games SET type = :type, year = :year, games_order = :games_order, city = :city, country = :country WHERE id = :id;');
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':jedlo_nazov', $data['jedlo_nazov']);
    $stmt->bindParam(':meno', $data['meno']);
    $stmt->bindParam(':cena', $data['cena']);
    $stmt->bindParam(':den', $data['den']);
    $stmt->bindParam(':datum', $data['datum']);
    $stmt->execute();
    echo json_encode(array('success' => 'Data updated successfully'));
}

/**
 * DELETE games by ID
 * @param $pdo
 * @param $id
 * @return void
 */
function delete_listok($pdo, $id)
{
    if (!isEmpty($id)) {
        echo json_encode(array('error' => 'Delete failed'));
        http_response_code(400);
        return;
    } else {
        $stmt = $pdo->prepare('DELETE FROM jedalny_listok WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo json_encode(array('success' => 'Data deleted successfully'));
    }
}

function isEmpty($param)
{

    if (empty($param)) {
        $isOk = false;
    } else {
        $isOk = true;
    }

    return $isOk;
}
