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
<body class="body-mina-sidor">
<?php include '../parts/menu.php';?>
<div class="wrapper-mina-sidor">
    <div class="container-mina-sidor">
        <h1 class="rubrik-center">Mina sidor</h1>
    
        <label>Förnamn</label>
        <input value="<?=$user['first_name']?>" readonly>
        
        <label>Efternamn</label>
        <input value="<?=$user['last_name']?>" readonly>
        
        <label>E-mail</label>
        <input value="<?=$user['email']?>" readonly>
        
        <label>Telefon</label>
        <input value="<?=$user['phone']?>" readonly>
        
        <label>Gata</label>
        <input value="<?=$user['street'] ?>" readonly>
        
        <label>Postnnummer</label>
        <input value="<?=$user['postal_code']?>" readonly>
        
        <label>Stad</label>
        <input value="<?=$user['city']?>" readonly>
        
        <label>Land</label>
        <input value="<?=$user['country']?>" readonly>
        
        <label>Registrering</label>
        <input value="<?=$user['register_date']?>" readonly>

        <div class="mina-sidorBtn">
                <form action="update-profile.php?id=<?=$user['id']?>" method="POST">
                    <input type="submit" name="updateBtn" value="Uppdatera" class="updateBtn">
                </form>
        </div>       
        <div class="mina-sidorBtn">
                <form action="#" method="POST">
                    <input type="hidden" name="postId" value="<?=$user['id']?>">
                    <input onclick="return myConfirm();" type="submit" name="deleteBtn" value="Radera" class="deleteBtn" class="btn btn-danger">
                </form>
        </div>
    </div>
</div>
<a href="home-login-reg.php">< Tillbaka</a>
<?php include '../parts/footer.php';?>
<script src="../js/main.js"></script>
</body>
</html>