<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
include 'lib/session.php';
session::init(); // Đảm bảo gọi session_start() trước khi gửi bất kỳ đầu ra nào
include 'lib/database.php';
include 'helpers/format.php';
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_unset();
    Session::destroy();
}
spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});
$db = new Database();
$fm = new Format();
$cart = new cart();
$us = new user();
$cat = new Category();
$product = new Product();
$blog=new blog();
$category_blog=new category_blog();
if (isset($_GET['category'])) {
    $slug = $_GET['category'];
    $idcat = $cat->show_slug_id($slug);

    $cid = $idcat->fetch_assoc();
    $id = $cid['id'];
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="codelean Template">
    <meta name="keywords" content="codelean, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoa_Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Custom Styles -->
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX?PAYPAL_SANDBOX_CLIENT_ID:PAYPAL_PROD_CLIENT_ID; ?>&vault=true&intent=subscription"></script>
    <style>
        /* Định dạng dropdown */
        .lan-selector .dropbtn {
            background-color: transparent;
            color: #252525;
            font-size: 14px;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .lan-selector .dropdown {
            position: relative;
            display: inline-block;
        }

        .lan-selector .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            z-index: 1;
            border-radius: 5px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .lan-selector .dropdown-content a {
            color: #252525;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .lan-selector .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .lan-selector:hover .dropdown-content {
            display: block;
        }

        /* Định dạng khi hover */
        .lan-selector:hover .dropbtn {
            background-color: #f9f9f9;
        }

    .red-heart {
        color: red;
    }

    .grey-heart {
        color: gray;
    }

    .rateyo {
        pointer-events: none;

    }
    .ui-slider .ui-slider-range {
    background-color: #e7ab3c !important;
}
.blog-section .row {
    display: flex;
    flex-wrap: wrap;
}






</style>
</head>

<body>
    <!-- Start coding here -->
    <div id="errorCodeDisplay"
        style="position: fixed; top: 10px; right: 10px; background-color: red; color: white; padding: 5px; border-radius: 5px; display: none;">
        401</div>
    <!-- Header Section Begin-->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service"><i class="fa fa-envelope"></i>
                        hoakieu2603@gmail.com
                    </div>
                    <div class="phone-service"><i class="fa fa-phone"></i>+84 36.76.33.40</div>
                </div>
                <div class="ht-right">
                    <?php if (isset($_SESSION['id'])): ?>
                        <!-- Nếu đã đăng nhập -->
                        <a href="?action=logout" class="login-panel"><i class="fa fa-sign-out"></i>Logout</a>
                        <div class="lan-selector dropdown" style="min-width: 100px; max-width: 300px;">
                            <button class="dropbtn">
                                <?php
                                $list = $us->get_user(Session::get('id'));
                                if ($list) {
                                    $result = $list->fetch_assoc();
                                    if (!empty($result['image'])) {
                                        echo '<img  style="width:30px;height:30px;border-radius: 50%;" src="uploads/' . $result['image'] . '" alt="" class="avatar">';
                                    } else {
                                        echo '<i class="fa fa-user" style="margin: 0 5px 0 5px"></i>';
                                    }
                                }
                                ?>
                                <?php echo Session::get('name'); ?>
                            </button>
                            <div class="dropdown-content">
                                <a href="user_profile.php">
                                    <?php
                                    if (!empty($result['image'])) {
                                        echo '<img  style="width:30px;height:30px;border-radius: 50%;" src="uploads/' . $result['image'] . '" alt="" class="avatar">';
                                    } else {
                                        echo '<i class="fa fa-user-circle"></i>';
                                    }
                                    ?>
                                    Hồ sơ
                                </a>
                                <a href="change_pass_user.php"><i class="fa fa-key"></i> Đổi mật khẩu</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Nếu chưa đăng nhập -->
                        <a href="login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    <?php endif; ?>
                    <?php
                    if (isset($_GET["action"]) && $_GET["action"] == "logout") {
                        Session::destroy();
                    }
                    ?>
                    <div class="top-social">
                        <a href="https://www.facebook.com/hoa.kieu.x5" class="ti-facebook"></a>
                        <a href="#" class="ti-twitter-alt"></a>
                        <a href="#" class="ti-linkedin"></a>
                        <a href="#" class="ti-pinterest"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="index.php">
                                <img src="img/Hoa_Shop.png" height="25" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search"><button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2">
                        <?php
                        if (isset($_SESSION['id'])) {
                            $list = $cart->get_product_cart();
                            ?>

                            <ul class="nav-right">
                                <li class="heart-icon">
                                    <a href="wishlist.php">
                                        <i class="icon_heart_alt">
                                            <span>1</span>
                                        </i>
                                    </a>
                                </li>
                                <li class="cart-icon">
                                    <a href="#">
                                        <i class="icon_bag_alt">
                                            <span>3</span>
                                        </i>
                                    </a>
                                    <div class="cart-hover">
                                        <?php
                                        $tong = 0;

                                        if ($list) {
                                            while ($result = $list->fetch_assoc()) { ?>
                                                <div class="select-items">

                                                    <table>
                                                        <tbody>

                                                            <tr>
                                                                <td class="si-pic">
                                                                    <img style="width:71.6px;height:71.6px;"
                                                                        src="uploads/<?= $result['image'] ?>" alt="">
                                                                </td>
                                                                <td class="si-text">
                                                                    <div class="product-selected">
                                                                        <?php if($result['sale']=='1') {?>
                                                                            <p><?= "₫" . $fm->format_currency($result['selling_price']) . " x " . $result['prod_qty'] ?>
                                                                            </p>
                                                                        <?php }else{?>
                                                                            <p><?= "₫" . $fm->format_currency($result['original_price']) . " x " . $result['prod_qty'] ?>
                                                                            </p>
                                                                        <?php }?>

                                                                        <h6><?= $result['name'] ?></h6>
                                                                    </div>
                                                                </td>
                                                                <td class="si-close"><i class="ti-close"></i></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>



                                                <?php
                                                if($result['sale']=='1'){
                                                    $tong += $result['selling_price'] * $result['prod_qty'];
                                                    }else{
                                                    $tong += $result['original_price'] * $result['prod_qty'];
                                                    }                                           
                                                }
                                        } ?>
                                        <div class="select-total">
                                            <span>Tổng giá :</span>
                                            <h5> <?= "₫" . $fm->format_currency($tong) ?>

                                            </h5>
                                        </div>
                                        <div class="select-button">
                                            <a href="shopping-cart.php" class="primary-btn view-card">Xem đơn hàng</a>
                                            <a href="check-out.php" class="primary-btn checkout-btn">Thanh toán đơn hàng</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="cart-price">
                                    <?= "₫" . $fm->format_currency($tong) ?>
                                </li>
                            </ul>
                            <?php
                        } else { ?>
                            <ul class="nav-right">
                                <li class="heart-icon">
                                    <a href="#">
                                        <i class="icon_heart_alt">
                                            <span>1</span>
                                        </i>
                                    </a>
                                </li>
                                <li class="cart-icon">
                                    <a href="#">
                                        <i class="icon_bag_alt">
                                            <span>3</span>
                                        </i>
                                    </a>
                                    <div class="cart-hover">
                                        <div class="select-items">
                                            <table>
                                                <tbody>

                                                    <tr>

                                                        </td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <h6>Đơn hàng trống</h6>

                                                            </div>
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="select-total">
                                            <h5>
                                            </h5>
                                        </div>
                                        <div class="select-button">
                                        </div>
                                    </div>
                                </li>
                                <li class="cart-price">
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">

                <nav class="nav-menu mobile-menu">
                    <label for="" class="toggle" >
                        <li class=""><a ><i class="ti-menu"></i> Menu</a></li>
                    </label>
                    <ul>

                        <li  class="<?= $page == "index.php" ? 'active' : '' ?>"><a href="index.php">Trang chủ</a>
                    </li>
                        <li class="<?= $page == "shop.php" ? 'active' : '' ?>"><a href="shop.php">Cửa hàng</a></li>
                        <li class="<?= $page == "blog.php" ? 'active' : '' ?>"><a href="blog.php">Tin tức</a></li>
                        <li class="<?= $page == "contact.php" ? 'active' : '' ?>"><a href="contact.php">Liên hệ</a></li>
                        <li class="<?= $page == "pages.php" ? 'active' : '' ?>"><a href="#">Trang</a>
                            <ul class="dropdown">
                                <li><a href="my-order.php">Lịch sử đặt hàng</a></li>
                                <li><a href="shopping-cart.php">Giỏ hàng</a></li>
                                <li><a href="check-out.php">Thủ tục thanh toán</a></li>
                                <li><a href="register.php">Đăng ký</a></li>
                                <li><a href="login.php">Đăng nhập</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </header>
    <!-- Header Section End-->