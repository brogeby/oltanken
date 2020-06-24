<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);

if (isset($_POST["deleteBtn"])) {
    $delete = trim($_POST['deleteBtn']);
    try {
      $query = "DELETE FROM users WHERE id = :id";
  
      $stmt = $dbconnect->prepare($query);
	    $stmt->bindValue(':id', $_POST['userID']);
	    $stmt->execute();
  
      $success = "User successfully deleted";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }

$query = "SELECT * FROM users";
$stmt  = $dbconnect->query($query);
$users = $stmt->fetchall();
  
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
<?php include '../parts/menu.php';?>
    <table class="wrapper-table">
    <h2>Användare</h2>
        <thead>
            <tr>
                <th>ID</th>
                <th>Förstanamn</th>
                <th>Efternamn</th>
                <th>E-mail</th>
                <th>Telefonnummer</th>
                <th>Gatuadress</th>
                <th>Postkod</th>
                <th>Stad</th>
                <th>Land</th>
                <th>Registrerad</th>
                <th>Ändra</th>
                <th>Ta bort</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?=htmlentities($user["id"]); ?></td>
                <td><?=htmlentities($user["first_name"]); ?></td>
                <td><?=htmlentities($user["last_name"]); ?></td>
                <td><?=htmlentities($user["email"]); ?></td>
                <td><?=htmlentities($user["phone"]); ?></td>
                <td><?=htmlentities($user["street"]); ?></td>
                <td><?=htmlentities($user["postal_code"]); ?></td>
                <td><?=htmlentities($user["city"]); ?></td>
                <td><?=htmlentities($user["country"]); ?></td>
                <td><?=htmlentities($user["register_date"]); ?> </td>
                <td><button><a href="edit-user.php?id=<?=$user['id'] ?>">Ändra</a></button></td>
                <td><form action="#" method="POST">
                    <input type="hidden" name="userID" value="<?=$user['id']?>">
                    <input type="submit" name="deleteBtn" value="Ta bort">
                </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <button class="add-btn"><a href="create-user.php">Lägg till användare</a></button>
    <?php include '../parts/footer.php';?>
    <script src='../js/main.js'></script>
</body>
</html>