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

    <div id="product-content-wrapper">
        
    </div>

<?php include 'parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>