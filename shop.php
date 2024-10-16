<?php
include 'inc/header.php';
$id = null;
$idbrand = null;

if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
if($page==''||$page==1){
    $begin=0;
}else{
    $begin=($page*6)-6;
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
                    <span>Cửa hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End-->

<!-- Product Shop Section Begin-->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-lg-1 products-sidebar-filter">
            <div class="filter-widget">
                <h4 class="fw-title">Khoảng giá</h4>
                <div class="filter-range-wrap">
                    <div class="range-slider">
                        <div class="price-input">
                            <input type="hidden" id="hidden_minimum_price" value="0" />
                            <input type="hidden" id="hidden_maximum_price" value="650000" />
                            <p id="price_show">1000 - 650000</p>


                            <div  class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content ui-slider-range ui-corner-all ui-widget-header ui-slider-handle ui-corner-all ui-state-default"  tabindex="0" id="price_range" >                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter-widget">
                <h4 class="fw-title">Thương hiệu</h4>
                <div class="fw-brand-check">
                    <?php
                    $brand = $cat->show_category();
                    $i = 0;
                    if ($brand) {
                        while ($result = $brand->fetch_assoc()) {
                        $i++;
                        ?>
                        <div class="bc-item">
                            <form id="brandForm" action="" method="POST">
                                <label for="bc-calvin<?= $i ?>">
                                    <?= $result['name'] ?>
                                    <input type="checkbox" name="brand[]" value="<?= $result['id'] ?>"
                        id="bc-calvin<?= $i ?>" class="common_selector brand">
                                    <span class="checkmark"></span>
                                </label>
                            </form>
                        </div>

                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2 ">

                <div class="product-list">
                    <div class="row filter_data">
                        
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <?php $sql_trang=$product->show_product();
                $row_count=$sql_trang->num_rows;
                $page=ceil($row_count/6);
            ?>
            <ul class="pagination justify-content-center">
                <?php for($i=1;$i<=$page;$i++){
                ?>
                <li class="page-item"><a class="page-link" href="shop.php?page=<?=$i?>"><?=$i?></a></li>

                <?php } ?>
            </ul>
        </nav>
</section>

<!-- Product Section End-->
<?php
include 'inc/footer.php';
?>