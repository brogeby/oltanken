<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

// Add new pun
$img_url = '';
$title = '';
$brewery = '';
$type = '';
$price = '';
$description = '';
$error = '';
$msg = 'hejhej';
if (isset($_POST['send'])) {
    $img_url = trim($_POST['img_url']);
    $title = trim($_POST['title']);
    $brewery = trim($_POST['brewery']);
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    if (empty($img_url)) {$error .= "<div>img_url is neccessary</div>";}
    if (empty($title)) {$error .= "<div>Title is neccessary</div>";}
    if (empty($brewery)) {$error .= "<div>brewery is neccessary</div>";}
    if (empty($type)) {$error .= "<div>type is neccessary</div>";}
    if (empty($price)) {$error .= "<div>price is neccessary</div>";}
    if (empty($description)) {$error .= "<div>description is neccessary</div>";}
    if ($error) {$msg = "<div class='errors'>{$error}</div>";}

    if (empty($error)) {
        try {
            $query = "
            INSERT INTO products (img_url, title, brewery, type, price, description)
            VALUES (:img_url, :title, :brewery, :type, :price, :description);
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':img_url', $img_url);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':brewery', $brewery);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':description', $description);
            $result = $stmt->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
        }
        if ($result) {
        $msg = '<div class="success">Your product has been successfully published</div>';
        } 
    }
}
    
try {
    $query = "SELECT * FROM products;";
    $stmt = $dbconnect->query($query);
    $products = $stmt->fetchall();
}   catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

// output with JSON
// $data = [
//   'msg' => $msg,
//   'products' => $products,
// ];
// echo json_encode($data);
