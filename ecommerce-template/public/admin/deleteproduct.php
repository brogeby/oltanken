<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

// Delete products
$msg = '';
if (isset($_POST['deleteBtn'])) {
        try {
            $query = "
            DELETE FROM products
            WHERE id = :id;
            ";
    
            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $_POST['deleteId']);
            $stmt->execute();
        }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

// Fetch products to display on page
try {
    $query = "SELECT * FROM products;";
    $stmt = $dbconnect->query($query);
    $products = $stmt->fetchall();
}   catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    

//  output with JSON
 $data = [
    'msg' => '',
    'products' => $products,
  ];
  echo json_encode($data);

//   print_r($products);