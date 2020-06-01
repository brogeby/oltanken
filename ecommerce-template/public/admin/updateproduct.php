
<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

if(isset($_GET['updateId'])){
    try {
      $id = $_GET['updateId'];
      $query = "SELECT * FROM products
                WHERE id = :id";
      $stmt = $dbconnect->prepare($query);
      $stmt->bindValue(':id', $_GET['updateId']);
      $stmt->execute();
      $product = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
  }


$img_url = '';
$title = '';
$brewery = '';
$type = '';
$price = '';
$description = '';
$error = '';
$msg = '';
if (isset($_POST['updateProductBtn'])) {
    $img_url = trim($_POST['img_url']);
    $title = trim($_POST['title']);
    $brewery = trim($_POST['brewery']);
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    if (empty($title)) {$error .= "<div>Title is neccessary</div>";}
    if (empty($brewery)) {$error .= "<div>brewery is neccessary</div>";}
    if (empty($type)) {$error .= "<div>type is neccessary</div>";}
    if (empty($price)) {$error .= "<div>price is neccessary</div>";}
    if (empty($img_url)) {$error .= "<div>img_url is neccessary</div>";}
    if (empty($description)) {$error .= "<div>description is neccessary</div>";}
    if ($error) {$msg = "<div class='errors'>{$error}</div>";}

    if (empty($error)) {
        try {
            $query = "
            UPDATE products
            SET 
                title = :title, 
                brewery = :brewery, 
                type = :type, 
                price = :price, 
                img_url = :img_url, 
                description = :description
            WHERE id = :id
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':img_url', $img_url);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':brewery', $brewery);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':id', $_GET['updateId']);
            $result = $stmt->execute();
        }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
        if ($result) {
        $msg = '<div class="success">Your post has been updated successfully</div>';
        if(isset($_GET['updateId'])){
            try {
              $id = $_GET['updateId'];
              $query = "SELECT * FROM products
                        WHERE id = :id";
              $stmt = $dbconnect->prepare($query);
              $stmt->bindValue(':id', $_GET['updateId']);
              $stmt->execute();
              $product = $stmt->fetch();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
          }
        } 
    }
}



        
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Öltanken</title>
	<meta name="viewport" description="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/productlist-admin.css'>
</head>
<body>
<?php include '../parts/menu.php';?>

<section class="handle-product-wrapper">
    <h1>Uppdatera produkt</h1>
    <a href="editproducts.php">Tillbaka till föregående sida</a>
    <form action="#" method="POST" id="update-product-form" class="handle-product-form">
        <div class="handle-product-container">
            <input type="text" name="title" id="add-title" value="<?=htmlentities($product["title"]); ?>" >
            <input type="text" name="brewery" id="add-brewery" value="<?=htmlentities($product["brewery"]); ?>">
            <input type="text" name="type" id="add-type" value="<?=htmlentities($product["type"]); ?>">
            <input type="text" name="price" id="add-price" value="<?=htmlentities($product["price"]); ?>">
            <input type="text" name="img_url" id="add-img_url" value="<?=htmlentities($product["img_url"]); ?>" >
            <textarea type="text" name="description" id="add-description" rows="10"><?=htmlentities($product["description"]); ?></textarea>
            <input type="submit" name="updateProductBtn" id="updateProductBtn" value="Uppdatera">
        </div>
    </form>
    <div id="form-message"><?=$msg?></div>
</section>  

<?php include '../parts/footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='../js/main.js'></script>
</body>
</html>