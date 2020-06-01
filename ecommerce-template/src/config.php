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

function deleteProduct() {
    global $dbconnect;

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
}

// Denna funkar nästan.. uppdateras dock inte med AJAX
// function addProduct() {
//     global $dbconnect;

//     $img_url = '';
//     $title = '';
//     $brewery = '';
//     $type = '';
//     $price = '';
//     $description = '';
//     $error = '';
//     $msg = '';
//     if (isset($_POST['addProductBtn'])) {
//         $img_url = trim($_POST['img_url']);
//         $title = trim($_POST['title']);
//         $brewery = trim($_POST['brewery']);
//         $type = trim($_POST['type']);
//         $price = trim($_POST['price']);
//         $description = trim($_POST['description']);

//         if (empty($title)) {$error .= "<div>Title is neccessary</div>";}
//         if (empty($brewery)) {$error .= "<div>brewery is neccessary</div>";}
//         if (empty($type)) {$error .= "<div>type is neccessary</div>";}
//         if (empty($price)) {$error .= "<div>price is neccessary</div>";}
//         if (empty($img_url)) {$error .= "<div>img_url is neccessary</div>";}
//         if (empty($description)) {$error .= "<div>description is neccessary</div>";}
//         if ($error) {$msg = "<div class='errors'>{$error}</div>";}

//         if (empty($error)) {
//             try {
//                 $query = "
//                 INSERT INTO products (img_url, title, brewery, type, price, description)
//                 VALUES (:img_url, :title, :brewery, :type, :price, :description);
//                 ";

//                 $stmt = $dbconnect->prepare($query);
//                 $stmt->bindValue(':img_url', $img_url);
//                 $stmt->bindValue(':title', $title);
//                 $stmt->bindValue(':brewery', $brewery);
//                 $stmt->bindValue(':type', $type);
//                 $stmt->bindValue(':price', $price);
//                 $stmt->bindValue(':description', $description);
//                 $result = $stmt->execute();
//             } catch (\PDOException $e) {
//                 throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
//             }
//             if ($result) {
//             $msg = '<div class="success">Your product has been successfully published</div>';
//             } 
//         }
//     }
// }

?>