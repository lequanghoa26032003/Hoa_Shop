<?php
include 'inc/header.php';
// $id = Session::get('id');
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-order'])) {
//     $order = $cart->Orders($_POST);
//     if ($order) {
//         echo '<script>
//                 setTimeout(function(){
//                     window.location.href = "shop.php"; 
//                 }, 1000);
//               </script>';
//     }
// }
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://bio.ziller.vn/api/qr/add",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 2,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer 61c34a4c0bfd91d566eb16333dfcd46d",
        "Content-Type: application/json",
    ),
    CURLOPT_POSTFIELDS => json_encode(array (
        'type' => 'text',
        'data' => '2|99|'.'0367633340'.'|LE QUANG HOA||0|0|'.'10000',
        'background' => 'rgb(255,255,255)',
        'foreground' => 'rgb(0,0,0)',
        'logo' => 'https://img.ziller.vn/ib/AeKJK7AcI1',
)),
));

$response = curl_exec($curl);
curl_close($curl);
$hoashop=json_decode($response);
?>

<!-- Breadcrumb Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Trang chủ</i></a>
                    <a href="shop.php">Cửa hàng</a>
                    <span>Thủ tục thanh toán</span>
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
        <?php if (isset($hoashop->link)): ?>
            <img src="<?=$hoashop->link;?>" alt="Thanh toán đang gặp lỗi">
        <?php else: ?>
            <p>Lỗi: Không thể tạo mã QR.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Shopping Cart Section End -->




<!-- Partner Logo Section End -->
<?php
include 'inc/footer.php';

?>

<!-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script> -->