
<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

$product = getUpdateId()[0];
$msg = getUpdateId()[1];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Öltanken</title>
	<meta name="viewport" description="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/product-admin.css'>
</head>
<body>
<?php include '../parts/menu.php';?>
<p onclick="goBack()" class="general-button top-left-button">Go Back</p>
<h1 class="page-title">Uppdatera produkt</h1>

<section class="handle-product-wrapper">
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