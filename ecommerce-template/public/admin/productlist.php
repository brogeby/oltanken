<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

// if (isset($_POST['deleteBtn'])) {

//     if(empty($title)){
//         try {
//             $query = "
//             DELETE FROM products
//             WHERE id = :id;
//             ";
    
//             $stmt = $dbconnect->prepare($query);
//             $stmt->bindValue(':id', $_POST['id']);
//             $stmt->execute();
//         }   catch (\PDOException $e) {
//                 throw new \PDOException($e->getMessage(), (int) $e->getCode());
//         }
//     }
// }
        
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
<section class="new-product-wrapper">
    <h1>Add a new product</h1>
    <form action="#" method="POST">
        <div id="add-form">
            <input type="text" name="title" placeholder="Titel.." >
            <input type="text" name="brewery" placeholder="Bryggeri..">
            <input type="text" name="type" placeholder="Öltyp..">
            <input type="text" name="price" placeholder="Pris..">
            <input type="text" name="img_url" placeholder="Bildens filnamn.." >
            <textarea type="text" name="description" placeholder="Beskrivning.." rows="10"></textarea>
            <button name="addProductBtn" id="addProductBtn">Publish</button>
        </div>
    </form>
    <div id="form-message"><?=$msg?></div>
</section>



<section id="admin-list"> 
    <!-- <?php foreach ($products as $key => $content) { ?>
        <div class="admin-product">
            <img class="admin-image" src="<?=htmlentities(IMG_PATH . $content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
            <h2 class="admin-title"><?=htmlentities($content['title'])?></h2>
            <h3 class="admin-brewery"><?=htmlentities($content['brewery'])?></h3>
            <h3 class="admin-type"><?=htmlentities($content['type'])?></h3>
            <p class="admin-price"><?=htmlentities($content['price'])?> sek</p>
            <p class="admin-desc"><?=htmlentities($content['description'])?></p>
            <div class="updateDelete">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?=$content['id']?>">
                    <input type="submit" name="deleteBtn" value="Delete post">
                </form>
                <form action="update.php?" method="GET">
                    <input type="hidden" name="id" value="<?=$content['id']?>">
                    <input type="submit" value="Update post">
                </form>
            </div>
        </div>
    <?php } ?> -->
</section>

<?php include '../parts/footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='admin.js'></script>
</body>
</html>