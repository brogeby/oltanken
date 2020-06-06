<?php
    include('../src/config.php');
    require SRC_PATH . ('dbconnect.php'); // Ger error om filen inte hittas
    error_reporting(-1);

    if(!empty($_POST['quantity'])) {
        $productId = (int) $_POST['productId'];
        $quantity = (int) $_POST['quantity'];

        try{
            $query = "
                SELECT * FROM products
                WHERE id = :id;
                ";
            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $productId);
            $stmt->execute();
            $product = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        
        if ($product) {
            $product = array_merge($product, ['quantity' => $quantity]);
            $productItem = [$productId => $product];
        }

        if (empty($_SESSION['items'])) {
            $_SESSION['items'] = $productItem;
        } else {
            if (isset($_SESSION['items'][$productId])) {
                $_SESSION['items'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['items'] += $productItem;
            }
        } 
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>