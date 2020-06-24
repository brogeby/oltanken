<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

[$result, $msg] = addProduct();

$products = fetchAllProducts();

//  output with JSON
 $data = [
    'msg' => $msg,
    'products' => $products,
  ];
  echo json_encode($products);

//   print_r($products);