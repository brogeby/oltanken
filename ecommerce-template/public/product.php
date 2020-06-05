<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

$products = fetchSpecificProduct();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Oltanken</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/product.css'>
</head>
<body>
<?php include 'parts/menu.php';?>
<button onclick="goBack()" id="product-back" class="general-button top-left-button">Gå tillbaka</button>
<?php foreach ($products as $key => $content) { ?>
    <div class="individual-product">
        <img class="individual-image" src="<?=IMG_PATH . $content['img_url']?>" alt="<?=htmlentities($content['title'])?>">
        <h2 class="individual-title"><?=htmlentities($content['title'])?></h2>
        <h3 class="individual-brewery"><?=htmlentities($content['brewery'])?></h3>
        <h3 class="individual-type">Typ: <?=htmlentities($content['type'])?></h3>
        <p class="individual-price"><?=htmlentities($content['price'])?> sek</p>
        <p class="individual-desc"><?=htmlentities($content['description'])?>
        <form action="addtocart.php" method="POST">
            <input type="hidden" name="productId" value="<?=$content['id']?>">
            <input type="number" name="quantity" class="add-to-cart-qty" value="1" min="0" max="100">
            <input type="submit" name="addToCart" class="general-button add-to-cart-btn" value="Lägg till i kassan">
        </form>
    </div>
<?php } ?>
<?php include 'parts/footer.php';?>
</body>
</html>