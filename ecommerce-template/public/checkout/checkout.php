<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);

// Radera från varukorg
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['items']) && isset($_SESSION['items'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['items'][$_GET['remove']]);
}

	$firstName   = '';
    $lastName    = '';
	$email       = '';
	$password	 = '';
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

		if (empty($firstName)) {$error                          .= "<div>Förstnamn är obligatoriskt</div>";}
		if (empty($lastName)) {$error                           .= "<div>Efternamn är obligatorsikt</div>";}
        if (empty($email)) {$error                              .= "<div>E-mail är obligatorsikt</div>";}
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$error .= "<div>Ogiltig e-post</div>";}
        if (empty($password)) {$error                           .= "<div>Lösenord är obligatorsikt</div>";}
        if (!empty($password) && strlen($password) < 6) {$error .= "<div>Lösenordet får inte vara mindre än 6 tecken lång</div>";}
		if (empty($phone)) {$error                              .= "<div>Telefonnummer number är obligatorsikt</div>";}
		if (empty($street)) {$error                             .= "<div>Gatuadress är obligatorsikt</div>";}
		if (empty($postalCode)) {$error                         .= "<div>Postkod är obligatorsikt</div>";}
		if (empty($city)) {$error                               .= "<div>Stad är obligatorsikt</div>";}
        if (empty($country)) {$error                            .= "<div>Land är obligatorsikt</div>";}
		if ($error) {$msg                                        = "<div>{$error}</div>";}

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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Tankrummet</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/users.css'>
   
</head>
<body>
 <?php include '../parts/menu.php';?> 
 <div class="wrapper">
    <div class="container">
        <form action="" method="POST">
            <h1>
                Fraktinformation
            </h1>
            <div class="name">
                <div class="firstname">
                    <label for="firstName">Förnamn</label>
                    <input type="text" name="firstName" value="<?=htmlentities($firstName)?>">
                </div>
                <div class="lastname">
                    <label for="lastName">Efternamn</label>
                    <input type="text" name="lastName" value="<?=htmlentities($lastName)?>">
                </div>
            </div>
            <div class="email-pass-phone">
                <div class="email-child">
                    <label for="name">E-mail</label>
                    <input type="email" name="email" value="<?=htmlentities($email)?>">
                </div>
                <div class="pass-child">
                    <label for="password">Lösenord</label>
                    <input type="password" name="password">
                </div>
                <div class="phone-child">
                    <label for="password">Telefon</label>
                    <input type="text" name="phone" value="<?=htmlentities($phone)?>">
                </div>
            </div>
            <div class="address-info">
                <div class="info-1">
                    <label for="city">Stad</label>
                    <input type="text" name="city" value="<?=htmlentities($city)?>">
                </div>
                <div class="info-1">
                    <label for="street">Gatuadress</label>
                    <input type="text" name="street" value="<?=htmlentities($street)?>">
                </div>
                <div class="info-2">
                    <label for="postalCode">Postkod</label>
                    <input type="text" name="postalCode" value="<?=htmlentities($postalCode)?>">
                </div>
                <div class="info-2">
                    <label for="country">Land</label>
                    <input type="text" name="country" value="<?=htmlentities($country)?>">
                </div>
            </div>
            <label class="checkbox">
                <input type="checkbox" />
                <span>Jag godkänner villkoren</span>
            </label>
            <div id="errorMsg"><?=$msg?></div>
            <input type="hidden" name="totalPrice" value="<?=$productTotalSum?>">
            <div class="btns">
                <button type="submit" name="createOrderBtn">Slutför köp</button>
            </div>
        </form>
    </div>

    <div class="cart content-wrapper">
        <h1>Varukorg</h1>
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Produkt</td>
                        <td>Pris</td>
                        <td>Antal</td>
                    </tr>
                </thead>
                <tbody>
                
                    <?php if (empty($productItem)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center; color:red;">Du har inga produkter i din varukorg för tillfället</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($_SESSION['items'] as $productId => $productItem) : ?>
                    <tr>
                        
                        <td class="img">
                            <img src="<?=IMG_PATH . $productItem['img_url']?>" width="auto" height="50" alt="<?=$productItem['title']?>">
                        </td>
                        <td>
                            <?=$productItem['title']?>
                            <br>
                            <a href="checkout.php?page=cart&remove=<?=$productItem['id']?>" class="remove">Ta bort</a>
                        </td>
                        <td class="price"><?=number_format($productItem['price'],2); ?>kr</td>
                        <td>
                            <form class="update-cart-form" action="update-checkout-item.php" method="POST">
                                <input type="hidden" name="productId" value="<?=$productId?>">
                                <input type="number" name="quantity" value="<?=$productItem['quantity']?>" min="0">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="subtotal">
                <span class="text">Total summa:</span>
                <span class="price"><?=$productTotalSum?>kr</span>
            </div>
            
        </form>
    </div>
</div>

<?php include '../parts/footer.php';?>
<script src='../js/egen.js'></script>
</body>
</html>