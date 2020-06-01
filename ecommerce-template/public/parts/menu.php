 <div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
    <a href="<?= APP_URL . 'public/index.php' ?>">Home</a>
    <a href="<?= APP_URL . 'public/productlist.php' ?>">Products</a>
    <span onclick="hiddenMenu()">Logga in</span>
        <div id="hidden-menu" style="display: none;">
            <a href="<?= APP_URL . 'public/index.php' ?>">Gäst</a>
            <a href="<?= APP_URL . 'public/admin/index.php' ?>">Admin</a>
        </div>
    </div>
</div>
<header>
    <h3>Öltanken</h3>
    <img id="header-logo" src="<?= IMG_PATH . 'bwob-logo.png'?>" alt="Öltanken">
    <img id="header-cart" src="<?= IMG_PATH . 'business.svg'?>" alt="Shopping Cart">
    <label class="nav-toggle" for="nav-toggle" onclick="openNav()">
        <span></span>
        <span></span>
        <span></span>
    </label>
</header>