<?php
include 'includes/header.php';
include '../classes/category.php';
include '../classes/product.php';
?>
<?php
$product = new product();
$category = new category();
if (!isset($_GET['id']) || $_GET['id'] == null) {
    echo "<script>window.location='product.php';</script>";
} else {
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $addproduct = $product->update_product($_POST, $_FILES, $id, $status, $trending);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-4">Sửa sản phẩm</span>
                </div>

                <div class="card-body">
                    <?php
                    $getpd = $product->getproductbyId($id);
                    if ($getpd && $getpd->num_rows > 0) {
                        while ($result = $getpd->fetch_assoc()) {
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name">Chọn hãng</label>
                                        <select name="category_id" id="" class="form-control">
                                            <option selected value="">------------------Chọn danh mục---------------</option>
                                            <?php
                                            $getcat = $category->show_category();
                                            if ($getcat && $getcat->num_rows > 0) {
                                                while ($result1 = $getcat->fetch_assoc()) {

                                                    ?>
                                                    <option class="form-control" value="<?php echo $result1['id'] ?>"
                                                        <?= $result['category_id'] == $result1['id'] ? 'selected' : '' ?>>
                                                        <?php echo $result1['name'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input placeholder="Nhập tên sản phẩm" value="<?= $result['name'] ?>" id="name"
                                            name="name" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug">Slug</label>
                                        <input placeholder="Nhập Slug" id="slug" name="slug" value="<?= $result['slug'] ?>"
                                            type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="des">Small description</label>
                                        <textarea placeholder="Nhập tên sản phẩm" id="des" name="small_description" type="text"
                                            class="form-control"> <?= $result['small_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="des">description</label>
                                        <input placeholder="Nhập tên sản phẩm" id="des" name="description"
                                            value="<?= $result['description'] ?>" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="des">original_price</label>
                                        <input placeholder="Nhập tên sản phẩm" id="des" name="original_price"
                                            value="<?= $result['original_price'] ?>" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="selling_price">selling_price</label>
                                        <input id="selling_price" placeholder="Nhập tên sản phẩm" name="selling_price"
                                            value="<?= $result['selling_price'] ?>" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="image">Upload Image</label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <label for="">Image</label>
                                        <input type="hidden" name="old_image" value="<?= $result['image'] ?>">
                                        <img style="height:70px; width:70px;" src="../uploads/<?= $result['image'] ?>" alt="">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="qty">qty</label>
                                        <input placeholder="Nhập tên sản phẩm" id="qty" name="qty" value="<?= $result['qty'] ?>"
                                            type="text" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">Status</label>
                                        <input id="status" <?= $result['status'] == '1' ? 'checked' : '' ?> name="status"
                                            type="checkbox">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="trending">trending</label>
                                        <input id="trending" <?= $result['trending'] == '1' ? 'checked' : '' ?> name="trending"
                                            type="checkbox">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="meta_title">meta_title</label>
                                        <input placeholder="Nhập tên sản phẩm" id="meta_title" name="meta_title"
                                            value="<?= $result['meta_title'] ?>" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="mtkey">Meta Keywords</label>
                                        <textarea placeholder="Nhập tên sản phẩm" id="mtkey" name="meta_keywords" type="text"
                                            class="form-control"><?= $result['meta_keywords'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="mtdes">Meta description</label>
                                        <textarea placeholder="Nhập tên sản phẩm" id="mtdes" name="meta_description" type="text"
                                            class="form-control"><?= $result['meta_description'] ?></textarea>
                                    </div>

                                    <div class="ct-example"
                                        style="position: relative;border: 2px solid #f5f7ff !important;border-bottom: none !important;padding: 1rem 1rem 2rem 1rem;margin-bottom: -1.25rem;">
                                        <a href="product.php" class="btn btn-primary">Trở về</a>
                                        <button name="submit" class="btn btn-icon btn-3 btn-secondary" type="submit">
                                            <span class="btn-inner--text">Cập nhật</span>
                                        </button>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>