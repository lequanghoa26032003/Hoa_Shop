<?php include 'includes/header.php';
include '../classes/cart.php';
include '../classes/user.php';

$cart = new cart();
$us= new user();
$fm = new Format();
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
if(isset($_GET['pageus'])){
    $pageus=$_GET['pageus'];
}else{
    $pageus=1;
}
if($pageus==''||$pageus==1){
    $beginus=0;
}else{
    $beginus=($pageus*5)-5;
}
?>
    
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-4">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                            <?php $ordertoday=$cart->order_all();
                                if(!empty($ordertoday)){
                                    while($result=$ordertoday->fetch_assoc()){
                                ?>
                                <p class="text-sm mb-0 text-capitalize">Tổng tiền</p>
                                <h4 class="mb-0"><?="đ".$fm->format_currency($result['total_amount'])?></h4>
                                <?php }}else{?>
                                    <p class="text-sm mb-0 text-capitalize">Không có dữ liệu</p>
                                <?php }?>


                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last
                                week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                            <?php $usertoday=$us->user_new();
                                if(!empty($usertoday)){
                                    while($result=$usertoday->fetch_assoc()){
                                ?>
                                <p class="text-sm mb-0 text-capitalize">Khách hàng đăng kí mới</p>
                                <h4 class="mb-0"><?=$result['user_count']?></h4>
                                <?php }}else{?>
                                    <p class="text-sm mb-0 text-capitalize">Không có dữ liệu</p>
                                <?php }?>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last
                                month</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                            <?php $usertoday=$us->user_today();
                                if(!empty($usertoday)){
                                    while($result=$usertoday->fetch_assoc()){
                                ?>
                                <p class="text-sm mb-0 text-capitalize">Khách hàng hôm nay </p>
                                <h4 class="mb-0"><?=$result['user_count']?></h4>
                                <?php }}else{?>
                                    <p class="text-sm mb-0 text-capitalize">Không có dữ liệu</p>
                                <?php }?>

                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than
                                yesterday</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                            <?php $ordertoday=$cart->order_today();
                                if(!empty($ordertoday)){
                                    while($result=$ordertoday->fetch_assoc()){
                                ?>
                                <p class="text-sm mb-0 text-capitalize">Tổng tiền hôm nay</p>
                                <h4 class="mb-0"><?="đ".$fm->format_currency($result['total_amount'])?></h4>
                                <?php }}else{?>
                                    <p class="text-sm mb-0 text-capitalize">Không có dữ liệu</p>
                                <?php }?>

                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than
                                yesterday</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<section class="row">
<div class="col-sm-12 col-md-6 col-xl-5 ">
    <div class="card chart mt-3">
        <form action="#" method="post">
        <div class="input-group mb-2">
            <input  style="margin:5px;" id="start-date" type="date" class="form-control" placeholder="Username" >
            <input  style="margin:5px;" id="end-date" type="date" class="form-control" placeholder="Server" >
            <button style="margin:5px;" type="button" class="btn btn-primary" onclick="getDateValue()">Xem</button>
        </div>
        </form>
        <div class="data_thongke">


        </div>
    </div>
</div>
<div class="col-sm-12 col-md-6 col-xl-4">
    <div class="card chart mt-3">
        <h4 style="padding:8px;">Đơn hàng mới</h4>
        <table class="revenue table table-hover">
            <thead>
                <tr>
                <th class="ps-2">#</th>
                <th class="ps-2">Mã đơn hàng</th>
                <th class="ps-2">Trạng thái</th>
            </tr></thead>
            <tbody>
                <?php $dh=$cart->order_today_page($begin);
                $i=1;
                    if(!empty($dh)){
                        while($result=$dh->fetch_assoc()){
                ?>
                <tr>
                    <td><a href="order-detail.php?t=<?=$result['tracking_no']?>"><?=$i++?></a></td>
                    <td><?=$result['tracking_no']?></td>
                    <td><?=$result['status'] == 0 ? 'Đang chờ' : ($result['status'] == 1 ? 'Hoàn thành' : 'Đã hủy') ?></td>

                </tr>
                <?php } }else{
                    echo "<tr><td colspan='3'>Không có đơn hàng mới nào.</td></tr>";

                }?>


            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <?php $dempage=$cart->order_today();
            if(!empty($dempage)){
                $row_count=$dempage->num_rows;
                $page=ceil($row_count/5);
            }

            ?>
            <ul class="pagination justify-content-center">
                <?php for($i=1;$i<=$page;$i++){
                ?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?=$i?>"><?=$i?></a></li>

                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
<div class="col-sm-12 col-md-6 col-xl-3">
    <div class="card chart mt-3 me-3">
        <h4 style="padding:8px;">Khách hàng mới</h4>
        <table class="revenue table table-hover">
            <thead>
                <tr>
                    <th class="ps-2">#</th>
                    <th class="ps-2">Tên</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dh=$us->user_today_page($beginus);
                $i=1;
                if(!empty($dh)){
                    while($result=$dh->fetch_assoc()){
                ?>
                <tr>
                    <td><?=$i++?></td>
                    <td><?=$result['name']?></td>
                </tr>
                <?php }}else{
                    echo "<tr><td colspan='3'>Không có khách hàng mới nào.</td></tr>";

                }?>

        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <?php $dh=$us->user_today();
            if(!empty($dh)){
                $row_count=$dh->num_rows;
                $pageus=ceil($row_count/5);
            }

            ?>
            <ul class="pagination justify-content-center">
                <?php for($i=1;$i<=$pageus;$i++){
                ?>
                <li class="page-item"><a class="page-link" href="index.php?pageus=<?=$i?>"><?=$i?></a></li>

                <?php } ?>
            </ul>
    </nav>
</div>
</div>
</section>

<?php include 'includes/footer.php' ?>