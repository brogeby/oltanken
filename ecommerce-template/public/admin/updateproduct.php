
<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
error_reporting(-1);

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

<div class="wrapper">
    <div class="updatePost">
        <h1>Update</h1>
        <form action="#" method="POST">
            <input type="text" name="rubrik" value="<?=htmlentities($posts['title'])?>">
            <input type="text" name="author" value="<?=htmlentities($posts['author'])?>">
            <br>
            <textarea type="text" name="content" rows="20"><?=htmlentities($posts['content'])?></textarea>
            <br>
            <button class="btn1" name="send">Update</button>
            <a class="button" href="admin.php">Return to previous page</a>    
        </form>
    </div>
    <?=$msg?>

</div>