<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);


$msg = '';
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
    <title>Öltanken</title>
	<meta name="viewport" description="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/productlist-admin.css'>
</head>
<body>
<?php include '../parts/menu.php';?>

<button id="create-product">Lägg till produkt</button>

<div id="create-product-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <section class="new-product-wrapper">
            <h1>Add a new product</h1>
            <form action="#" method="POST">
                <div id="add-form">
                    <input type="text" name="title" id="add-title" placeholder="Titel.." >
                    <input type="text" name="brewery" id="add-brewery" placeholder="Bryggeri..">
                    <input type="text" name="type" id="add-type" placeholder="Öltyp..">
                    <input type="text" name="price" id="add-price" placeholder="Pris..">
                    <input type="text" name="img_url" id="add-img_url" placeholder="Bildens filnamn.." >
                    <textarea type="text" name="description" id="add-description" placeholder="Beskrivning.." rows="10"></textarea>
                    <button name="addProductBtn" id="addProductBtn">Publish</button>
                </div>
            </form>
            <div id="form-message"><?=$msg?></div>
        </section>  
    </div>
</div>

<section id="admin-list"> 
    <?php foreach ($products as $key => $content) { ?>
        <div class="admin-product">
            <img class="admin-image" src="<?=htmlentities(IMG_PATH . $content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
            <h2 class="admin-title"><?=htmlentities($content['title'])?></h2>
            <h3 class="admin-brewery"><?=htmlentities($content['brewery'])?></h3>
            <h3 class="admin-type"><?=htmlentities($content['type'])?></h3>
            <p class="admin-price"><?=htmlentities($content['price'])?> sek</p>
            <p class="admin-desc"><?=htmlentities($content['description'])?></p>
            <div class="updateDelete">
                <form action="#" method="POST">
                    <input type="hidden" name="deleteId" value="<?=$content['id']?>">
                    <input type="submit" name="deleteBtn" class="delete-btn" value="Delete product">
                </form>
                <form action="update.php?" method="GET">
                    <input type="hidden" name="updateId" value="<?=$content['id']?>">
                    <input type="submit" name="updateBtn" class="update-btn" value="Update product">
                </form>
            </div>
        </div>
    <?php } ?>
</section>

<?php include '../parts/footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='../js/main.js'></script>
</body>
</html>