<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öltanken - Logga in - Registera dig</title>
</head>
<body>
    <h1>Logga in</h1>
    <h1>Registera dig</h1>

    <div id="content">
        <article class="border">
            <form method="POST" action="#">
                <fieldset>
                    <legend>Logga in</legend>
                    
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
        
            <hr>
        </article>
    </div>
</body>
</html>