<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);
$products = fetchAllProducts();

echo"<pre>";
print_r($_SESSION);
echo"<pre>";
?>