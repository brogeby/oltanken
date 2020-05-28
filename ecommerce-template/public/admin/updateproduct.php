
<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

if (isset($_POST['deleteBtn'])) {
    if(empty($rubrik)){
        try {
            $query = "
            DELETE FROM posts
            WHERE id = :id;
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $_POST['postsId']);
            $stmt->execute();
        }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
    }
}

    
$rubrik = '';
$content = '';
$author = '';
$error  = '';
$msg    = '';
if (isset($_POST['send'])) {
    $rubrik = trim($_POST['rubrik']);
    $content = trim($_POST['content']);
    $author = trim($_POST['author']);

    if (empty($rubrik)) {$error .= "<div>Rubrik är obligatoriskt</div>";}
    if (empty($content)) {$error .= "<div>Inlägg är obligatoriskt</div>";}
    if (empty($author)) {$error .= "<div>Författare är obligatoriskt</div>";}
    if ($error) {$msg = "<div class='errors'>{$error}</div>";}

    if (empty($error)) {
        try {
            $query = "
            UPDATE posts
            SET title = :rubrik, content = :content, author = :author
            WHERE id = :id
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':rubrik', $rubrik);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':author', $author);
            $stmt->bindValue(':id', $_GET['id']);
            $result = $stmt->execute();
        }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
        if ($result) {
        $msg = '<div class="success">Your post has been updated successfully</div>';
        } 
    }
}

try {
    $query = "
        SELECT * FROM posts
        WHERE id = :id;
    ";

    $stmt = $dbconnect->prepare($query);
    $stmt->bindvalue(':id', $_GET['id']);
    $stmt->execute();
    $posts = $stmt->fetch();
}   catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    } 
?>
        
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

<div class="wrapper">
    <div class="updatePost">
        <h1>Update</h1>
        <form action="#" method="POST">
            <img class="admin-image" src="<?=htmlentities(IMG_PATH . $content['img_url'])?>" alt="<?=htmlentities($content['title'])?>">
            <h2 class="admin-title"><?=htmlentities($content['title'])?></h2>
            <h3 class="admin-brewery"><?=htmlentities($content['brewery'])?></h3>
            <h3 class="admin-type"><?=htmlentities($content['type'])?></h3>
            <p class="admin-price"><?=htmlentities($content['price'])?> sek</p>
            <p class="admin-desc"><?=htmlentities($content['description'])?></p>
            <button class="btn1" name="send">Update</button>
            <a class="button" href="admin.php">Return to previous page</a>    
        </form>
    </div>
    <?=$msg?>

</div>

<?php include '../parts/footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='../js/main.js'></script>
</body>
</html>