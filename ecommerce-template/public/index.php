<?php
require('../src/dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);
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
		<h2>Köp ölen hos Tankrummet</h2>
	</section>
	<section id="index-product-list">
		<div class="index-products-categories">
			<h3 class="index-products-categories-titles">New Releases</h3>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
		</div>

		<hr>

		<div class="index-products-categories">
			<h3 class="index-products-categories-titles">Top Rated</h3>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="index-products-price">80kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="index-products-price">80kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="index-products-price">80kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="index-products-price">80kr</span>
			</a>
		</div>

		<hr>

		<div class="index-products-categories">
			<h3 class="index-products-categories-titles">Staff Picks</h3>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
			<a href="product.php" class="index-products">
				<img class="index-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="index-products-title">Omnipollo - Bianca</span>
				<span class="index-products-price">150kr</span>
			</a>
		</div>
	</section>
</div>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>