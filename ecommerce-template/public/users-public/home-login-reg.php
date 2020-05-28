<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/home-login-reg.css'>

    <title>Öltanken - Logga in - Registera dig</title>
</head>
<body>
    <h1>Logga in</h1>
    
<div class="form-wrapper-as">
    <div id="content1"> 
        <article class="border">
            <form method="POST" action="#">
                <fieldset>
                    
                    <!-- Visa errormeddelanden -->
                    <?=$msg?>
                    
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

    <div id="content2">
        <article class="border">
                <h1>Registera dig</h1>
            <form method="POST" action="#">
                <fieldset>
                    
                    <!-- Visa errormeddelanden -->
                    <?=$msg?>
                    
                    <button>Registera dig här</button>
                </fieldset>
            </form>
            <hr>
        </article>
    </div>
</div>
</body>
</html>