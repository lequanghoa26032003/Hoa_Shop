<?php
include 'inc/header.php';

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_btn'])) {
    $register = $us->register_user($_POST);
}
?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Home</i></a>
                    <span>Đăng kí</span>
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

                    <form action="register.php" method="post">
                        <div class="group-input">
                            <label for="username">Name *</label>
                            <input name="name" type="text" id="username" placeholder="Nhập tên tài khoản">
                        </div>
                        <div class="group-input">
                            <label for="email">Email *</label>
                            <input name="email" type="email" id="email" placeholder="Nhập email">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input name="pass" type="password" id="pass" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Confirm Password *</label>
                            <input name="cpass" type="text" id="con-pass" placeholder="Nhập lại mật khẩu">
                        </div>
                        <button type="submit" name="register_btn" class="site-btn register-btn">Đăng ký</button>
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