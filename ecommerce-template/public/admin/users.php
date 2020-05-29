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
    <!-- The Modal for edit form -->
    <!-- <div id="myModal" class="modal"> -->
      <!-- Modal content -->
      <!-- <div class="modal-content">
        <span class="close">&times;</span>
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
            <input type="submit" name="updateBtn" value="Update">
          </form>
        </div>
      </div>
    </div> -->
    <table class="wrapper-table">
    <h2>Results</h2>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Phone number</th>
                <th>Street</th>
                <th>Postal code</th>
                <th>City</th>
                <th>Country</th>
                <th>Register date</th>
                <th>EDIT</th>
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
                <td><button><a href="edit-user.php?id=<?php echo $user['id'] ?>">edit</a></button></td>
                <td><form action="#" method="POST">
                    <input type="hidden" name="userID" value="<?=$user['id']?>">
                    <input type="submit" name="deleteBtn" value="Radera">
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