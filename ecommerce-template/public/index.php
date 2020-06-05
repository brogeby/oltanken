<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

$products = fetchLatestProducts();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Tankrummet</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/product.css'>
</head>
<body>
<?php include 'parts/menu.php';?>
<section id="hero">
	<h2>Köp ölen hos Öltanken</h2>
</section>

<div id="latest-wrapper">
	<h2>Nyinkommet</h2>
	<section class="product-list"> 
		<?php foreach ($products as $key => $content) { ?>
			<div class="product">
				<img src="<?=htmlentities(IMG_PATH . $content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
				<h2><?=htmlentities($content['title'])?></h2>
				<h3><?=htmlentities($content['brewery'])?></h3>
				<h3><?=htmlentities($content['type'])?></h3>
				<p><?=htmlentities($content['price'])?> sek</p>
				<div class="read-buy-buttons">
					<form class="latest-buttons" action="product.php" method="GET">
						<input type="hidden" name="productsId" value="<?=$content['id']?>">
						<input class="read-buy-button" type="submit" name="showAll" value="Läs mer">
					</form>
					<form action="addtocart.php" method="POST">
						<input type="hidden" name="productId" value="<?=$content['id']?>">
						<input type="number" name="quantity" class="add-to-cart-qty" value="1" min="0" max="100">
						<input type="submit" name="addToCart" class="general-button add-to-cart-btn" value="Lägg till i kassan">
					</form>
				</div>
			</div>
		<?php } ?>
		<a href="productlist.php" class="general-button">Visa alla produkter</a>
	</section>
</div>
<?php include 'parts/footer.php';?>
</body>
</html>