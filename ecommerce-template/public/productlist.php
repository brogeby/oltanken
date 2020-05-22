<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

try {
    $query = "SELECT * FROM products;";
    $stmt = $dbconnect->query($query);
    $products = $stmt->fetchall();
}   catch (\PDOException $e) {
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

<div class="productlist-content-wrapper">
	<section id="productlist-product-list"> 
    <?php foreach ($products as $key => $content) { ?>
        <li>
            <h2 class="product-title"><?=htmlentities($content['title'])?></h2>
            <p class="product-title">Cost: <?=htmlentities($content['price'])?></p>
            <br>
            <p><?=htmlentities($content['description'])?>
            <form action="product.php" method="GET">
                <input type="hidden" name="productsId" value="<?=$content['id']?>">
                <input type="submit" name="showAll" value="Read More">
            </form>
            <br>
            <hr>
        </li>
    <?php } ?>

        <h1>Choose wisely</h1>
		<div class="productlist-products-categories">
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="productlist-products-price">80kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="productlist-products-price">80kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="productlist-products-price">80kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/chimaygrandereserve2016.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Abbaye de Chimay - Chimay Grande Reserve 2016</span>
				<span class="productlist-products-price">80kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
			<a href="product.php" class="productlist-products">
				<img class="productlist-products-image" src="img/omnipollobianca.png" alt="Omnipollo - Bianca">
				<span class="productlist-products-title">Omnipollo - Bianca</span>
				<span class="productlist-products-price">150kr</span>
			</a>
		</div>
	</section>
</div>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>