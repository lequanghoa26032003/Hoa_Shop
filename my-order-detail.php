<?php
include 'inc/header.php';
if (!isset($_GET['t']) || $_GET['t'] == null) {
    echo "<script>window.location='check-out.php';</script>";
} else {
    $tracking_no = $_GET['t'];
    $list = $cart->detail_Order($tracking_no);
    $result = $list->fetch_assoc();
}
?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <a href="shop.php">Cửa hàng</a>
                    <span>Lịch sử đặt hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->
<!-- -->

<!-- Shopping Cart Section Begin -->
<div class="checkout-section spad">
    <div class="container">
        <form action="check-out.php" method="post" class="checkout-form">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Chi tiết đơn hàng

                            </h5>
                            <a href="my-order.php" class="btn btn-warning float-right "> <i class="fa fa-reply"></i>
                                Trở về</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <h4>Thông tin</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name">Tên <span>*</span></label>
                            <input type="text" name="name" id="name" value="<?= $result['name'] ?>">
                        </div>
                        <div class="col-lg-6">
                            <label for="phone">Số điện thoại<span>*</span></label>
                            <input type="text" name="phone" id="phone" value="<?= $result['phone'] ?>">
                        </div>
                        <div class="col-lg-12">
                            <label for="email">Email<span>*</span></label>
                            <input type="text" name="email" id="email" value="<?= $result['email'] ?>">
                        </div>

                        <div class="col-lg-12">
                            <label for="street">Địa chỉ<span>*</span></label>
                            <input type="text" name="address" id="street" class="street-first"
                                value="<?= $result['address'] ?>">
                        </div>


                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="place-order">
                        <h4>Đơn hàng của bạn</h4>

                        <div class="order-total">

                            <ul class="order-table">

                                <li>Product<span>Price</span></li>
                                <?php
                                $userid = $_SESSION['id'];
                                $query = "SELECT o.id , o.user_id,o.total_price, oi.*,oi.qty as oiqty, p.*
                                FROM orders o
                                JOIN order_items oi on o.id=oi.order_id
                                JOIN products p on oi.prod_id=p.id
                                WHERE o.id=oi.order_id AND o.user_id='$userid' AND oi.prod_id=p.id AND o.tracking_no='$tracking_no' ";
                                $query_run = mysqli_query($con, $query);
                                if ($query_run) {
                                    while ($result1 = $query_run->fetch_assoc()) { ?>
                                        <li class="fw-normal" style="margin: -20px 0 0 0"><img
                                                style="width:40px;height:40px;   " src="uploads/<?= $result1['image'] ?>"
                                                alt="">
                                            <?= $result1['name'] . " x " . $result1['oiqty'] ?><span><?= "₫" . $fm->format_currency($result1['selling_price']) ?></span>
                                        </li>
                                        <?php
                                    }
                                } ?>
                                <li class="fw-normal">
                                </li>
                                <li class="total-price">
                                    Total<span><?= "₫" . $fm->format_currency($result['total_price']) ?></span></li>
                            </ul>
                            <label for="" class="fw-bold">Payment Mode
                            </label>

                            <div class="border p-1 mb-3"><?= $result['payment_mode'] ?></div>

                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Shopping Cart Section End -->

<?php
include 'inc/footer.php';
?>