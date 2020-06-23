<?php
    include('../../src/config.php');
    require SRC_PATH . ('dbconnect.php');
    error_reporting(-1);

// if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
//     header('Location: index.php?invalidUser');
//     exit;
// }

$first_name    = '';
$last_name     = '';
$email         = '';
$phone         = '';
$street        = '';
$postal_code   = '';
$city          = '';
$country       = '';
$error         = '';
$message       = '';

if (isset($_POST['submitUserBtn'])) {
    $first_name  = trim($_POST['first_nameUser']);
	$last_name   = trim($_POST['last_nameUser']);
    $email       = trim($_POST['emailUser']);
    $phone       = trim($_POST['phoneUser']);
	$street      = trim($_POST['streetUser']);
    $postal_code = trim($_POST['postal_codeUser']);
    $city        = trim($_POST['cityUser']);
	$country     = trim($_POST['countryUser']);

        if (empty($first_name)) {
            $error .= "<li class='error_msg'>Förnamn är obligatoriskt</li>";
        }
        if (empty($last_name)) {
            $error .= "<li class='error_msg'>Efternamn är obligatoriskt</li>";
        }
        if (empty($email)) {
            $error .= "<li class='error_msg'>E-mail är obligatoriskt</li>";
        }
        if (empty($phone)) {
            $error .= "<li class='error_msg'>Telefonnummer är obligatoriskt</li>";
        }
        if (empty($street)) {
            $error .= "<li class='error_msg'>Adress är obligatoriskt</li>";
        }
        if (empty($postal_code)) {
            $error .= "<li class='error_msg'>Postnummer är obligatoriskt</li>";
        }
        if (empty($city)) {
            $error .= "<li class='error_msg'>Stad är obligatoriskt</li>";
        }
        if (empty($country)) {
            $error .= "<li class='error_msg'>Land är obligatoriskt</li>";
        }

        if ($error) {
            $message = "<ul class='error_msg'>{$error}</ul>";
        }

	if (empty($error)) {
    	try {
	    $query = "
	    	UPDATE users
			SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country
	    	WHERE id = :id;
	    ";

		$stmt = $dbconnect->prepare($query);
        $stmt->bindValue(':first_name', $first_name);
        $stmt->bindValue(':last_name', $last_name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':street', $street);
        $stmt->bindValue(':postal_code', $postal_code);
        $stmt->bindValue(':city', $city);
        $stmt->bindValue(':country', $country);
		$stmt->bindValue(':id', $_GET['id']);
		$result = $stmt->execute();
		// header('Location: index.php');
		// exit;

		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}

		if ($result) {
            $message = '<div class="success_msg">Ditt inlägg är nu uppdaterat</div>';
        }
	}
} 
// echo("<pre>");
// print_r($message);
// echo("</pre>");
   try {
        $query = "
            SELECT * FROM users
            WHERE id = :id;
        ";

        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':id', $_GET['id']);
        $stmt->execute();
        // fetch() fetches 1 record, fetchAll() fetches alla records 
        $user = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/home-login-reg.css'>

    <title>Öltanken - Uppdatera mina sidor</title>
</head>
<body>
<?php include '../parts/menu.php';?>
<?=$message?>
<div class="wrapper-update-profile">
    <div class="container-update-profile"> 
        
        <h1 class="rubrik-center">Uppdatera inlägg</h1>

        <form action="#" method="POST">
            <input type="text" name="first_nameUser" placeholder="Förnamn" value="<?=$user['first_name']?>">
            <input type="text" name="last_nameUser" placeholder="Efternamn" value="<?=$user['last_name']?>">
            <input type="text" name="emailUser" placeholder="E-mail" value="<?=$user['email']?>">
            <input type="text" name="phoneUser" placeholder="Telefonnmmer" value="<?=$user['phone']?>">
            <input type="text" name="streetUser" placeholder="Adress" value="<?=$user['street']?>">
            <input type="text" name="postal_codeUser" placeholder="Postnummer" value="<?=$user['postal_code']?>">
            <input type="text" name="cityUser" placeholder="Stad" value="<?=$user['city']?>">
            <input type="text" name="countryUser" placeholder="Land" value="<?=$user['country']?>">
            <input type="submit" name="submitUserBtn" value="Uppdatera" class="updateBtn">
        </form>
        
    </div>
</div>
    <a href="mina-sidor.php" class="general-button top-left-button">< Tillbaka</a>
<?php include '../parts/footer.php';?>
</body>
</html>