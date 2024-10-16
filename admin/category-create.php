<?php
include 'includes/header.php';
include '../classes/category.php';
?>
<?php
$category = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    // Truyền dữ liệu vào phương thức insert_category()
    $addcategory = $category->insert_category($_POST, $status, $popular);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-4">Thêm loại sản phẩm</span>
                </div>

                <div class="card-body">
                    <form action="category-create.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="name">Name</label>
                                <input placeholder="Nhập tên sản phẩm" id="name" name="name" type="text"
                                    class="form-control">
                            </div>


                            <div class="col-md-3">
                                <label for="status">Status</label>
                                <input id="status" name="status" type="checkbox">
                            </div>
                            <div class="col-md-3">
                                <label for="popular">Popular</label>
                                <input id="popular" name="popular" type="checkbox">
                            </div>
                            <div class="ct-example"
                                style="position: relative;border: 2px solid #f5f7ff !important;border-bottom: none !important;padding: 1rem 1rem 2rem 1rem;margin-bottom: -1.25rem;">
                                <a href="category.php" class="btn btn-primary">Trở về</a>
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