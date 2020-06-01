<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('APP_URL', 'http://localhost/oltanken/ecommerce-template/');
define('IMG_PATH', APP_URL . 'public/img/');
define('PARTS_PATH', APP_URL . 'public/parts/');
define('STYLES_PATH', APP_URL . 'public/styles/');
define('JS_PATH', APP_URL . 'public/js/');
define('ROOT_PATH', __DIR__ . '/../'); // path to 'root'
define('SRC_PATH',  __DIR__ . '/'); // path to 'src/'


// Include functions and classes

function fetchAllProducts() {
    global $dbconnect;

    try {
        $query = "SELECT * FROM products;";
        $stmt = $dbconnect->query($query);
        $products= $stmt->fetchAll();
    }   catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    return $products;
}

function fetchLatestProducts() {
    global $dbconnect;

    try {
        $query = "SELECT * FROM products ORDER BY id DESC LIMIT 4;";
        $stmt = $dbconnect->query($query);
        $products = $stmt->fetchall();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    return $products;
}

function fetchSpecificProduct() {
    global $dbconnect;

    $specific_id = $_GET["productsId"]; 
    try {
        $query = "SELECT * FROM products WHERE id = $specific_id;";
        $stmt = $dbconnect->query($query);
        $products = $stmt->fetchall();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    } 
    return $products;
}

?>