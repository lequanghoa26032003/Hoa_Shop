<?php
include 'includes/header.php';
include '../classes/category_blog.php';
include '../classes/blog.php';

?>
<?php
$category_blog = new category_blog();
$blog = new blog();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    // Truyền dữ liệu vào phương thức insert_category()
    $addblog = $blog->insert_blog($_POST, $_FILES, $status);
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Select Category</label>
                                <select class="form-control" name="category_post_id" id="" class="form-select">
                                    <option selected value="">------------------Chọn danh mục---------------</option>
                                    <?php
                                    $list = $category_blog->show_category_blog();
                                    if ($list && $list->num_rows > 0) {
                                        while ($result = $list->fetch_assoc()) {

                                            ?>
                                            <option class="form-control" value="<?= $result['id'] ?>">
                                                <?php echo $result['title'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input placeholder="Nhập ..." id="name" name="name" type="text"
                                    class="form-control">
                            </div>


                            <div class="col-md-12">
                                <label for="des">description</label>
                                <textarea placeholder="Nhập ..." id="des" name="description" type="text"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="con">Content</label>
                                <textarea placeholder="Nhập ..." id="con" name="content" type="text"
                                    class="form-control"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="image">Upload Image</label>
                                <input id="image" name="image" type="file" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="status">Status</label>
                                <input id="status" name="status" type="checkbox">
                            </div>



                            <div class="ct-example"
                                style="position: relative;border: 2px solid #f5f7ff !important;border-bottom: none !important;padding: 1rem 1rem 2rem 1rem;margin-bottom: -1.25rem;">
                                <a href="blog.php" class="btn btn-primary">Trở về</a>
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