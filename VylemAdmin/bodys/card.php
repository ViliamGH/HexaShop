<?php

/*
    action
    0 - delete slideshow
    1 - add slideshow
    2 - edit slideshow
    3 - update slideshow
    4 - moveup/movedown slideshow
    5 - enable/disable slideshow
 */

$error = -1;
$errormessage = "";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case "0":
            $sid = $_GET['sid'];
            $result = dbSelect("tbslideshows", "Image", "SId=$sid", "");
            $row = mysqli_fetch_array($result);
            $img = $row['Image'];
            $path = "photo/$img";
            $thumbnailPath = "photo/thumbnail/$img";
            $result = dbDelete("tbslideshows", "SId=$sid");
            if (file_exists($path) && $result) {
                unlink($path);
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath);
                }
            }

            break;
        case "1":
            $title = $_POST['txtTitle'];
            $subtitle = $_POST['txtSubTitle'];
            $text = $_POST['txtArea'];
            $link = $_POST['txtLink'];
            $enable = "0";

            if (isset($_POST['txtCheck'])) {
                $enable = "1";
            }
            $result = dbSelect("tbslideshows", "SOrder", "", "order by SOrder desc limit 1");
            $row = mysqli_fetch_array($result);
            $sorder = $row['SOrder'] + 1;

            $o_name = $_FILES["fileimg"]["name"];
            $path_part = pathinfo($o_name);
            $exten = $path_part['extension'];
            $img =  time() . "." . $exten;
            $path = "photo/";

            $data = ["Title" => "$title", "SubTitle" => "$subtitle", "Text" => "$text", "Link" => "$link", "Enable" => "$enable", "SOrder" => "$sorder", "Image" => "$img"];
            $result = dbInsert("tbslideshows", $data);
            if ($result) {
                $error = 0;
                $errormessage = "Product added successfully.";
                // move_uploaded_file($_FILES["fileimg"]["tmp_name"], $path);
                $or_img = $_FILES["fileimg"]["tmp_name"];
                $d = getimagesize($or_img);
                $with = $d[0];
                $height = $d[1];
                $imageType = $d[2];
                createThumbnail($imageType, $or_img, $with, $height, $path, $img);
            } else {
                $error = 1;
                $errormessage = "Fail to add product ";
            }


            break;
        case "3":
            $sid = $_GET['sid'];
            $title = $_POST['txtTitle'];
            $subtitle = $_POST['txtSubTitle'];
            $text = $_POST['txtArea'];
            $link = $_POST['txtLink'];
            $enable = "0";
            if (isset($_POST['txtCheck'])) {
                $enable = "1";
            }
            $data = "";
            if (file_exists($_FILES["fileimg"]["tmp_name"])) {
                $result = dbSelect("tbslideshows", "Image", "sid=$sid", "");
                $row = mysqli_fetch_assoc($result);
                $old_img = $row['Image'];

                // Create new files
                $o_name = $_FILES["fileimg"]["name"];
                $path_part = pathinfo($o_name);
                $exten = $path_part['extension'];
                $img =  time() . "." . $exten;
                $path = "photo/";

                // resize the files
                $or_img = $_FILES["fileimg"]["tmp_name"];
                $d = getimagesize($or_img);
                $with = $d[0];
                $height = $d[1];
                $imageType = $d[2];
                createThumbnail($imageType, $or_img, $with, $height, $path, $img);

                $oldImagePath = $path . "/" . $old_img;
                $oldImgThumbnail = $path . "/thumbnail/" . $old_img;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                if (file_exists($oldImgThumbnail)) {
                    unlink($oldImgThumbnail);
                }
                $data = ["Title" => "$title", "SubTitle" => "$subtitle", "Text" => "$text", "Link" => "$link", "Enable" => "$enable", "Image" => "$img"];
            } else {
                $data = ["Title" => "$title", "SubTitle" => "$subtitle", "Text" => "$text", "Link" => "$link", "Enable" => "$enable"];
            }
            $result  = dbUpdate("tbslideshows", $data, "SId=$sid");
            break;

        case "4":
            $sid = $_GET['sid'];
            $result = dbSelect("tbslideshows", "SOrder", "SId=$sid", "");
            $row = mysqli_fetch_array($result);
            $c_sorder = $row['SOrder'];

            $n_sid = "";
            $n_sorder = "";
            $result = "";
            if ($_GET['d'] == "0") {
                $result = dbSelect("tbslideshows", "SId, SOrder", "SOrder < $c_sorder", "order by SOrder DESC limit 1");
            } else {
                $result = dbSelect("tbslideshows",  "SId, SOrder", "SOrder > $c_sorder", "order by SOrder ASC limit 1");
            }
            $row = mysqli_fetch_array($result);
            $n_sid = $row['SId'];
            $n_sorder = $row['SOrder'];

            dbUpdate("tbslideshows", ["SOrder" => $n_sorder], "SId=$sid");
            dbUpdate("tbslideshows", ["SOrder" => $c_sorder], "SId=$n_sid");

            break;
        case "5":
            $sid = $_GET['sid'];
            $enable = $_GET['enable'];
            $data = ['enable' => "$enable"];
            $result = dbUpdate("tbslideshows", $data, "SId=$sid");

            if ($result) {
                $error = 0;
                $errormessage = "Slideshow is enabled and disabled successfully.";
            } else {
                $error = 1;
                $errormessage = "Fail to enable and disable slideshow";
            }
            break;
    }
}


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

