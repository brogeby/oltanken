<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);

if(isset($_GET['id'])){
  try {
    $id = $_GET['id'];
    $query = "SELECT * FROM users
                WHERE id = :id";
    $stmt = $dbconnect->prepare($query);
    $stmt->bindvalue(':id', $id);;
    $stmt->execute();
    $user = $stmt->fetch();
  } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
}

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

    if (isset($_POST['updateBtn'])) {
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
          if ($confirmPassword !== $password) {$error             .= "<div>Det bekräftade lösenordet matchar inte</div>";}
          if (empty($phone)) {$error                              .= "<div>Telefonnummer är obligatorsikt</div>";}
          if (empty($street)) {$error                             .= "<div>Gatuadress är obligatorsikt</div>";}
          if (empty($postal_code)) {$error                        .= "<div>Postkod är obligatorsikt</div>";}
          if (empty($city)) {$error                               .= "<div>Stad är obligatorsikt</div>";}
          if (empty($country)) {$error                            .= "<div>Land är obligatorsikt</div>";}
          if ($error) {$msg                                        = "<div>{$error}</div>";}
          
          if(empty($error)){
            try{
              $query = "
                    UPDATE users 
                    SET first_name = :first_name,
                        last_name = :last_name,
                        email = :email,
                        password = :password,
                        phone = :phone,
                        street = :street,
                        postal_code = :postal_code,
                        city = :city,
                        country = :country
                    WHERE id = :id;
              ";

          $stmt = $dbconnect->prepare($query);
          $stmt->bindValue(':first_name', $first_name);
          $stmt->bindValue(':last_name', $last_name);
          $stmt->bindValue(':email', $email);
          $stmt->bindValue(':password', $password);
          $stmt->bindValue(':phone', $phone);
          $stmt->bindValue(':street', $street);
          $stmt->bindValue(':postal_code', $postal_code);
          $stmt->bindValue(':city', $city);
          $stmt->bindValue(':country', $country);
          $stmt->bindvalue(':id', $_GET['id']);
          $result = $stmt->execute();
        } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        if ($result) {
          $msgSuccess = "<span style='color:green; font-size: 22px;'>Användare har blivit uppdaterad</span>";
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
      <input type="text" name="first_name" id="first_name" placeholder="Förstanamn" value="<?=htmlentities($user['first_name']); ?>">
      <input type="text" name="last_name" id="last_name" placeholder="Efternamn" value="<?=htmlentities($user['last_name']); ?>">
      <input type="email" name="email" id="email" placeholder="Email adress" value="<?=htmlentities($user['email']); ?>">
      <input type="password" name="password" id="password" placeholder="Lösenord" value="<?=htmlentities($user['password'])?>">
      <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Bekräfta lösenord" value="<?=htmlentities($user['password'])?>">
      <input type="tel" name="phone" id="phone" placeholder='Telefonnummer "012-345-6789"' value="<?=htmlentities($user['phone']); ?>">
      <input type="text" name="street" id="street" placeholder="Gatuadress" value="<?=htmlentities($user['street']); ?>">
      <input type="number" name="postal_code" id="postal_code" placeholder="Postkod" value="<?=htmlentities($user['postal_code']); ?>">
      <input type="text" name="city" id="city" placeholder="Stad" value="<?=htmlentities($user['city']); ?>">
      <input type="text" name="country" id="country" placeholder="Land" value="<?=htmlentities($user['country']); ?>">
    	<input type="submit" name="updateBtn" value="Submit">
    </form>
  </div>
  <div class="errorMsg"><?=$msg?></div>
  <div class="successMsg"><?=$msgSuccess?></div>
    <button class="back-btn"><a href="users.php">< Tillbaka till alla användare</a></button>
    <?php include '../parts/footer.php';?>
    <script src='../js/main.js'></script>
</body>
</html>