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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include '../parts/menu.php';?>

<h2>Products</h2>
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
    <tbody>
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
                    <input type="submit" name="updateBtn" class="update-btn" value="Update">
                </form>              
            </td>
            <td>
                <form action="#" method="POST">
                    <input type="hidden" name="deleteId" value="<?=$content['id']?>">
                    <input type="submit" name="deleteBtn" class="delete-btn" value="Delete">
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<button class="add-btn"><a href="create-content.php">Lägg till användare</a></button>
    




<?php include '../parts/footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='../js/main.js'></script>
</body>
</html>