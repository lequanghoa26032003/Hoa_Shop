<?php
include 'inc/header.php';

$id = Session::get('id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-update'])) {
    $update_us = $us->update_user($_POST, $_FILES);
}
?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <span>Hồ sơ cá nhân</span>
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
        <form action="" method="post" class="checkout-form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-content">
                        <a href="login.php" class="content-btn">Tới trang login</a>
                    </div>
                    <h4>Hồ sơ cá nhân</h4>
                    <div class="row">
                        <?php $list = $us->get_user($id);
                        if ($list) {
                            while ($result = $list->fetch_assoc()) {
                                ?>
                                <input type="hidden" name="id" id="id" value="<?= $result['id'] ?>">
                                <?php if ($result['image'] == '') { ?>
                                    <div class="col-md-12">
                                        <label for="image">Tải hình lên</label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <label for="">Avatar</label>
                                        <input type="hidden" name="old_image">
                                        <img alt="">
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <label for="image">Tải hình lên</label>
                                        <input id="image" name="image" type="file" class="form-control">
                                        <label for="">Avatar</label>
                                        <input type="hidden" name="old_image" value="<?= $result['image'] ?>">
                                        <img style="height:70px; width:110px;" src="uploads/<?= $result['image'] ?>" alt="">
                                    </div>
                                <?php } ?>
                                <div class="col-lg-6">
                                    <label for="name">Tên <span>*</span></label>
                                    <input type="text" name="name" id="name" value="<?= $result['name'] ?>">
                                </div>
                                <?php if ($result['phone'] == '') { ?>

                                    <div class="col-lg-6">
                                        <label for="phone">Số điện thoại<span>*</span></label>
                                        <input type="tel" name="phone" id="phone" placeholder="Nhập số điện thoại">
                                    </div>

                                <?php } else { ?>
                                    <div class="col-lg-6">
                                        <label for="phone">Số điện thoại<span>*</span></label>
                                        <input type="text" name="phone" id="phone" value="<?= $result['phone'] ?>">
                                    </div>

                                <?php } ?>
                                <div class="col-lg-12">
                                    <label for="email">Email<span>*</span></label>
                                    <input type="text" name="email" id="email" value="<?= $result['email'] ?>">
                                </div>
                                <?php if ($result['address'] == '') { ?>

                                    <div class="col-lg-12">
                                        <label for="street">Địa chỉ<span>*</span></label>
                                        <input type="text" name="address" id="street" class="street-first"
                                            placeholder="Tỉnh/Thành phố, Quận/Huyện, Phường/Xã, Tên đường, Tòa nhà, Số nhà">
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-12">
                                        <label for="street">Địa chỉ<span>*</span></label>
                                        <input type="text" name="address" id="street" class="street-first"
                                            value="<?= $result['address'] ?>">
                                    </div>
                                <?php } ?>
                                
                                <?php
                            }
                        } ?>
                    </div>
                </div>

            </div>
            <div class="order-btn" style="text-align: center;">
                <button type="submit" name="btn-update" class="site-btn place-btn">Cập nhật
                    thông tin</button>
            </div>
        </form>
    </div>
</div>
<!-- Shopping Cart Section End -->




<!-- Partner Logo Section End -->
<?php
include 'inc/footer.php';

?>

<!-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script> -->