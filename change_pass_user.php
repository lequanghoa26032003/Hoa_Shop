<?php
include 'inc/header.php';

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_pass_user_btn'])) {
    $change_pass_user = $us->change_pass_user($_POST);
}
?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Home</i></a>
                    <span>Đổi mật khẩu</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->

<!-- -->

<!-- Login Section Begin-->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">

                    <form action="" method="POST">

                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input name="passold" type="password" id="pass" placeholder="Nhập mật khẩu cũ">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Confirm Password *</label>
                            <input name="passnew" type="password" id="con-pass" placeholder="Nhập mật khẩu mới">
                        </div>
                        <button type="submit" name="change_pass_user_btn" class="site-btn register-btn">Đổi mật
                            khẩu</button>
                    </form>
                    <div class="switch-login">
                        <a href="login.php" class="or-login">Trang đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End-->
<?php
include 'inc/footer.php';
?>