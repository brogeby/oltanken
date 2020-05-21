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
    <link rel='stylesheet' type='text/css' media='screen' href='styles/product.css'>
</head>
<body>
<?php include 'parts/menu.php';?>

    <div id="product-content-wrapper">
        <section class="product-page-info">
            <h3 class="product-page-title">Abbaye de Chimay - Chimay Grande Reserve 2016</h3>
            <img class="product-page-image" src="img/chimaygrandereserve2016.png" alt="Chimay Grande Reserve 2016">
            
            <p class="product-page-description">Chimay Grande Reserve 2018 is a barrel-aged Chimay Blue, that has been slowly matured since March 2016 to give it a different profile from the classic blue thanks to a second fermentation in the keg.
            <br><br>
            Pouring deep brown with a fine, light tan head, the nose is a mix of black tea and jasmine, with a balanced woody quality. The palate is also woody, with fresh bread, roasted malt, coffee, and cognac traits. This well-rounded, characterful, powerful brew is best tasted between six months and one year after bottling.
            <br><br>
            75cl 
            <br><br>
            9% ABV
            <br><br>
            <span class="product-page-price">80kr</span></p>
            <button class="product-page-purchase-button">Lägg i varukorgen</button>
        </section>
    </div>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>