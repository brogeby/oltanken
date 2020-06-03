<?php 
    include('../../src/config.php');
    require SRC_PATH . ('dbconnect.php');
    error_reporting(-1);

    $msg = "";
    if (isset($_GET['mustLogin'])) {
        $msg = '<div class="error_msg">Obs! Sidan är inloggningsskyddad. Var snäll och logga in.</div>';
    }

    if (isset($_GET['logout'])) {
        $msg = '<div class="success_msg">Du har loggat ut.</div>';
    }


    if (isset($_POST['doLogin'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];


        try {
            $query = "
                SELECT * FROM users
                WHERE email = :email;
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute(); // returns true/false
            // fetch() fetches 1 record, fetchAll() fetches alla records 
            $user = $stmt->fetch(); // returns the user record if exists, else returns false
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }

        // fetch() found a user by email. This array would be considered true in bool, in if-condition
        // [
        //     [id] => 1
        //     [username] => Henrik
        //     [password] => qweqwe
        //     [email] => henke@asd.se
        //     [register_date] => 2020-05-06 13:20:03
        // ]

        // Empty array is considered false in if-condition
        // $array = [
        // ];


        // If user exists AND password is correct, will be considered true. Meaning you are logged in
        if ($user && $password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            header('Location: get.php');
            exit;
        } else {
           // If user doesnt Exist, will be considered false
            // OR if user exists but password is wrong. will also be considered false
            $msg = '<div class="error_msg">Fel inloggningsuppgifter. Var snäll och försök igen.</div>';
        }
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

    <title>Öltanken - Logga in - Registera dig</title>
</head>
<body>
    
    <div id="content1"> 
        <article class="border">
                <h1>Logga in</h1>
                    <!-- Visa errormeddelanden -->
                        <?=$msg?>
            <form method="POST" action="#">
                <fieldset>
                    <p>
                        <label for="input1">E-post:</label> <br>
                        <input type="text" class="text" name="email">
                    </p>

                    <p>
                        <label for="input2">Lösenord:</label> <br>
                        <input type="password" class="text" name="password">
                    </p>

                    <p>
                        <input type="submit" name="doLogin" value="Login">
                    </p>
                </fieldset>
            </form>
    </div>
    <div id="content2">
        <h2>Registera dig här</h2>
        <form action="registering.php" method="POST">
            <input type="submit" value="Registera">
        </form>
    </div>
</body>
</html>