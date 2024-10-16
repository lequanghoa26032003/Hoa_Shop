<?php
include 'inc/header.php';
$userid = Session::get('id');

?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
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
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $list = $product->show_whishlist($id);
                    if ($list) {
                        ?>
                        <div class="cart-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Image</th>
                                        <th style="width: 40%;">Product Name</th>
                                        <th style="width: 20%;">Price</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($result = $list->fetch_assoc()) { ?>

                                        <table>

                                            <tr>
                                                <td style="width: 20%;" class="p-pic first-row"><img
                                                        style="height:100px; width:100px; margin:0 0 0 -15px;"
                                                        src="uploads/<?= $result['image'] ?>" alt=""></td>
                                                <td style="width: 40%;" class="cart-title first-row">
                                                    <h5><?= $result['prod_name'] ?></h5>
                                                </td>
                                                <td style="width: 20%;" class="p-price first-row">
                                                    <?php if($result['sale']=='1'){?>
                                                    <?= "₫" . $fm->format_currency($result['sale_price']) ?>
                                                    <?php }else{?>
                                                    <?= "₫" . $fm->format_currency($result['price']) ?>

                                                    <?php }?>
                                                </td>
                                                <td style="width: 20%;" class="total-price first-row">
                                                    <div style="display: flex; align-items: center;">
                                                        <div style="margin-right: 10px;">
                                                            <form method="post" action="wishlist.php">
                                                                <button type="submit" name="deleteWishlist"
                                                                    class="deleteWishlist btn btn-danger"
                                                                    value="<?= $result['id'] ?>">
                                                                    <i class="fa fa-trash"></i> Xóa
                                                                </button>
                                                            </form>

                                                        </div>
                                                        <div>
                                                            <button
                                                                onclick="location.href='product.php?product=<?= $result['prod_id'] ?>'"
                                                                class="buyNow btn btn-primary">
                                                                <i class="fa fa-shopping-cart"></i> Mua
                                                            </button>

                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </table>

                                        <?php
                                    }
                                    ?>
                                </tbody>


                            </table>

                        </div>
                        <?php
                    } else {
                        echo '<div class="checkout-content mx-auto d-block">
                                <a href="login.php" class="content-btn">Bạn chưa có sản phẩm yêu thích nào</a>
                            </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <nav aria-label="Page navigation example">
            <?php $sql_trang=$product->show_whishlist($userid);
            if (!empty($sql_trang)) {
                $row_count=$sql_trang->num_rows;
                $page=ceil($row_count/5);
            }
            ?>
            <ul class="pagination justify-content-center">
                <?php for($i=1;$i<=$page;$i++){
                ?>
                <li class="page-item"><a class="page-link" href="wishlist.php?page=<?=$i?>"><?=$i?></a></li>

                <?php } ?>
            </ul>
        </nav>
</div>
<!-- Shopping Cart Section End-->

<?php
include 'inc/footer.php';
?>