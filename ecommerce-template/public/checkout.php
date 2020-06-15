<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);

// Delete from cart

if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['items']) && isset($_SESSION['items'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['items'][$_GET['remove']]);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
   
</head>
<body>
 <?php include 'parts/menu.php';?> 
 <div class="wrapper">
    <div class="container">
        <form action="index.php" method="post">
            <h1>
                <i class="fas fa-shipping-fast"></i>
                Shipping Details
            </h1>
            <div class="name">
                <div class="firstname">
                    <label for="f-name">First</label>
                    <input type="text" name="f-name">
                </div>
                <div class="lastname">
                    <label for="l-name">Last</label>
                    <input type="text" name="l-name">
                </div>
            </div>
            <div class="email">
                <label for="name">Email</label>
                <input type="email" name="address">
            </div>
            <div class="address-info">
                <div class="info">
                    <label for="city">City</label>
                    <input type="text" name="city">
                </div>
                <div class="info">
                    <label for="name">Street</label>
                    <input type="text" name="address">
                </div>
                <div class="info">
                    <label for="zip">Zip</label>
                    <input type="text" name="zip">
                </div>
            </div>
            <div class="btns">
                <button><a href="index.php"></a> Back to cart</button>
                <button>Purchase</button>
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
                        <td>Total</td>
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
                            <form class="update-cart-form" action="update-cart-item.php" method="POST">
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

<?php include 'parts/footer.php';?>
<script src='js/egen.js'></script>
</body>
</html>