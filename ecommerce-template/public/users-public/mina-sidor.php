<?php 
    include('../../src/config.php');
    require SRC_PATH . ('dbconnect.php');
    error_reporting(-1);

// delete knapp
if (isset($_POST['deleteBtn'])) {
	$delete = trim($_POST['deleteBtn']);
	
    try {
        $stmt = $dbconnect->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', $_POST['postId']);
        $stmt->execute();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    header('Location: home-login-reg.php');
    exit;
}

try {
    $stmt = $dbconnect->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $_SESSION['email']);
    $stmt->execute();
    $user = $stmt->fetch();
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

// fetchAll logged in user 
	try {
    $query = "
        SELECT * FROM users 
        WHERE id = :id
    ";

		$stmt = $dbconnect->prepare($query);
		$users = $stmt->fetchAll();
	} catch (\PDOExecption $e){
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    // echo("<pre>");
    // print_r($_SESSION);
    // echo("</pre>");
    // echo("<pre>");
    // print_r($user);
    // echo("</pre>");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/home-login-reg.css'>

    <title>Öltanken - Mina sidor</title>
</head>
<body>
<?php include '../parts/menu.php';?>
	<h1>Mina sidor</h1>
<ul>
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
            <input type="hidden" name="postId" value="<?=$user['id']?>">
            <input type="submit" name="deleteBtn" value="Radera">
        </form>
        <form action="update-profile.php?id=<?=$user['id']?>" method="POST">
            <input type="submit" name="updateBtn" value="Uppdatera">
        </form>
    </div>
</ul>
<a href="home-login-reg.php">< Tillbaka</a>
<?php include '../parts/footer.php';?>
</body>
</html>