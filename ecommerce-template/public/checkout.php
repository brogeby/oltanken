<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);


if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['items']) && isset($_SESSION['items'][$_GET['remove']])) {
    unset($_SESSION['items'][$_GET['remove']]);
}

if (isset($_POST['update']) && isset($_SESSION['items'])) {
 
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;

            if (is_numeric($id) && isset($_SESSION['items'][$id]) && $quantity > 0) {
                $_SESSION['items'][$id] = $quantity;
            }
        }
    }
    header('location: checkout.php?page=cart');
    exit;
   
}


if (isset($_POST['placeorder']) && isset($_SESSION['items']) && !empty($_SESSION['items'])) {
    header('Location: placeorder.php');
    exit;
}


if(!isset($_SESSION['items'])) {
    $_SESSION['items'] = [];
}
 $productItemCount = count($_SESSION['items']);
 $productTotalSum = 0; count($_SESSION['items']);
 foreach ($_SESSION['items'] as $productId => $productItem) {
      $productTotalSum += $productItem['price'] * $productItem['quantity'];
 }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Tankrummet</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/users.css'>
</head>
<body>
 <!-- <?php include 'parts/menu.php';?>  -->

<div class="cart content-wrapper">
    <h1>Shopping Cart</h1>
    <form action="checkout.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <?php foreach ($_SESSION['items'] as $productId => $productItem) { ?>
                    <div class="cart-details">
                        <div class="cart-details-img"><img src="<?=IMG_PATH . $productItem['img_url']?>" style="width:50px;height:auto;"></div>
                        <div class="cart-title"><?=$productItem['title']?></div>
                        <div class="cart-brewery"><?=$productItem['brewery']?></div>
                        <div class="cart-price"><?=$productItem['price']?>kr</div>
                        <div class="quantity">
                        <input type="number" name="quantity-<?=$productItem['id']?>" value="<?=$productItem['quantity']?>" min="1" required>
                        </div>
                        
                    </div>
                <?php } ?>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price"><?=$productTotalSum?>kr</span>
        </div>
        <div class="buttons">
            <input class="update-order-btn" type="submit" value="Update" name="update">
            <input class="place-order-btn" type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>

<?php include 'parts/footer.php';?>
</body>
</html>