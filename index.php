<?php
include 'inc/header.php';
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
if($page==''||$page==1){
    $begin=0;
}else{
    $begin=($page*5)-5;
}
?>
<!-- -->
<!-- Hero Section Begin-->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <?php $list = $cat->show_slider();
        if ($list) {
            while ($result = $list->fetch_assoc()) {
                ?>
                <div class="single-hero-items set-bg" data-setbg="uploads/<?= $result['sliderImage'] ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5">
                                <h1><?=$result['sliderName']?></h1>
                                <p><?=$result['description']?></p>
                            </div>
                        </div>
                        <!-- <div class="off-card">
                            <h2>Sale<span>50%</span></h2>
                        </div> -->
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</section>
<!-- Hero Section End-->


<!-- Women Banner Section Begin-->
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 offset-lg-1">
                <div class="filter-control">
                    <ul>
                        <li class="active">Saleing</li>

                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    <?php $list=$product->getproductsale();
                    if(!empty($list)){
                        while($result=$list->fetch_assoc()){
                    ?>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img style="width: 100%; height: 390px;" src="uploads/<?=$result['image']?>" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href=""> <i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="product.php?product=<?= $result['id'] ?>">+ Xem chi tiết</a></li>
                                <li class="w-icon"><a href=""> <i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name"></div>
                            <a href="">
                                <h5><?= $result['name'] ?></h5>
                                <div class="product-price">
                                <?php if($result['sale']=='1'){?>
                                <?= "₫" . $fm->format_currency($result['selling_price']) ?>
                                <span><?= "₫" .$fm->format_currency($result['original_price'])?></span>
                                <?php }else{?>
                                <?= "₫" . $fm->format_currency($result['original_price']) ?>

                                <?php }?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End-->
<!-- Deal Of The Week Section Begin-->
<section class="deal-of-week set-bg spad" data-setbg="img/time-bg.jpg">
    <div class="container">
        <div class="col-lg-6 text-center">
            <div class="section-title">
                <h2>Deal Of The Week</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae soluta eaque quibusdam quod
                    recusandae ad, dolor provident cupiditate quis doloremque porro aut cumque magni, exercitationem,
                    hic minima dolorem ab. Dolores.</p>
                <div class="product-price">
                    $35.00
                    <span>/ HanBag</span>
                </div>
            </div>
            <div class="countdown-timer" id="countdown">
                <div class="cd-item">
                    <span>56</span>
                    <p>Days</p>
                </div>
                <div class="cd-item">
                    <span>10</span>
                    <p>Hrs</p>
                </div>
                <div class="cd-item">
                    <span>30</span>
                    <p>Mins</p>
                </div>
                <div class="cd-item">
                    <span>59</span>
                    <p>Secs</p>
                </div>
            </div>
            <a href="" class="primary-btn">Shop Now</a>
        </div>
    </div>
</section>
<!-- Deal Of The Week Section End-->

<!--Man Banner Section Begin-->
<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 offset-lg-1">
                <div class="filter-control">
                    <ul>
                        <li class="active">Trending</li>
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                <?php $list=$product->getproducttrend();
                    if(!empty($list)){
                        while($result=$list->fetch_assoc()){
                    ?>
                    <div class="product-item">
                        <div  class="pi-pic">
                            <img style="width: 100%; height: 390px;" src="uploads/<?=$result['image']?>" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href=""> <i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="product.php?product=<?= $result['id'] ?>">+ Xem chi tiết</a></li>
                                <li class="w-icon"><a href=""> <i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name"></div>
                            <a href="">
                                <h5><?= $result['name'] ?></h5>
                                <div class="product-price">
                                <?php if($result['sale']=='1'){?>
                                <?= "₫" . $fm->format_currency($result['selling_price']) ?>
                                <span><?= "₫" .$fm->format_currency($result['original_price'])?></span>
                                <?php }else{?>
                                <?= "₫" . $fm->format_currency($result['original_price']) ?>

                                <?php }?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Man Banner Section End-->

<!-- Instagram Section Begin-->
<div class="instagram-photo">
    <div class="insta-item set-bg" data-setbg="img/insta-1.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="">Hoa_Shop_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-2.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="">Hoa_Shop_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-3.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="">Hoa_Shop_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-4.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="">Hoa_Shop_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-5.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="">Hoa_Shop_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="img/insta-6.jpg">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="">Hoa_Shop_Collection</a></h5>
        </div>
    </div>
</div>
<!-- Instagram Section End-->

<!-- Latest Blog Section Begin-->
<section class="latest-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-10 offset-lg-1">

                <div class="product-slider owl-carousel">
                <?php
            $list = $blog->show_blog_page_index($begin);
            if (!empty($list)) {
                while ($result = $list->fetch_assoc()) {
            ?>
                <div class="single-latest-blog">
                    <img style="width:100%; height:auto; cursor:pointer;" src="uploads/<?= htmlspecialchars($result['image']) ?>" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i><?= date('d/m/Y', strtotime($result['created_at'])) ?>
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i><?= $result['comment_count'] ?>
                            </div>
                        </div>
                        <a href="blog-details.php?idblog=<?= urlencode($result['id']) ?>">
                            <h4><?= htmlspecialchars(substr($result['title'], 0, 32) . "...") ?></h4>
                        </a>
                        <p><?= htmlspecialchars(substr(strip_tags($result['description']), 0, 10) . "...") ?></p>
                        </div>
            </div>
            <?php
                }
            }
            ?>
                </div>
            </div>
        </div>

        <div class="benefit-items">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-1.png" alt="">
                        </div>
                        <div class="sb-icon">
                            <h6>Free Shipping</h6>
                            <p>For all order over 99$</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-2.png" alt="">
                        </div>
                        <div class="sb-icon">
                            <h6>Delivery On Time</h6>
                            <p>If good have problems</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="img/icon-3.png" alt="">
                        </div>
                        <div class="sb-icon">
                            <h6>Secure Payment</h6>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End-->
<?php
include 'inc/footer.php';
?>