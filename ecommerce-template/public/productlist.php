<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
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
    <title>Tankrummet</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/productlist.css'>
</head>
<body>
<?php include 'parts/menu.php';?>

<div id="show-all-wrapper">
	<section id="show-all-list"> 
        <?php foreach ($products as $key => $content) { ?>
            <div class="show-all-product">
                <img class="show-all-image" src="img/omnipollobianca.png" alt="<?=htmlentities($content['title'])?>">
                <h2 class="show-all-title"><?=htmlentities($content['title'])?></h2>
                <h3 class="show-all-brewery"><?=htmlentities($content['brewery'])?></h3>
                <h3 class="show-all-type"><?=htmlentities($content['type'])?></h3>
                <p class="show-all-price"><?=htmlentities($content['price'])?> sek</p>
                <div class="show-all-buttons-wrapper">
                    <form class="show-all-more show-all-buttons" action="product.php" method="GET">
                        <input type="hidden" name="productsId" value="<?=$content['id']?>">
                        <input class="show-all-buttons" type="submit" name="showAll" value="Läs mer">
                    </form>
                    <form class="show-all-buy" action="#" method="GET">
                        <input type="hidden" name="productsId" value="<?=$content['id']?>">
                        <input class="show-all-buttons" type="submit" name="showAll" value="Lägg i varukorg">
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