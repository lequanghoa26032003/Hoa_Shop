<?php
include 'inc/header.php';
if (isset($_GET['product'])) {
    $id = $_GET['product'];
    $product->view_product($id);


}

$userid = Session::get('id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['whishlist'])) {
    $status = $_POST['status'];
    $id = $_GET['product'];
    // Lấy trạng thái từ biểu mẫu
    $insertWhishlist = $product->insertWishlist($userid, $status, $id);
}

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
                    <span>Chi tiết</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->

<!-- Product Shop Section Begin-->
<section class="product-shop spad page-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        <li><a href="">Men</a></li>
                        <li><a href="">Women</a></li>
                        <li><a href="">Kids</a></li>
                    </ul>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                        <div class="bc-item">
                            <label for="bc-calvin">Calvin Klein
                                <input type="checkbox" id="bc-calvin">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-calvin1">Calvin Klein
                                <input type="checkbox" id="bc-calvin1">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-calvin2">Calvin Klein
                                <input type="checkbox" id="bc-calvin2">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-calvin3">Calvin Klein
                                <input type="checkbox" id="bc-calvin3">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Price</h4>
                    <div class="filter-range-wrap">
                        <div class="range-slider">
                            <div class="price-input">
                                <input type="text" id="minamount">
                                <input type="text" id="maxamount">
                            </div>
                        </div>
                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                            data-min="33" data-max="98">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                    </div>
                    <a href="#" class="filter-btn">Filter</a>
                </div>
            </div>
            <div class="col-lg-9">
                <?php $list = $product->getproductbyId($id);

                if ($list) {
                    while ($result = $list->fetch_assoc()) { ?>
                        <div class="row product_data ">
                            <div class="col-lg-6">
                                <div class="product-pic-zoom">
                                    <img src="uploads/<?= $result['image'] ?>" alt="" class="product-big-img">
                                    <div class="zoom-icon"><i class="fa fa-search-plus"></i></div>
                                </div>
                                <div class="product-thumbs">
                                    <div class="product-thumbs-track ps-slider owl-carousel">
                                        <div class="pt active" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>
                                        <div class="pt" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>
                                        <div class="pt" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>
                                        <div class="pt" data-imgbigurl="uploads/<?= $result['image'] ?>">
                                            <img src="uploads/<?= $result['image'] ?>" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details">
                                    <form action="" method="POST">
                                        <input type="hidden" name="prod_id" value="<?= $result['id'] ?>">
                                        <!-- Thêm trường ẩn để lưu trạng thái của yêu thích -->
                                        <input type="hidden" name="status" value="<?= $result['status'] ?>">
                                        <div class="pd-title">
                                            <span><?= $result['slug'] ?></span>
                                            <h3><?= $result['name'] ?></h3>
                                            <!-- Kiểm tra nếu trạng thái của yêu thích là 1, thêm class "clicked" -->
                                            <?php
                                            $status = $product->show_product_whishlist($id,$userid);
                                            if (Session::get('auth') && $status !== false) {
                                                if ($status1 = $status->fetch_assoc()) {
                                                    ?>
                                                    <button type="submit" name="whishlist"
                                                        class="heart-icon">
                                                        <i
                                                            class="icon_heart_alt <?= $status1['status'] == 1 ? ' red-heart' : 'grey-heart' ?>"></i>
                                                    </button>

                                                    <?php
                                                }
                                            } else { ?>
                                                <button type="submit" name="whishlist" class="heart-icon">
                                                    <i class="icon_heart_alt"></i>
                                                </button>
                                                <?php
                                            } ?>
                                        </div>
                                    </form>
                                    <div class="pd-rating">
                                        <?php
                                        $get_star = $product->get_star($id);

                                        if ($get_star) {
                                            $tongsao = 0;
                                            $solan = 0;
                                            while ($result_star = $get_star->fetch_assoc()) {
                                                $tongsao += $result_star['rating'];
                                                $solan += 1;
                                            }
                                            // Tính trung bình số sao
                                            $trungbinhsao = $tongsao / $solan;
                                            ?>
                                            <div class="row">
                                                <span
                                                    style="padding-left:16px; margin-right: 2px;"><?php echo $trungbinhsao ?></span>
                                                <div class="rateyo" data-rateyo-rating="<?= $trungbinhsao; ?>"
                                                    data-rateyo-num-stars="5" data-rateyo-star-width="16px">
                                                </div>
                                            </div>



                                            <?php
                                        } ?>
                                    </div>


                                    <div class="pd-desc">
                                        <p><?= $result['description'] ?></p>
                                        <?php if($result['sale']=='1') { ?>
                                        <h4> <?= $fm->format_currency($result['selling_price']) . "." . "VNĐ" ?>

                                            <span><?= $fm->format_currency($result['original_price']) . "." . "VNĐ" ?></span>
                                        </h4>
                                        <?php }else{ ?>
                                        <h4> <?= $fm->format_currency($result['original_price']) . "." . "VNĐ" ?>

                                        <?php } ?>
                                            
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group mb-3" style="width:130px">
                                                <button class="input-group-text decrement-btn">-</button>
                                                <input type="text" class=" form-control text-center input-qty" value="1"
                                                    disabled>
                                                <button class="input-group-text increment-btn">+</button>
                                            </div>

                                        </div>
                                        <?php
                                        $qty = $product->show_product_qty($id);
                                        if ($result = $qty->fetch_assoc()) {
                                            if ($result['qty'] <= 0) {
                                                ?>
                                                <div class="col-md-6">
                                                    <button class="primary-btn px-2 pd-cart "
                                                        style="opacity: 0.5; pointer-events: none;" disabled>
                                                        <i class="fa fa-shopping-cart"></i> Sản phẩm đã hết
                                                    </button>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6">
                                                    <button class="primary-btn px-2 pd-cart addToCartBtn" value="<?= $result['id'] ?>">
                                                        <i class="fa fa-shopping-cart mg-2"></i>Thêm vào giỏ hàng
                                                    </button>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <ul class="pd-tags">
                                        <?php $categories=$cat->getcategorybyId($result['category_id']);
                                        if(!empty($categories)){ 
                                            $cate=$categories->fetch_assoc();
                                            ?>
                                        <li><span>Loại sản phẩm</span>: <?=$cate['name']?></li>
                                        <?php } ?>
                                    </ul>
                                    <div class="pd-share">
                                        <div class="p-code"><i class="fa-solid fa-eye"></i> Lượt xem : <?=$result['count_view']?></div>
                                        <div class="pd-social">
                                            <a href=""><i class="ti-facebook"></i></a>
                                            <a href=""><i class="ti-twitter"></i></a>
                                            <a href=""><i class="ti-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <div class="product-tab">
                    <div class="customer-review-option">
                        <?php
                        $cmt = $product->get_comment_count($id);
                        $row = $cmt->fetch_assoc();
                        if ($row['comment_count'] > 0) {
                            ?>
                            <h4><?= $row['comment_count'] . " bình luận" ?></h4>
                        <?php } ?>
                        <div class="comment-option">
                            <?php $getcmt = $product->get_comment($id);
                            if ($getcmt) {
                                while ($result_cmt = $getcmt->fetch_assoc()) {
                                    ?>
                                    <div class="co-item">
                                        <div class="avatar-pic">
                                            <img src="uploads/<?= $result_cmt['image'] ?>" alt="">
                                        </div>
                                        <div class="avatar-text">

                                            <div class="rateyo" data-rateyo-rating="<?= $result_cmt['rating'] ?>"
                                                data-rateyo-num-stars="5" data-rateyo-star-width="16px">
                                            </div>

                                        </div>
                                        <h5><span><?= date('Y-m-d', strtotime($result_cmt['created_at'])); ?></span></h5>
                                        <?php if ($result_cmt['comment'] == '') { ?>
                                            <div class="at-reply">Tốt</div>

                                            <?php
                                        } else { ?>
                                            <div class="at-reply"><?= $result_cmt['comment'] ?></div>
                                        <?php } ?>
                                    </div>
                                <?php }
                            } else { ?>
                                <h4>Không có bình luận</h4>
                            <?php } ?>

                        </div>
                        <div class="xly-rating">
                            <div class="personal-rating leave-comment">
                                <h6>Đánh giá của bạn</h6>
                                <form action="" method="POST" class="comment-form">
                                    <div class="pd-rating">
                                        <?php if (isset($_SESSION['auth'])) {

                                            $get_star = $product->get_yourating($id, $userid);
                                            $yrating = 0;
                                            if ($get_star) {

                                                while ($result_star = $get_star->fetch_assoc()) {
                                                    $yrating = $result_star['rating'];
                                                }
                                            }
                                            for ($count = 1; $count <= 5; $count++) {
                                                if ($count <= $yrating) {
                                                    $color = 'color:#F39C12';
                                                } else {
                                                    $color = 'color:#999591';
                                                }
                                                ?>
                                                <li class="rating fa fa-star " style="cursor:pointer;<?= $color ?> "
                                                    id="<?= $id ?>-<?= $count ?>" data-product_id="<?= $id ?>"
                                                    data-rating="<?= $count ?>" data-index="<?= $count ?>"
                                                    data-customer_id="<?= $userid ?>">
                                                </li>
                                            <?php }
                                        } else {
                                            // Nếu không đăng nhập, hiển thị 5 ngôi sao không được chọn
                                            for ($count = 1; $count <= 5; $count++) {
                                                $color = 'color:#999591';
                                                ?>
                                                <li class="rating_login fa fa-star " style="cursor:pointer;<?= $color ?> "></li>
                                            <?php }
                                        }
                                        ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 rating">
                                            <textarea class="" name="cmt" placeholder="Messages"></textarea>
                                            <button type="submit" name="submitcmt" class="site-btn"
                                                value="">Gửi</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<!-- Product Shop Section End-->

<!-- Related Products Section Begin-->
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Những sảm phẩm tương tự</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $idpr = $product->getproductbyId($id);
            $row=$idpr->fetch_assoc();
            $cate_pr_id = $row['category_id'];
            $product_cate = $product->show_product_category($cate_pr_id);
            if ($product_cate) {
                while ($result_pr = $product_cate->fetch_assoc()) {
            ?>
            
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img  style="height:265px; width:265px;" src="uploads/<?= $result_pr['image']?>" alt="">
                                <div class="sale pp-sale">Sale</div>
                                <ul>
                                    <li class="w-icon active"><a href=""><i class="icon_bag_alt"></i></a></li>
                                    <li class="quick-view"><a href="product.php">+ Thêm vào giỏ hàng</a></li>
                                    <li class="w-icon"><a href=""><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name"><?= htmlspecialchars($result_pr['name']) ?></div>
                                <a href="">
                                    <h5><?= htmlspecialchars($result_pr['name']) ?></h5>
                                </a>
                                <div class="product-price">
                                    <?= "₫" . $fm->format_currency($result_pr['selling_price']) ?>
                                    <span><?= "₫" . $fm->format_currency($result_pr['original_price']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

    </div>
</div>
<!-- Related Products Section End-->
<?php
include 'inc/footer.php';
?>