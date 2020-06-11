<?php
include('../src/config.php');
require SRC_PATH . ('dbconnect.php');
error_reporting(-1);



// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $dbconnect->prepare('SELECT * FROM oder_items WHERE id = :id');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['items']) && is_array($_SESSION['items'])) {
            if (array_key_exists($product_id, $_SESSION['items'])) {
                // Product exists in items so just update the quanity
                $_SESSION['items'][$product_id] += $quantity;
            } else {
                // Product is not in items so add it
                $_SESSION['items'][$product_id] = $quantity;
            }
        } else {
            // There are no products in items, this will add the first product to items
            $_SESSION['items'] = array($product_id => $quantity);
        }
    }
   
}


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


$products_in_cart = isset($_SESSION['items']) ? $_SESSION['items'] : array();
$products = array();
$subtotal = 0.00;

if ($products_in_cart) {
 
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $dbconnect->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    
    $stmt->execute(array_keys($products_in_cart));
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
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
 <?php include 'parts/menu.php';?> 

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
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center; color:red;">You have no products added in your Shopping Cart</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="checkout.php?page=product&id=<?=$product['id']?>">
                            <img src="img/<?=$product['img_url']?>" width="50" height="100" alt="<?=$product['title']?>">
                        </a>
                    </td>
                    <td>
                    <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['title']?></a>
                        <br>
                        <a href="checkout.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                    </td>
                    <td class="price"><?=$product['price']?>kr</td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1"  required>
                    </td>
                    <td class="price"><?=(float)$product['price'] * (int)$products_in_cart[$product['id']]?>kr</td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price"><?=$subtotal?>kr</span>
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