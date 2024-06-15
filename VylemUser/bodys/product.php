<?php
$error = -1;
$errormessage = "";

$result = dbSelect("tbslideshows", "*", "", "order by SOrder asc");
$num = mysqli_num_rows($result);

// pagination
$maxperpage = MAX_PER_PAGE;
$numpage = ceil($num / $maxperpage);
$c_page = 1;
if (isset($_GET['pg'])) {
    $c_page = $_GET['pg'];
}
$offset = ($c_page - 1) * $maxperpage;
$result = dbSelect("tbslideshows", "*", "", "order by SOrder asc limit $maxperpage offset $offset");

?>


<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Check Our Products</h2>
                    <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->


<!-- ***** Products Area Starts ***** -->
<section class="section" id="products">
    <div class="container" id="stickygod">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>New Arrivals</h2>
                    <span>Check out all of our products.</span>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($error != -1) {
    ?>
        <div class="alert alert-<?= ($error == 1 ? 'danger' : 'success ') ?> alert-dismissible fade show" role="alert">
            <?= $errormessage ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    if ($num > 0) {
    ?>
        <div class="container">

            <div class="row">
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <div class="col-lg-4">
                        <div class="item  <?= ($i == 0 ? 'active' : '') ?>">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                        <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <img src="../VylemAdmin/photo/<?= $row['Image'] ?>" class="img-fluid img-thumbnail" alt="...">
                            </div>
                            <div class="down-content p-3">
                                <h4 class="text-dark card-title"><?= $row['Title'] ?></h4>
                                <p class="text-dark"><?= $row['SubTitle'] ?></p>
                                <p class="text-dark"><?= $row['Text'] ?></p>
                                <ul class="stars p-3">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <a href="<?= $row['Link'] ?>" class="btn btn-primary w-100">Buy it now</a>
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </div>
    <?php
    } else {
        echo "<p class='text-center'> There is not data in these slideshow </p>";
    }
    ?>

    <!-- Pagination -->
    <nav aria-label="..." class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item">
                <a href="User.php?p=product&pg=<?= $c_page == 1 ? 1 : $c_page - 1 ?>" class="page-link">Previous</a>
            </li>
            <?php
            for ($i = 1; $i < $numpage; $i++) {
            ?>
                <li class="page-item <?= ($c_page == $i ? 'active' : '') ?>">
                    <a class="page-link"​ href="User.php?p=product&pg=<?= $i ?> #stickygod"><?= $i ?></a>
                </li>
            <?php
            }
            ?>
            <a href="User.php?p=product&pg=<?= $c_page == $numpage ? $numpage : $c_page + 1 ?>" class="page-link">Next</a>
            </li>
        </ul>
    </nav>

</section>