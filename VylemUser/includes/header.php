<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="User.php" class="logo">
                        <img src="assets/images/logo.png">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="submenu">
                            <a href="User.php" class="scroll-to-section" <?= ($page == "bodys/home.php") ? "class='active'" : "" ?>>Home</a>
                            <ul>
                                <li class="scroll-to-section"><a href="User.php #men">Clothes</a></li>
                            </ul>
                        </li>
                        <li><a href="User.php?p=product" <?= ($page == "bodys/product.php") ? "class='active'" : "" ?>>Products</a></li>
                        <li><a href="User.php?p=about" <?= ($page == "bodys/about.php") ? "class='active'" : "" ?>>About Us</a></li>
                        <li><a href="User.php?p=signin" <?= ($page == "auth/signin.php") ? "class='active'" : "" ?>>Log In</a></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>