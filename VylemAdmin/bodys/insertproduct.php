<?php
$sid = "";
$title = "";
$subtitle = "";
$text = "";
$link = "";
$enable = "1";
$img = "";

if (isset($_GET['sid'])) {
    $sid = $_GET['sid'];
    $result = dbSelect("tbslideshows", "*", "SId=$sid", "");
    $row = mysqli_fetch_array($result);
    $title = $row['Title'];
    $subtitle = $row['SubTitle'];
    $text = $row['Text'];
    $enable = $row['Enable'];
    $img = $row['Image'];
    $link = $row['Link'];
}
?>
<main class="container-fluid">
    <h1 class="mt-3 mb-3">
        <?= $sid == "" ? "Add" : "Edit" ?> Product
    </h1>

    <form action="Admin.php?p=card&action=<?= $sid == "" ? "1" : "3&sid=$sid" ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="txtTitle" name="txtTitle" value="<?= $title ?>" placeholder=" " required>
            <label for="txtTitle">Title</label>
        </div>
        <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="txtSubTitle" name="txtSubTitle" value="<?= $subtitle ?>" placeholder=" " required>
            <label for="txtSubTitle">SubTitle</label>
        </div>
        <div class="mb-3 form-floating">
            <textarea class="form-control" id="txtArea" name="txtArea" style="height: 150px" placeholder=" " required><?= $text ?></textarea>
            <label for="txtArea">Text</label>
        </div>
        <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="txtLink" name="txtLink" value="<?= $link ?>" placeholder=" " required>
            <label for="txtLink">Link</label>
        </div>
        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="txtCheck" name="txtCheck" <?= $enable == "1" ? "checked" : "" ?>>
            <label class="form-check-label" for="txtCheck">Enable</label>
        </div>
        <div class="mb-3">
            <label for="fileimg" class="form-label">Select Image: </label>
            <input class="form-control" type="file" id="fileimg" name="fileimg" accept="image/png, image/gif, image/jpeg" <?= $sid == "" ? "required" : "" ?> multiple>
            <?php
            if ($img != "") {
                echo "<img src='photo/thumbnail/$img'>";
            }
            ?>
        </div>

        <input type="submit" class="btn btn-primary mb-3" value="<?= $sid == "" ? "Add" : "Update" ?> <?= $sid == "" ? "Add" : "Update" ?> Product">
        <a href="Admin.php?p=card" type="submit" class="btn btn-danger mb-3">Cancel</a>
    </form>
</main>