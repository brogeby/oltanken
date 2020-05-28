<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);

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
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <button class="add-btn"><a href="create-user.php">Lägg till användare</a></button>
    <?php include '../parts/footer.php';?>
</body>
</html>