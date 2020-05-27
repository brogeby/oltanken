<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

if (isset($_POST['deleteBtn'])) {

    if(empty($title)){
        try {
            $query = "
            DELETE FROM products
            WHERE id = :id;
            ";
    
            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $_POST['id']);
            $stmt->execute();
        }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
}

    // $img_url = '';
    // $title = '';
    // $brewery = '';
    // $type = '';
    // $price = '';
    // $description = '';
    // $error  = '';
    // $msg    = '';
    // if (isset($_POST['send'])) {
    //     $img_url = trim($_POST['img_url']);
    //     $title = trim($_POST['title']);
    //     $brewery = trim($_POST['brewery']);
    //     $type = trim($_POST['type']);
    //     $price = trim($_POST['price']);
    //     $description = trim($_POST['description']);
    
    //     if (empty($img_url)) {$error .= "<div>img_url is neccessary</div>";}
    //     if (empty($title)) {$error .= "<div>Title is neccessary</div>";}
    //     if (empty($brewery)) {$error .= "<div>brewery is neccessary</div>";}
    //     if (empty($type)) {$error .= "<div>type is neccessary</div>";}
    //     if (empty($price)) {$error .= "<div>price is neccessary</div>";}
    //     if (empty($description)) {$error .= "<div>description is neccessary</div>";}
    //     if ($error) {$msg = "<div class='errors'>{$error}</div>";}
    
    //     if (empty($error)) {
    //         try {
    //             $query = "
    //             INSERT INTO products (img_url, title, brewery, type, price, description)
    //             VALUES (:img_url, :title, :brewery, :type, :price, :description);
    //             ";
    
    //             $stmt = $dbconnect->prepare($query);
    //             $stmt->bindValue(':img_url', $img_url);
    //             $stmt->bindValue(':title', $title);
    //             $stmt->bindValue(':brewery', $brewery);
    //             $stmt->bindValue(':type', $type);
    //             $stmt->bindValue(':price', $price);
    //             $stmt->bindValue(':description', $description);
    //             $result = $stmt->execute();
    //         } catch (\PDOException $e) {
    //             throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
    //         }
    //         if ($result) {
    //         $msg = '<div class="success">Your product has been successfully published</div>';
    //         } 
    //     }
    // }
        
    // try {
    //     $query = "SELECT * FROM products;";
    //     $stmt = $dbconnect->query($query);
    //     $products = $stmt->fetchall();
    // }   catch (\PDOException $e) {
    //         throw new \PDOException($e->getMessage(), (int) $e->getCode());
    //     }
        
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
    <form action="addproduct.php" method="POST">
        <div id="add-form">
            <input type="text" name="title" placeholder="Titel.." >
            <input type="text" name="brewery" placeholder="Bryggeri..">
            <input type="text" name="type" placeholder="Öltyp..">
            <input type="text" name="price" placeholder="Pris..">
            <input type="text" name="img_url" placeholder="Bildens filnamn.." >
            <textarea type="text" name="description" placeholder="Beskrivning.." rows="10"></textarea>
            <button name="addProduct">Publish</button>
        </div>
    </form>
    <div><?=$msg?></div>
</section>
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
    <?php } ?>
</section>

<?php include '../parts/footer.php';?>
<script src='js/main.js'></script>
</body>
</html>