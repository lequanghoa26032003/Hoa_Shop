<?php
include 'inc/header.php';
?>

<!-- -->
<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <a href="shop.php">Cửa hàng</a>
                    <span>Giỏ hàng</span>
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
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;">Hình ảnh</th>
                                <th style="width: 30%;">Tên sản phẩm</th>
                                <th style="width: 20%;">Giá</th>
                                <th style="width: 20%;">Số lượng</th>
                                <th style="width: 20%;">Hành động</th>
                            </tr>
                        </thead>

                        <?php
                        $tong = 0;

                        if (isset($_SESSION['id'])) {
                            $list = $cart->get_product_cart();
                            if ($list) {
                                while ($result = $list->fetch_assoc()) { ?>
                                    <table class="product_data">

                                        <tbody>
                                            <tr>
                                                <td style="width: 10%;" class="p-pic first-row"><img
                                                        style="height:100px; width:100px; margin:0 0 0 -15px;"
                                                        src=" uploads/<?= $result['image'] ?>" alt=""></td>
                                                <td style="width: 30%;" class="cart-title first-row">
                                                    <h5><?= $result['name'] ?></h5>
                                                </td>
                                                <td style="width: 20%;" class="p-price first-row">
                                                    <?php if($result['sale']=='1'){ ?>
                                                    <?= "₫" . $fm->format_currency($result['selling_price']) ?>
                                                    <?php }else{?>
                                                    <?= "₫" . $fm->format_currency($result['original_price']) ?>

                                                    <?php }?>

                                                </td>
                                                <td style="width: 20%;" class="qua-col first-row">
                                                    <input type="hidden" class="prodId" value="<?= $result['prod_id'] ?>">
                                                    <div class="input-group mb-3" style=" width:130px; margin: 0 auto;">
                                                        <button class="updateQty input-group-text decrement-btn ">-</button>
                                                        <input type="text" class=" form-control text-center input-qty"
                                                            value="<?= $result['prod_qty'] ?>" disabled>
                                                        <button class="updateQty input-group-text increment-btn ">+</button>
                                                    </div>
                                                </td>
                                                <td style="width: 20%;" class="total-price first-row">
                                                    <button href="#" class="deleteItem btn btn-danger "
                                                        value="<?= $result['cid'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                        Xóa sản phẩm</button>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    <?php
                                    if($result['sale']=='1'){
                                    $tong += $result['selling_price'] * $result['prod_qty'];
                                    }else{
                                    $tong += $result['original_price'] * $result['prod_qty'];
                                    }
                                }
                            } else {
                                echo '<div class="col-lg-12">
                                        <div class="checkout-content mx-auto d-block">
                                            <a href="login.php" class="content-btn">Giỏ hàng trống</a>
                                        </div>
                                    </div>';
                            }
                        }
                        ?>
                    </table>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="shop.php" class="primary-btn continue-shop">Tiếp tục mua</a>
                        </div>
                        <div class="discount-coupon">
                            <h6>Nhập mã giảm giá</h6>
                            <form action="#" class="coupon-form">
                                <input type="text" placeholder="Enter your codes"></input>
                                <button type="submit" class="site-btn coupon-btn">Áp dụng</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="cart-total">
                                    Tổng giá<span><?= "₫" . $fm->format_currency($tong) ?></span>
                                </li>
                            </ul>
                            <a href="check-out.php" class="proceed-btn">Thanh toán giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shopping Cart Section End-->
<?php
include 'inc/footer.php';
?>