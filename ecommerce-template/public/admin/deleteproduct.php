<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;
$msg = '';

// Delete products
$deleteproducts = deleteProduct();
// Fetch products to display on page
$products = fetchAllProducts();

    

//  output with JSON
 $data = [
    'msg' => '',
    'products' => $products,
  ];
  echo json_encode($data);

//   print_r($products);