<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);

    $first_name  = '';
    $last_name   = '';
    $email       = '';
    $phone       = '';
    $street      = '';
    $postal_code = '';
    $city        = '';
    $country     = '';
    $error       = '';
    $msg         = '';

    if (isset($_POST['submit'])) {
          $first_name = trim($_POST['first_name']);
          $last_name  = trim($_POST['last_name']);
          $email      = trim($_POST['email']);
          $phone      = trim($_POST['phone']);
          $street     = trim($_POST['street']);
          $postal_code= trim($_POST['postal_code']);
          $city       = trim($_POST['city']);
          $country    = trim($_POST['country']);

          if (empty($first_name)) {$error   .= "<div>First är obligatoriskt</div>";}
          if (empty($last_name)) {$error    .= "<div>Last name är obligatorsikt</div>";}
          if (empty($email)) {$error        .= "<div>Email är obligatorsikt</div>";}
          if (empty($phone)) {$error        .= "<div>Phone number är obligatorsikt</div>";}
          if (empty($street)) {$error       .= "<div>Street är obligatorsikt</div>";}
          if (empty($postal_code)) {$error  .= "<div>Postal code är obligatorsikt</div>";}
          if (empty($city)) {$error         .= "<div>City är obligatorsikt</div>";}
          if (empty($country)) {$error      .= "<div>Country är obligatorsikt</div>";}
          if ($error) {$msg                  = "<div>{$error}</div>";}
          
          if(empty($error)){
            try{
              $query = "
                    INSERT INTO users (first_name, last_name, email, phone, street, postal_code, city, country)
                    VALUES (:first_name, :last_name, :email, :phone, :street, :postal_code, :city, :country);  
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
          $result = $stmt->execute();
        } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        if ($result) {
          $msg = '<div>User has been successfully added</div>';
          } 
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <title>Öltanken</title>
	<meta name="viewport" description="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
  <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
  <link rel='stylesheet' type='text/css' media='screen' href='../styles/users.css'>
</head>
<body>
  <div class="form-style">
    <form id="add-user"method="POST">
      <input type="text" name="first_name" id="first_name" placeholder="First name">
      <input type="text" name="last_name" id="last_name" placeholder="Last name">
      <input type="email" name="email" id="email" placeholder="Email address">
      <input type="tel" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder='Phone number "012-345-6789"'>
      <input type="text" name="street" id="street" placeholder="Street">
      <input type="number" name="postal_code" id="postal_code" placeholder="Postal code">
      <input type="text" name="city" id="city" placeholder="City">
      <input type="text" name="country" id="country" placeholder="Country">
    	<input type="submit" name="submit" value="Submit">
    </form>
  </div>
    <?=$msg?>
    <button><a href="users.php">Back to users table</a></button>
    <?php include '../parts/footer.php';?>
</body>
</html>