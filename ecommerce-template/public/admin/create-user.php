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
    $msgSuccess  = '';

    if (isset($_POST['submit'])) {
          $first_name        = trim($_POST['first_name']);
          $last_name         = trim($_POST['last_name']);
          $email             = trim($_POST['email']);
          $password          = trim($_POST['password']);
          $confirmPassword   = trim($_POST['confirmPassword']);
          $phone             = trim($_POST['phone']);
          $street            = trim($_POST['street']);
          $postal_code       = trim($_POST['postal_code']);
          $city              = trim($_POST['city']);
          $country           = trim($_POST['country']);

          if (empty($first_name)) {$error                         .= "<div>Förstanamn är obligatoriskt</div>";}
          if (empty($last_name)) {$error                          .= "<div>Efternamn är obligatorsikt</div>";}
          if (empty($email)) {$error                              .= "<div>E-mail är obligatorsikt</div>";}
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$error .= "<div>Ogiltig e-post</div>";}
          if (empty($password)) {$error                           .= "<div>Lösenord är obligatorsikt</div>";}
          if (!empty($password) && strlen($password) < 6) {$error .= "<div>Lösenordet får inte vara mindre än 6 tecken lång</div>";}
          if ($confirmPassword !== $password) {$error             .= "<div>Det bäkräftade lösonordet matchar inte</div>";}
          if (empty($phone)) {$error                              .= "<div>Telefonnummer är obligatorsikt</div>";}
          if (empty($street)) {$error                             .= "<div>Gatuadress är obligatorsikt</div>";}
          if (empty($postal_code)) {$error                        .= "<div>Postkod är obligatorsikt</div>";}
          if (empty($city)) {$error                               .= "<div>Stad är obligatorsikt</div>";}
          if (empty($country)) {$error                            .= "<div>Land är obligatorsikt</div>";}
          if ($error) {$msg                                        = "<div>{$error}</div>";}
          
          if(empty($error)){
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
          $msg = "Email är redan registrerad";
        } else { // Else create new user, and fetch the newly created id 
          try {
                $query = "
                    INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
                    VALUES (:firstName, :lastName, :email, :password, :phone, :street, :postalCode, :city, :country)
                ";
                
                $stmt = $dbconnect->prepare($query);
                $stmt->bindvalue(':firstName', $first_name);
                $stmt->bindvalue(':lastName', $last_name);
                $stmt->bindvalue(':email', $email);
                $stmt->bindvalue(':password', $password);
                $stmt->bindvalue(':phone', $phone);
                $stmt->bindvalue(':street', $street);
                $stmt->bindvalue(':postalCode', $postal_code);
                $stmt->bindvalue(':city', $city);
                $stmt->bindvalue(':country', $country);
                $stmt->execute();
                $userId = $dbconnect->lastInsertId();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
            $msgSuccess = "<span style='color:green; font-size: 22px;'>Användare tillagd</span>";
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
      <input type="text" name="first_name" id="first_name" placeholder="Förstanamn" value="<?=htmlentities($first_name)?>">
      <input type="text" name="last_name" id="last_name" placeholder="Efternamn" value="<?=htmlentities($last_name)?>">
      <input type="email" name="email" id="email" placeholder="E-mail adress" value="<?=htmlentities($email)?>">
      <input type="password" name="password" id="password" placeholder="Lösenord">
      <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Bekräfta lösenord">
      <input type="tel" name="phone" id="phone" placeholder='Telefonnummer' value="<?=htmlentities($phone)?>">
      <input type="text" name="street" id="street" placeholder="Gatuadress" value="<?=htmlentities($street)?>">
      <input type="number" name="postal_code" id="postal_code" placeholder="Postkod" value="<?=htmlentities($postal_code)?>">
      <input type="text" name="city" id="city" placeholder="Stad" value="<?=htmlentities($city)?>">
      <input type="text" name="country" id="country" placeholder="Land" value="<?=htmlentities($country)?>">
    	<input type="submit" name="submit" value="Submit">
    </form>
  </div>
  <div class="errorMsg"><?=$msg?></div>
  <div class="successMsg"><?=$msgSuccess?></div>
    <button class="back-btn"><a href="users.php">< Tillbaka till alla användare</a></button>
    <?php include '../parts/footer.php';?>
    <script src='../js/main.js'></script>
</body>
</html>