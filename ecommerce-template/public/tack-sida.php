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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='styles/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/home-login-reg.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/users.css'>


    <title>Öltanken - Tack för ditt köp</title>
<?php include 'parts/menu.php';?>

<div class="cart content-wrapper tack-sida-center">
    <h1 class="rubrik-tack-sida">Tack för ditt köp</h1>
    <form action="checkout.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Product</th>
                    <th>Brewery</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <?php foreach ($_SESSION['items'] as $productId => $productItem) { ?>
                    <div class="cart-details">
                        <td class="cart-details-img"><img src="<?=IMG_PATH . $productItem['img_url']?>" style="width:50px;height:auto;"></td>
                        <td class="cart-title"><?=$productItem['title']?></td>
                        <td class="cart-brewery"><?=$productItem['brewery']?></td>
                        <td class="cart-price"><?=$productItem['price']?>kr</td>
                        <td class="quantity"><?=$productItem['quantity']?></td>
                    </div>
                <?php } ?>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price"><?=$productTotalSum?>kr</span>
        </div>
    </form>
</div>
<a href="index.php" class="general-button top-left-button tack-sidaBtn">Gå tillbaka till startsidan</a>

<?php include 'parts/footer.php';?>
</body>
</html>