<?php
include 'includes/header.php';
include '../classes/category_blog.php';
include '../classes/blog.php';

?>
<?php
$category_blog = new category_blog();
$blog = new blog();

if (!isset($_GET['id']) || $_GET['id'] == null) {
    echo "<script>window.location='blog.php';</script>";
} else {
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $status = isset($_POST['status']) ? '1' : '0';

    $upblog = $blog->update_blog($_POST, $_FILES, $id, $status);
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
                    $getpd = $blog->getblogbyId($id);
                    if ($getpd && $getpd->num_rows > 0) {
                        while ($result = $getpd->fetch_assoc()) {
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name">Select Category</label>
                                        <select name="category_post_id" id="" class="form-control">
                                            <option selected value="">------------------Chọn danh mục---------------</option>
                                            <?php
                                            $getcat = $category_blog->show_category_blog();
                                            if ($getcat && $getcat->num_rows > 0) {
                                                while ($result1 = $getcat->fetch_assoc()) {

                                                    ?>
                                                    <option class="form-control" value="<?php echo $result1['id'] ?>"
                                                        <?= $result['category_post_id'] == $result1['id'] ? 'selected' : '' ?>>
                                                        <?php echo $result1['title'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Title</label>
                                        <input placeholder="Nhập tên sản phẩm" value="<?= $result['title'] ?>" id="name"
                                            name="name" type="text" class="form-control">
                                    </div>


                                    <div class="col-md-12">
                                        <label for="des">description</label>
                                        <textarea placeholder="Nhập tên sản phẩm" id="des" name="description"
                                            value="" type="text" class="form-control"><?= $result['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="des">Content</label>
                                        <textarea placeholder="Nhập tên sản phẩm" id="des" name="content" type="text"
                                            class="form-control"><?= $result['content'] ?></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="image">Upload Image</label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <label for="">Image</label>
                                        <input type="hidden" name="old_image" value="<?= $result['image'] ?>">
                                        <img style="height:70px; width:70px;" src="../uploads/<?= $result['image'] ?>" alt="">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="status">Status</label>
                                        <input id="status" <?= $result['status'] == '1' ? 'checked' : '' ?> name="status"
                                            type="checkbox">
                                    </div>


                                    <div class="ct-example"
                                        style="position: relative;border: 2px solid #f5f7ff !important;border-bottom: none !important;padding: 1rem 1rem 2rem 1rem;margin-bottom: -1.25rem;">
                                        <a href="blog.php" class="btn btn-primary">Trở về</a>
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