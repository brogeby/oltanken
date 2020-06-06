<?php
include('../src/config.php');
require SRC_PATH . ('/dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

$products = fetchAllProducts();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Öltanken</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/product.css'>
</head>
<body>
<?php include 'parts/menu.php';?>
<button onclick="goBack()" id="product-back" class="general-button top-left-button">Gå tillbaka</button>
<h1 class="page-title">Alla produkter</h1>
<section class="product-list"> 
    <?php foreach ($products as $key => $content) { ?>
        <div class="product">
            <img src="<?=htmlentities(IMG_PATH . $content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
            <h4><?=htmlentities($content['title'])?></h4>
            <h4><?=htmlentities($content['brewery'])?></h4>
            <p><?=htmlentities($content['type'])?></p>
            <p><?=htmlentities($content['price'])?> sek</p>
            <form class="show-all-buttons" action="product.php" method="GET">
                <input type="hidden" name="productsId" value="<?=$content['id']?>">
                <input class="read-button" type="submit" name="showAll" value="Läs mer">
            </form>
            <form action="addtocart.php" method="POST">
                <input type="hidden" name="productId" value="<?=$content['id']?>">
                <input type="number" name="quantity" class="add-to-cart-qty quantity-button" value="1" min="0" max="100">
                <input type="submit" name="addToCart" class="general-button add-to-cart-btn" value="Lägg till i kassan">
            </form>
        </div>
    <?php } ?>
</section>
<?php include 'parts/footer.php';?>
</body>
</html>