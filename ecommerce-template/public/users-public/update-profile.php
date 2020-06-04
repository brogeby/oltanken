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
            $error .= "<li class='error_msg'>Author är obligatoriskt</li>";
        }
        if (empty($last_name)) {
            $error .= "<li class='error_msg'>Titel är obligatoriskt</li>";
        }
        if (empty($email)) {
            $error .= "<li class='error_msg'>Text är obligatoriskt</li>";
        }
        if (empty($phone)) {
            $error .= "<li class='error_msg'>Author är obligatoriskt</li>";
        }
        if (empty($street)) {
            $error .= "<li class='error_msg'>Titel är obligatoriskt</li>";
        }
        if (empty($postal_code)) {
            $error .= "<li class='error_msg'>Text är obligatoriskt</li>";
        }
        if (empty($city)) {
            $error .= "<li class='error_msg'>Author är obligatoriskt</li>";
        }
        if (empty($country)) {
            $error .= "<li class='error_msg'>Titel är obligatoriskt</li>";
        }

        if ($error) {
            $message = "<ul class='error_msg'>{$error}</ul>";
        }

	if (empty($error)) {
    	try {
	    $query = "
	    	UPDATE users
			SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country,
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
    <meta name="viewport" email="width=device-width, initial-scale=1.0">
    <title>Öltanken - Uppdatera mina uppgifter</title>
</head>
<body>

    <h1>Uppdatera inlägg</h1>
    <?=$message?>
    <form action="" method="POST">
        <input type="text" name="first_nameUser" placeholder="Author" value="<?=$user['first_name']?>">
        <input type="text" name="last_nameUser" placeholder="last_name" value="<?=$user['last_name']?>">
        <input type="text" name="emailUser" placeholder="E-mail" value="<?=$user['email']?>">
        <input type="text" name="phoneUser" placeholder="phone" value="<?=$user['phone']?>">
        <input type="text" name="streetUser" placeholder="street" value="<?=$user['street']?>">
        <input type="text" name="postal_codeUser" placeholder="Postnummer" value="<?=$user['postal_code']?>">
        <input type="text" name="cityUser" placeholder="city" value="<?=$user['city']?>">
        <input type="text" name="countryUser" placeholder="country" value="<?=$user['country']?>">
        <input type="submit" name="submitUserBtn" value="Uppdatera">
    </form>
    <a href="mina-sidor.php">< Tillbaka</a>
</body>
</html>