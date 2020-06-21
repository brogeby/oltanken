<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

//  echo "<pre>";
//  print_r($_POST);
//  echo "</pre>";
//  exit;

// Add new product
$img_url = '';
$title = '';
$brewery = '';
$type = '';
$price = '';
$description = '';
$error = '';
$msg = '';
if (isset($_POST['addProductBtn'])) {
    $img_url = trim($_POST['img_url']);
    $title = trim($_POST['title']);
    $brewery = trim($_POST['brewery']);
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    if (empty($title)) {$error .= "<div>Titel får ej vara tom</div>";}
    if (empty($brewery)) {$error .= "<div>Bryggeri får ej vara tom</div>";}
    if (empty($type)) {$error .= "<div>Typ får ej vara tom</div>";}
    if (empty($price)) {$error .= "<div>Pris får ej vara tom</div>";}
    if (empty($img_url)) {$error .= "<div>img_url får ej vara tom</div>";}
    if (empty($description)) {$error .= "<div>Beskrivning får ej vara tom</div>";}
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
        $msg = '<div class="success">Produkten har lagts till!</div>';
        } 
    }
}
    
$products = fetchAllProducts();

//  output with JSON
 $data = [
    'msg' => $msg,
    'products' => $products,
  ];
  echo json_encode($products);

//   print_r($products);