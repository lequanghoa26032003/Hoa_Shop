<?php
include 'includes/header.php';
include '../classes/category.php';

?>
<?php
$category = new category();
if (isset($_GET['delId'])) {
    $id = $_GET['delId'];
    $delcategory = $category->del_category($id);
}
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];
    $stcategory = $category->update_status_category($id, $type);
}
?>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
            </div>
            <div>
                Loại sản phẩm
            </div>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="page-title-actions">
                    <a href="category-create.php" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Taọ mới
                    </a>
                </div>

            </div>

        </div>
    </div>
</nav>
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Danh sách loại sản phẩm</h6>
            </div>
        </div>

        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">

                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                STT</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Tên sản phẩm</th>

                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $show_cat = $category->show_category();
                        $i = 0;
                        if ($show_cat && $show_cat->num_rows > 0) {
                            while ($result = $show_cat->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo $i; ?></p>
                                    </td>
                                    <td class="align-middle text-center text-sm"><?php echo $result['name']; ?>
                                    </td>


                                    <td class="align-middle text-center text-sm">
                                    <?php if ($result['status'] == 1) {
                                            ?>
                                            <a href="?id=<?= $result['id'] ?> &type=0">On</a>
                                            <?php
                                        } else { ?>
                                            <a href="?id=<?= $result['id'] ?> &type=1">Off</a>

                                            <?php
                                        }

                                        ?>                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="category-edit.php?id=<?php echo $result['id']; ?>"
                                            class="btn bg-gradient-success" data-toggle="tooltip"
                                            data-original-title="Edit user"><i class="fas fa-edit me-1"></i>Sửa</a>
                                        <a onclick="return confirm('Bạn thực sự muốn xóa?')" class="btn bg-gradient-info"
                                            href="?delId=<?php echo $result['id']; ?>"><i class="fas fa-trash me-1"></i>Xóa</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>Không có sản phẩm hoặc có lỗi xảy ra trong quá trình truy xuất dữ liệu</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php' ?>