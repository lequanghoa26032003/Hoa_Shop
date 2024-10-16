<?php
include 'includes/header.php';
include '../classes/cart.php';
$cart = new cart();
$fm = new Format();
if ($_SERVER['REQUEST_METHOD'] && isset($_POST['update_order_btn'])) {
    $tracking_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];
    $update_order = $cart->update_Order($tracking_no, $order_status);
    if ($update_order) {
        echo "<script>window.location.href = '$update_order';</script>";
        $_SESSION['alert'] = "Cập nhật trạng thái đơn hàng thành công";
        exit;
    }
}
if (isset($_GET['t'])) {


    $tracking_no = $_GET['t'];
    $list = $cart->detailGetAllOrder($tracking_no);
    $result = $list->fetch_assoc();
}

?>


<!-- Shopping Cart Section Begin -->
<div class="container">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <span class="text-white fs-4">Chi tiết đơn hàng</span>
                <a href="order.php" class="btn btn-warning float-end"> <i class="fa fa-reply me-1"></i> Trở
                    về</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Thông tin</h4>
                        <?php

                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class="form-label">Tên <span>*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?= $result['name'] ?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone" class="form-label">Số điện thoại<span>*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?= $result['phone'] ?>">
                            </div>
                            <div class="col-lg-12">
                                <label for="email" class="form-label">Email<span>*</span></label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?= $result['email'] ?>">
                            </div>
                            <div class="col-lg-12">
                                <label for="street" class="form-label">Địa chỉ<span>*</span></label>
                                <input type="text" class="form-control street-first" id="street" name="address"
                                    value="<?= $result['address'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Đơn hàng của bạn</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT o.id, o.total_price, oi.*, oi.qty as oiqty, p.*
                  FROM orders o
                  JOIN order_items oi ON o.id = oi.order_id
                  JOIN products p ON oi.prod_id = p.id
                  WHERE o.id = oi.order_id AND oi.prod_id = p.id AND o.tracking_no = '$tracking_no'";
                                    $query_run = mysqli_query($con, $query);
                                    if ($query_run) {
                                        while ($result1 = $query_run->fetch_assoc()) { ?>
                                            <tr>
                                                <td style="padding-left:20px;">
                                                    <img style="width:40px;height:40px;"
                                                        src="../uploads/<?= $result1['image'] ?>" alt="">
                                                    <?= $result1['name'] ?>
                                                </td>
                                                <td style="padding-left:20px;"><?= $result1['price'] ?></td>
                                                <td style="padding-left:20px;"><?= $result1['oiqty'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>

                            <hr>
                            <h5 class="total-price">
                                Total:<span
                                    class="float-end fw-bold"><?= "₫" . $fm->format_currency($result['total_price']) ?></span>
                            </h5>
                            <label for="" class="fw-bold">Payment Mode
                            </label>

                            <div class="border p-1 mb-3"><?= $result['payment_mode'] ?></div>
                            <label for="" class="fw-bold">
                                Status
                            </label>

                            <div class=" mb-3">
                                <form action="order-detail.php" method="POST">
                                    <input type="hidden" name="tracking_no" value="<?= $result['tracking_no'] ?>">
                                    <select name="order_status" id="" class="form-select">
                                        <option value="0" <?= $result['status'] == 0 ? "selected" : "" ?>>Đang chờ
                                        </option>
                                        <option value="1" <?= $result['status'] == 1 ? "selected" : "" ?>>Hoàn thành
                                        </option>
                                        <option value="2" <?= $result['status'] == 2 ? "selected" : "" ?>>Đã hủy
                                        </option>
                                    </select>
                                    <br>
                                    <button type="submit" name="update_order_btn" class="btn btn-primary">Cập nhật trạng thái đơn hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shopping Cart Section End -->

<?php include 'includes/footer.php' ?>