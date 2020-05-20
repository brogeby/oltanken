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
			<a href="#" class="index-products-categories-titles">New Releases</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 1</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 2</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 3</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 4</a>
		</div>

		<div class="index-products-categories">
			<a href="#" class="index-products-categories-titles">Top Rated</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 5</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 6</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 7</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 8</a>
		</div>

		<div class="index-products-categories">
			<a href="#" class="index-products-categories-titles">Staff Picks</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 9</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 10</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 11</a>
			<a href="#" class="index-products"><img src="" alt="">Beer 12</a>
		</div>
	</section>
</div>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>