<div class="container-fluid">
    <h1 class="mt-3 mb-3 float-start">Category</h1>
    <a href="Admin.php?p=insertproduct" class="btn btn-primary mt-3 mb-3 float-end">Insert Product</a>
    <div style="clear:both"></div>
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
        <table class="table">
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Title</th>
                <th>SubTitle</th>
                <th>Text</th>
                <th>Link</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><img src="photo/<?= $row['Image'] ?>" style="width: 50px"></td>
                    <td><?= $row['Title'] ?></td>
                    <td><?= $row['SubTitle'] ?></td>
                    <td><?= $row['Text'] ?></td>
                    <td><?= $row['Link'] ?></td>
                    <td>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="Admin.php?p=card&action=4&d=0&sid=<?= $row['SId'] ?>">
                                <i class="fa-solid fa-arrow-up"></i>
                            </a>
                            <a href="Admin.php?p=card&action=4&d=1&sid=<?= $row['SId'] ?>">
                                <i class="fa-solid fa-arrow-down"></i>
                            </a>
                            <a href="Admin.php?p=card&action=5&enable=<?= ($row['Enable'] == '1' ? '0' : '1') ?>&sid=<?= $row['SId'] ?>">
                                <i class="<?= ($row['Enable'] == '1' ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash') ?>"></i>
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#slideModal">
                                <i class=" fa-solid fa-trash-can" onclick="updateLink('<?= $row['SId'] ?>')"></i>
                            </a>
                            <a href="Admin.php?p=insertproduct&sid=<?= $row['SId'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </table>

    <?php
    } else {
        echo "<p class='text-center'> There is not data in these slideshow </p>";
    }
    ?>
</div>

<!-- Pagination -->
<nav aria-label="..." class="d-flex justify-content-center sticky-bottom">
    <ul class="pagination">
        <li class="page-item">
            <a href="Admin.php?p=card&pg=<?= $c_page == 1 ? 1 : $c_page - 1 ?>" class="page-link">Previous</a>
        </li>
        <?php
        for ($i = 1; $i < $numpage; $i++) {
        ?>
            <li class="page-item <?= ($c_page == $i ? 'active' : '') ?>">
                <a class="page-link" href="Admin.php?p=card&pg=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php
        }
        ?>
        <a href="Admin.php?p=card&pg=<?= $c_page == $numpage ? $numpage : $c_page + 1 ?>" class="page-link">Next</a>
        </li>
    </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="slideModal" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="slideModalLabel">Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete these data?
            </div>
            <div class="modal-footer">
                <a href="#" id="slideDeleteLink" class="btn btn-success">Yes</a>
                <a href="#" id="slideDeleteLink" class="btn btn-danger" data-bs-dismiss="modal">No</a>
            </div>
        </div>
    </div>
</div>
<script>
    function updateLink(sid) {
        document.getElementById("slideDeleteLink").href = "Admin.php?p=card&action=0&sid=" + sid;
    }
</script>