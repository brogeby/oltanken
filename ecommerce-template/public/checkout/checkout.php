<?php
include('../../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);

// Delete from cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['items']) && isset($_SESSION['items'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['items'][$_GET['remove']]);
}

$msg = '';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Tankrummet</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../styles/users.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
   
</head>
<body>
 <?php include '../parts/menu.php';?> 
 <div class="wrapper">
    <div class="container">
        <form action="createorder.php" method="POST">
            <h1>
                <i class="fas fa-shipping-fast"></i>
                Shipping Details
            </h1>
            <div class="name">
                <div class="firstname">
                    <label for="firstName">Förnamn</label>
                    <input type="text" name="firstName">
                </div>
                <div class="lastname">
                    <label for="lastName">Efternamn</label>
                    <input type="text" name="lastName">
                </div>
            </div>
            <div class="email">
                <div class="email-child">
                    <label for="name">Email</label>
                    <input type="email" name="email">
                </div>
            </div>
            <div class="address-info">
                <div class="info-1">
                    <label for="city">Stad</label>
                    <input type="text" name="city">
                </div>
                <div class="info-1">
                    <label for="street">Gatuadress</label>
                    <input type="text" name="street">
                </div>
                <div class="info-2">
                    <label for="postalCode">Postkod</label>
                    <input type="text" name="postalCode">
                </div>
                <div class="info-2">
                    <label for="country">Land</label>
                    <input type="text" name="country">
                </div>
            </div>
            <div class="info-2">
                    <label for="password">Phone</label>
                    <input type="text" name="phone">
                </div>
                <div class="info-2">
                    <label for="password">Lösenord</label>
                    <input type="password" name="password">
                </div>
            <label class="checkbox">
                <input type="checkbox" />
                <span>Jag godkänner villkoren</span>
            </label>
            <input type="hidden" name="totalPrice" value="<?=$productTotalSum?>">
            <div class="btns">
                <button type="submit" name="createOrderBtn">Slutför köp</button>
            </div>
        </form>
    </div>

    <div class="cart content-wrapper">
        <h1>Shopping Cart</h1>
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                    </tr>
                </thead>
                <tbody>
                
                    <?php if (empty($productItem)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center; color:red;">You have no products added in your Shopping Cart</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($_SESSION['items'] as $productId => $productItem) : ?>
                    <tr>
                        
                        <td class="img">
                            <img src="<?=IMG_PATH . $productItem['img_url']?>" width="25" height="50" alt="<?=$productItem['title']?>">
                        </td>
                        <td>
                            <?=$productItem['title']?>
                            <br>
                            <a href="checkout.php?page=cart&remove=<?=$productItem['id']?>" class="remove">Remove</a>
                        </td>
                        <td class="price"><?=number_format($productItem['price'],2); ?>kr</td>
                        <td>
                            <form class="update-cart-form" action="update-checkout-item.php" method="POST">
                                <input type="hidden" name="productId" value="<?=$productId?>">
                                <input type="number" name="quantity" value="<?=$productItem['quantity']?>" min="0">
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="subtotal">
                <span class="text">Subtotal:</span>
                <span class="price"><?=$productTotalSum?>kr</span>
            </div>
            
        </form>
    </div>
</div>

<?php include '../parts/footer.php';?>
<script src='../js/egen.js'></script>
</body>
</html>