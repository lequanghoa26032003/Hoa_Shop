<?php
include 'includes/header.php';
include '../classes/cart.php';

?>
<?php
$cart = new cart();
$fm = new Format();
if (isset($_GET['delId'])) {
    $id = $_GET['delId'];
    $delproduct = $product->del_product($id);
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
                Đơn đặt hàng
            </div>
        </div>

    </div>
</nav>
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <span class="text-white text-capitalize ps-3">Lịch sử đơn đặt hàng</span>
                <a href="order.php" class="btn btn-warning float-end"> <i class="fa fa-reply me-1"></i> Trở
                    về</a>
            </div>
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
                            Tên</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Tracking_no</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Giá</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Ngày đặt hàng</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $show_pd = $cart->gethistoryOrder();
                    $i = 0;
                    if ($show_pd && $show_pd->num_rows > 0) {
                        while ($result = $show_pd->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0"><?php echo $i; ?></p>
                                </td>
                                <td class="align-middle text-center text-sm"><?php echo $result['name']; ?>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?= $result['tracking_no']; ?>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?= "₫" . $fm->format_currency($result['total_price']) ?>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?= $result['created_at']; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <a class="btn bg-gradient-info" href="order-detail.php?t=<?= $result['tracking_no'] ?>"><i
                                            class="fa fa-info-circle me-1"></i> Chi
                                        tiết</a>
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