 <?php
 $productItemCount = count($_SESSION['items']);

 $productTotalSum = 0; count($_SESSION['items']);

 foreach ($_SESSION['items'] as $productId => $productItem) {
      $productTotalSum += $productItem['price'] * $productItem['quantity'];
 }
 ?>
 <div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <a href="<?= APP_URL . 'public/index.php' ?>">Home</a>
        <a href="<?= APP_URL . 'public/productlist.php' ?>">Products</a>
        <a href="<?= APP_URL . 'public/index.php' ?>">Gäst</a>
        <a href="<?= APP_URL . 'public/admin/index.php' ?>">Admin</a>
    </div>
</div>
<header class="header">
    <h3>Öltanken</h3>
    <img id="header-logo" src="<?= IMG_PATH . 'bwob-logo.png'?>" alt="Öltanken">
    <img id="show-cart" src="<?= IMG_PATH . 'business.svg'?>" alt="Shopping Cart">
        <div id="cart-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <?php foreach ($_SESSION['items'] as $productId => $productItem) { ?>
                    <div class="cart-details">
                        <div class="cart-details-img"><img src="<?=IMG_PATH . $productItem['img_url']?>" style="width:50px;height:auto;"></div>
                        <div class=""><?=$productItem['title']?></div>
                        <div class=""><?=$productItem['brewery']?></div>
                        <div class=""><?=$productItem['price']?>kr</div>
                        <div class="">Antal:<?=$productItem['quantity']?></div>
                    </div>
                <?php } ?>
                <span class="count">Total: <?=$productTotalSum?>kr</span>
                <a href="checkout.php" class="general-button">Gå till kassan</a>
            </div>
        </div>
    <label class="nav-toggle" for="nav-toggle" onclick="openNav()">
        <span></span>
        <span></span>
        <span></span>
    </label>
</header>
<div class="header-margin"></div>
