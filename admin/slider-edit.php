<?php
include 'includes/header.php';
include '../classes/category.php';
?>
<?php
$cat = new category();
if (!isset($_GET['id']) || $_GET['id'] == null) {
    echo "<script>window.location='slider.php';</script>";
} else {
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addslider = $cat->update_slide($_POST, $_FILES, $id);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-4">Thêm slider</span>
                </div>

                <div class="card-body">
                    <?php $list = $cat->getsliderbyId($id);
                    if ($list) {
                        while ($result = $list->fetch_assoc()) { ?>
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="title">Title</label>
                                        <textarea id="title" name="title" type="text"
                                            class="form-control"><?= $result['sliderName'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="image">Upload Image</label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <label for="">Image</label>
                                        <input type="hidden" name="old_image" value="<?= $result['sliderImage'] ?>">
                                        <img style="height:70px; width:110px;" src="../uploads/<?= $result['sliderImage'] ?>"
                                            alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Type</label>
                                        <select name="type" id="">
                                            <option value="1" <?php echo ($result['type'] == 1) ? 'selected' : ''; ?>>On</option>
                                            <option value="0" <?php echo ($result['type'] == 0) ? 'selected' : ''; ?>>Off</option>
                                        </select>
                                    </div>

                                    <div class="ct-example"
                                        style="position: relative;border: 2px solid #f5f7ff !important;border-bottom: none !important;padding: 1rem 1rem 2rem 1rem;margin-bottom: -1.25rem;">
                                        <a href="slider.php" class="btn btn-primary">Trở về</a>
                                        <button name="submit" class="btn btn-icon btn-3 btn-secondary" type="submit">
                                            <span class="btn-inner--text">Lưu</span>
                                        </button>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>