<?php 
    include('../../src/config.php');
    require SRC_PATH . ('dbconnect.php');
    error_reporting(-1);

// delete knapp
if (isset($_POST['deleteBtn'])) {
	$delete = trim($_POST['deleteBtn']);
	
	try {
	$query = "
	  DELETE FROM users
	  WHERE id = :id;
	";

	$stmt = $dbconnect->prepare("DELETE FROM users WHERE id = :id");
	$stmt->bindValue(':id', $_POST['postId']);
	$stmt->execute();
	} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
}

	try {
		$stmt = $dbconnect->query("SELECT * FROM users");
		$users = $stmt->fetchAll();
	} catch (\PDOExecption $e){
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    echo("<pre>");
    print_r($_POST);
    echo("</pre>");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öltanken - Mina sidor</title>
</head>
<body>

	<h1>Mina sidor</h1>

	<!-- Knapp skapa inlägg -->
	<form action="add-posts.php" method="POST">
		<a href="index.php">Startsida</a>
		<input type="submit" name="addPostBtn" value="+ Skapa inlägg">
	</form>
	
<ul>
    <?php foreach ($users as $user) { ?>
        <!-- <div class="borderPost"> -->
            <li><?=$user['first_name']?></li>
            <li><?=$user['last_name'] ?></li>
            <li><b><?=$user['email']?></b></li>
            <li><?=$user['phone']?></li>
            <li><?=$user['street'] ?></li>
            <li><?=$user['postal_code']?></li>
            <li><?=$user['city']?></li>
            <li><?=$user['country'] ?></li>
            <li><?=$user['register_date']?></li>

            <form action="#" method="POST">
                <input type="" name="postId" value="<?=$user['id']?>">
                <input type="submit" name="deleteBtn" value="Radera">
            </form>
            <form action="update-profile.php?id=<?=$user['id']?>" method="POST">
                <input type="submit" name="updateBtn" value="Uppdatera">
            </form>
        </div>
    <?php } ?>
</ul>
</body>
</html>