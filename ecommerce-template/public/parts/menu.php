<?php echo
    '<div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
        <a href="#">New releases</a>
        <a href="#">Top rated</a>
        <span onclick="hiddenMenu()">Shop By Style</span>
        <div id="hidden-menu" style="display: none;">
            <a href="#">IPA</a>
            <a href="#">Lambic</a>
            <a href="#">Wheat</a>
            <a href="#">Stout</a>
            <a href="#">Other</a>
        </div>
        <a href="#">Show all beer</a>
        <a href="#">Log in</a>
        </div>
    </div>
    <header>
        <h3>Tankrummet</h3>
        <img id="header-logo" src="img/bwob-logo.png" alt="Tankrummet">
        <img src="img/business.svg" alt="Shopping Cart">
        <label class="nav-toggle" for="nav-toggle" onclick="openNav()">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </header>';
?>