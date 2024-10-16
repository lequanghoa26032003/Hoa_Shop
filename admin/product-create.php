<?php
include 'includes/header.php';
include '../classes/category.php';
include '../classes/product.php';
?>
<?php
$product = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    // Truyền dữ liệu vào phương thức insert_category()
    $addproduct = $product->insert_product($_POST, $_FILES, $status, $trending);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-4">Thêm sản phẩm</span>
                </div>

                <div class="card-body">
                    <form action="product-create.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Chọn hãng</label>
                                <select class="form-control" name="category_id" id="" class="form-select">
                                    <option selected value="">------------------Chọn danh mục---------------</option>
                                    <?php
                                    $cat = new category();
                                    $list = $cat->show_category();
                                    if ($list && $list->num_rows > 0) {
                                        while ($result = $list->fetch_assoc()) {

                                            ?>
                                            <option class="form-control" value="<?php echo $result['id'] ?>">
                                                <?php echo $result['name'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input placeholder="Nhập tên sản phẩm" id="name" name="name" type="text"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="slug">Slug</label>
                                <input placeholder="Nhập Slug" id="slug" name="slug" type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="des">Small description</label>
                                <textarea placeholder="Nhập tên sản phẩm" id="des" name="small_description" type="text"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="des">description</label>
                                <input placeholder="Nhập tên sản phẩm" id="des" name="description" type="text"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="des">original_price</label>
                                <input placeholder="Nhập tên sản phẩm" id="des" name="original_price" type="text"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="selling_price">selling_price</label>
                                <input id="selling_price" placeholder="Nhập tên sản phẩm" name="selling_price"
                                    type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="image">Upload Image</label>
                                <input id="image" name="image" type="file" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="qty">qty</label>
                                <input placeholder="Nhập tên sản phẩm" id="qty" name="qty" type="text"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="status">Status</label>
                                <input id="status" name="status" type="checkbox">
                            </div>
                            <div class="col-md-6">
                                <label for="trending">trending</label>
                                <input id="trending" name="trending" type="checkbox">
                            </div>
                            <div class="col-md-12">
                                <label for="meta_title">meta_title</label>
                                <input placeholder="Nhập tên sản phẩm" id="meta_title" name="meta_title" type="text"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="mtkey">Meta Keywords</label>
                                <textarea placeholder="Nhập tên sản phẩm" id="mtkey" name="meta_keywords" type="text"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="mtdes">Meta description</label>
                                <textarea placeholder="Nhập tên sản phẩm" id="mtdes" name="meta_description" type="text"
                                    class="form-control"></textarea>
                            </div>


                            <div class="ct-example"
                                style="position: relative;border: 2px solid #f5f7ff !important;border-bottom: none !important;padding: 1rem 1rem 2rem 1rem;margin-bottom: -1.25rem;">
                                <a href="product.php" class="btn btn-primary">Trở về</a>
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