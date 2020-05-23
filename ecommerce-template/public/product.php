<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

$specific_id = $_GET["productsId"]; 
                     
try {
    $query = "SELECT * FROM products WHERE id = $specific_id;";
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
    <link rel='stylesheet' type='text/css' media='screen' href='styles/product.css'>
</head>
<body>
<?php include 'parts/menu.php';?>

    <?php foreach ($products as $key => $content) { ?>
        <div class="individual-product">
            <img class="individual-image" src="<?=htmlentities($content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
            <h2 class="individual-title"><?=htmlentities($content['title'])?></h2>
            <h3 class="individual-brewery"><?=htmlentities($content['brewery'])?></h3>
            <h3 class="individual-type">Typ: <?=htmlentities($content['type'])?></h3>
            <p class="individual-price"><?=htmlentities($content['price'])?> sek</p>
            <p class="individual-desc"><?=htmlentities($content['description'])?>
            <form class="individual-buy" action="#" method="GET">
                <input type="hidden" name="productsId" value="<?=$content['id']?>">
                <input class="individual-button" type="submit" name="showAll" value="Lägg i varukorg">
            </form>
        </div>
    <?php } ?>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>