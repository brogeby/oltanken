<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);
[$result, $msg] = addProduct();

$msg = '';
$products = fetchAllProducts();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include '../parts/menu.php';?>
<div class="content wrapper">
<p onclick="goBack()" class="general-button top-left-button">Gå tillbaka</p>

<h1 class="page-title">Hantera produkter</h1>

<section class="handle-product-wrapper">     
    <form action="#" method="POST" id="add-product-form" class="handle-product-form">
        <div class="handle-product-container">
        <h1>Skapa en ny produkt</h1>
            <input type="text" name="title" id="add-title" placeholder="Titel.." >
            <input type="text" name="brewery" id="add-brewery" placeholder="Bryggeri..">
            <input type="text" name="type" id="add-type" placeholder="Öltyp..">
            <input type="text" name="price" id="add-price" placeholder="Pris..">
            <input type="text" name="img_url" id="add-img_url" placeholder="Bildens filnamn.." >
            <textarea type="text" name="description" id="add-description" placeholder="Beskrivning.." rows="10"></textarea>
            <button name="addProductBtn" id="addProductBtn" class="general-button">Skapa produkt</button>
            <span>För att lägga till bild: Skriv in filens namn inklusive filtyp i fältet ovan och ladda upp filen i public/img</span>
        </div>
    </form>
    <div id="form-message"><?=$msg?></div>
</section>  

<table class="wrapper-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Bryggeri</th>
            <th>Typ</th>
            <th>Pris</th>
            <th>Beskrivning</th>
            <th>Img_url</th>
    </thead>
    <tbody id="product-list" class="tbody">
    <?php foreach ($products as $content) { ?>
        <tr>
            <td><?=htmlentities($content["id"]); ?></td>
            <td><?=htmlentities($content["title"]); ?></td>
            <td><?=htmlentities($content["brewery"]); ?></td>
            <td><?=htmlentities($content["type"]); ?></td>
            <td><?=htmlentities($content["price"]); ?></td>
            <td><?=htmlentities($content["description"]); ?></td>
            <td><?=htmlentities($content["img_url"]); ?></td>
            <td>
                <form action="updateproduct.php" method="GET">
                    <input type="hidden" name="updateId" value="<?=$content['id']?>">
                    <input type="submit" name="updateBtn" class="update-btn general-button" value="Redigera">
                </form>              
            </td>
            <td>
                <form action="#" method="POST">
                    <input type="hidden" name="deleteId" value="<?=$content['id']?>">
                    <input type="submit" name="deleteBtn" id="delete-btn" class="delete-btn" value="Ta bort">                
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>




<?php include '../parts/footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='../js/main.js'></script>
</body>
</html>