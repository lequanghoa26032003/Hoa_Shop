<?php
include 'inc/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $login_check = $us->login_user($email, $pass);
    if ($login_check) {
        echo '<script>
                setTimeout(function(){
                    window.location.href = "index.php"; 
                }, 1000);
              </script>';
    }
}
?>



<!-- -->

<!-- Login Section Begin-->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Đăng nhập</h2>
                    <form action="login.php" method="post">
                        <div class="group-input">
                            <label for="email">Nhập email *</label>
                            <input name="email" type="text" id="email" placeholder="Nhập địa chỉ email">
                        </div>
                        <div class="group-input">
                            <label for="pass">Mật khẩu *</label>
                            <input name="pass" type="password" id="pass" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="group-input gi-check">
                            <div class="gi-more">
                                <a href="" class="forget-pass">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <button type="submit" name="login_btn" class="site-btn login-btn">Đăng nhập</button>
                    </form>
                    <div class="switch-login">
                        <a href="register.php" class="or-login">Tạo tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End-->

<!-- -->
<?php
include 'inc/footer.php';
?>