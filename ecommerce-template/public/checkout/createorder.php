<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);
	// echo "<pre";
	// print_r($_POST);
	// echo "<pre";
	// exit;
	$firstName   = '';
    $lastName    = '';
    $email       = '';
    $phone       = '';
    $street      = '';
    $postalCode  = '';
    $city        = '';
	$country     = '';
    $error       = '';
    $msg         = '';
	if (isset($_POST['createOrderBtn'])) {
		$firstName 		= trim($_POST['firstName']);
		$lastName 		= trim($_POST['lastName']);
		$email 	   		= trim($_POST['email']);
		$password 		= trim($_POST['password']);
		$phone 			= trim($_POST['phone']);
		$street 		= trim($_POST['street']);
		$city 			= trim($_POST['city']);
		$country 		= trim($_POST['country']);
		$postalCode 	= trim($_POST['postalCode']);
		$totalPrice 	= trim($_POST['totalPrice']);

		if (empty($firstName)) {$error    .= "<div>First är obligatoriskt</div>";}
		if (empty($lastName)) {$error     .= "<div>Last name är obligatorsikt</div>";}
		if (empty($email)) {$error        .= "<div>Email är obligatorsikt</div>";}
		if (empty($phone)) {$error        .= "<div>Phone number är obligatorsikt</div>";}
		if (empty($street)) {$error       .= "<div>Street är obligatorsikt</div>";}
		if (empty($postalCode)) {$error   .= "<div>Postal code är obligatorsikt</div>";}
		if (empty($city)) {$error         .= "<div>City är obligatorsikt</div>";}
		if (empty($country)) {$error      .= "<div>Country är obligatorsikt</div>";}
		if ($error) {$msg                  = "<div>{$error}</div>";}

	if(empty($error)){
	// Check if user already exist
	try {
        $query = "
            SELECT * FROM users
            WHERE email = :email;
        ";
        
        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }


	if ($user) { //If users exists
		$userId = $user['id'];
	} else { // Else create new user, and fetch the newly created id 
		try {
	        $query = "
	            INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
	            VALUES (:firstName, :lastName, :email, :password, :phone, :street, :postalCode, :city, :country)
	        ";
	        
	        $stmt = $dbconnect->prepare($query);
	        $stmt->bindvalue(':firstName', $firstName);
        	$stmt->bindvalue(':lastName', $lastName);
        	$stmt->bindvalue(':email', $email);
        	$stmt->bindvalue(':password', $password);
        	$stmt->bindvalue(':phone', $phone);
        	$stmt->bindvalue(':street', $street);
        	$stmt->bindvalue(':postalCode', $postalCode);
        	$stmt->bindvalue(':city', $city);
        	$stmt->bindvalue(':country', $country);
	        $stmt->execute();
	        $userId = $dbconnect->lastInsertId();
	    } catch (\PDOException $e) {
	        throw new \PDOException($e->getMessage(), (int) $e->getCode());
	    }
	}

	// Create order in oders-tabel
	try {
		$query = "
			INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
			VALUES (:userId, :totalPrice, :fullName, :street, :postalCode, :city, :country)
		";
		
		$stmt = $dbconnect->prepare($query);
		$stmt->bindvalue(':userId', $userId);
		$stmt->bindvalue(':totalPrice', $totalPrice);
		$stmt->bindvalue(':fullName', "{$firstName} {$lastName}");
		$stmt->bindvalue(':street', $street);
		$stmt->bindvalue(':postalCode', $postalCode);
		$stmt->bindvalue(':city', $city);
		$stmt->bindvalue(':country', $country);
		$stmt->execute();
		$orderId = $dbconnect->lastInsertId();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	// Create orderitems
	foreach ($_SESSION['items'] as $productId => $productItem) {
	try {
		$query = "
			INSERT INTO order_items (order_id, product_id, quantity, unit_price, product_title)
			VALUES (:orderId, :productId, :quantity, :price, :title )
		";
		
		$stmt = $dbconnect->prepare($query);
		$stmt->bindvalue(':orderId', $orderId);
		$stmt->bindvalue(':productId', $productId);
		$stmt->bindvalue(':quantity', $productItem['quantity']);
		$stmt->bindvalue(':price', $productItem['price']);
		$stmt->bindvalue(':title', $productItem['title']);
		$stmt->execute();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
 }
	unset($_SESSION['items']);
	header('Location: tack-sida.php');
	exit;
	}
}
	header('Location: checkout.php');
?>