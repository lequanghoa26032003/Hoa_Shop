<?php
include 'includes/header.php';
include '../classes/category.php';
?>
<?php
$cat = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $addslider = $cat->insert_slider($_POST, $_FILES);
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
                    <form action="slider-create.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="title">Title</label>
                                <textarea placeholder="Nhập tên sản phẩm" id="title" name="title" type="text"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="image">Upload Image</label>
                                <input id="image" name="image" type="file" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Type</label>
                                <select name="type" id="">
                                    <option value="1">On</option>
                                    <option value="0">Off</option>
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>