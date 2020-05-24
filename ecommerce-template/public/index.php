<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

try {
    $query = "SELECT * FROM products ORDER BY id DESC LIMIT 4;";
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
    <link rel='stylesheet' type='text/css' media='screen' href='styles/index.css'>
</head>
<body>
<?php include 'parts/menu.php';?>

<div class="index-content-wrapper">
	<section id="hero">
		<h2>Köp ölen hos Öltanken</h2>
	</section>

	<div id="latest-wrapper">
		<h2>Nyinkommet</h2>
		<section id="latest-list"> 
			<?php foreach ($products as $key => $content) { ?>
				<div class="latest-product">
					<img class="latest-image" src="<?=htmlentities(IMG_PATH . $content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
					<h2 class="latest-title"><?=htmlentities($content['title'])?></h2>
					<h3 class="latest-brewery"><?=htmlentities($content['brewery'])?></h3>
					<h3 class="latest-type"><?=htmlentities($content['type'])?></h3>
					<p class="latest-price"><?=htmlentities($content['price'])?> sek</p>
					<div class="latest-buttons-wrapper">
						<form class="latest-more latest-buttons" action="product.php" method="GET">
							<input type="hidden" name="productsId" value="<?=$content['id']?>">
							<input class="latest-buttons" type="submit" name="showAll" value="Läs mer">
						</form>
						<form class="latest-buy" action="#" method="GET">
							<input type="hidden" name="productsId" value="<?=$content['id']?>">
							<input class="latest-buttons" type="submit" name="showAll" value="Lägg i varukorg">
						</form>
					</div>
				</div>
			<?php } ?>
		</section>
	</div>
</div>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>