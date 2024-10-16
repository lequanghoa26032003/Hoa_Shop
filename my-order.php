<?php
include 'inc/header.php';
if(isset($_GET['vnp_Amount'])&&!empty($_GET['vnp_Amount'])){
    $order = $cart->Ordersonl($_GET);
}
?>
<style>
    .fill-table {
        table-layout: auto;
    }
</style>
<!-- -->
<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <a href="shop.php">Cửa hàng</a>
                    <span>Đơn đặt hàng của tôi</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->

<!-- Shopping Cart Section Begin-->
<div class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                ?>
                <div class=" cart-table">
                    <table class="fill-table">
                        <thead>
                            <tr>
                                <th style="width: 10%;">STT</th>
                                <th style="width: 30%;">Product Name</th>
                                <th style="width: 15%;">Price</th>
                                <th style="width: 15%;">Date</th>
                                <th style="width: 15%;">Trạng thái</th>
                                <th style="width: 15%;">Total</th>
                            </tr>
                        </thead>

                        <?php
                        if(!empty($_SESSION['id'])){

                            $tong = 0;

                            $list = $cart->get_Order();
                            if ($list) {
                                $i = 1 ;
                                while ($result = $list->fetch_assoc()) {
                                    ?>
                                    <table class="product_data">

                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;" class="p-stt first-row"><?= $i++ ?></td>
                                                <td style="width: 30%;" class="p-title first-row">
                                                    <h5><?= $result['tracking_no'] ?></h5>
                                                </td>
                                                <td style="width: 15%;" class="p-price first-row">
                                                    <?= "₫" . $fm->format_currency($result['total_price']) ?>
                                                </td>
                                                <td style="width: 15%;" class="qua-col first-row">
                                                    <?= $result['created_at'] ?>

                                                </td>
                                                <td style="width: 15%;" class="qua-col first-row">
                                                    <?php if ($result['status'] == 0) {
                                                        echo "Đang chờ";
                                                    } else if ($result['status'] == 1) {
                                                        echo "<span style='color: green;'>Hoàn thành</span>";
                                                    } else if ($result['status'] == 2) {
                                                        echo "<span style='color: red;'>Đã hủy</span>";
                                                    } ?>

                                                </td>
                                                <td style="width: 15%;" class="total-price first-row">
                                                    <button class="viewDetail btn btn-info" value="">
                                                        <i class="fa fa-info-circle"></i> <a style="color:white;"
                                                            href="my-order-detail.php?t=<?= $result['tracking_no'] ?>">Chi
                                                            tiết</a>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <?php
                                }
                            } else {
                                echo '<div class="col-lg-12">
                                        <div class="checkout-content mx-auto d-block">
                                            <a href="login.php" class="content-btn">Bạn chưa đặt đơn hàng nào</a>
                                        </div>
                                    </div>';
                            }
                        }else {
                           
                        }
                        ?>

                </div>
                <div class="row">


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shopping Cart Section End-->
<?php
include 'inc/footer.php';
?>