<?php
    include('../../src/config.php');
  
    if(!empty($_POST['productId'])
        && !empty($_POST['quantity'])
        && isset($_SESSION['items'][$_POST['productId']])
    ) {
        $_SESSION['items'][$_POST['productId']]['quantity'] = $_POST['quantity'];
    }

    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>