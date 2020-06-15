<?php
 include('../src/config.php');
 require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
 error_reporting(-1);

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if(!empty($_POST['productId']) 
        && isset($_SESSION['items'][$_POST['productId']])
    ) {
        unset($_SESSION['items'][$_POST['productId']]);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>