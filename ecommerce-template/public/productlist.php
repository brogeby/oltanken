<?php
include('../src/config.php');
require SRC_PATH . ('/dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

try {
    $query = "SELECT * FROM products;";
    $stmt = $dbconnect->query($query);
    $products = $stmt->fetchall();
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
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
<div id="show-all-wrapper">
	<section class="product-list"> 
        <?php foreach ($products as $key => $content) { ?>
            <div class="product">
                <img src="<?=htmlentities(IMG_PATH . $content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
                <h2><?=htmlentities($content['title'])?></h2>
                <h3><?=htmlentities($content['brewery'])?></h3>
                <h3><?=htmlentities($content['type'])?></h3>
                <p><?=htmlentities($content['price'])?> sek</p>
                <div class="read-buy-buttons">
                    <form class="show-all-buttons" action="product.php" method="GET">
                        <input type="hidden" name="productsId" value="<?=$content['id']?>">
                        <input class="read-buy-button" type="submit" name="showAll" value="Läs mer">
                    </form>
                    <form class="show-all-buy" action="#" method="GET">
                        <input type="hidden" name="productsId" value="<?=$content['id']?>">
                        <input class="read-buy-button" type="submit" name="showAll" value="Lägg i varukorg">
                    </form>
                </div>
            </div>
        <?php } ?>
	</section>
</div>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>