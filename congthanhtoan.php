<?php
include 'classes/cart.php';
include 'classes/user.php';

$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];


$cart = new cart();
$us = new user();
?>
<?php $list = $cart->get_product_cart();
$tongphu = 0;
$tong = 0;
if ($list) {
    while ($result = $list->fetch_assoc()) { ?>
        <li class="fw-normal" style="margin: -20px 0 0 0"><img
                style="width:40px;height:40px;   " src="uploads/<?= $result['image'] ?>" alt="">
                <?php if($result['sale']){?>
                  <?= $result['name'] . " x " . $result['prod_qty'] ?><span><?= $tongphu = $result['selling_price'] ?></span>
                <?php }else{?>
                  <?= $result['name'] . " x " . $result['prod_qty'] ?><span><?=$tongphu = $result['original_price'] ?></span>

                <?php }?>
        </li>
        <?php $tong += $tongphu * $result['prod_qty'];
    }
} ?>
<?php

$ttuser=$us->get_user($id);
    if($ttuser){
        while($runtt=$ttuser->fetch_assoc()){
    ?>
        <?php $name = $result['name'];?>
        <?php $phone = $result['phone'];?>
        <?php $email = $result['email'];?>
        <?php $address = $result['address'];?>

    <?php }} ?>
<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_TmnCode = "SXCTK7MC"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "OCGDZKVTMJJLYLJIHXKBVDVXJKXBXSRM"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost:2603/SHOP_BANH/my-order.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
$vnp_TxnRef = "hoa_shop" . rand(1111, 9999) . substr($phone, 2);
$vnp_Amount = $tong;
$vnp_Locale = 'vn'; 
$vnp_BankCode = 'NCB'; 
$vnp_name = $name; 
$vnp_phone = $phone; 
$vnp_email = $email; 
$vnp_address = $address; 
$vnp_usid = $id; 
$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; 
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_usid,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,

);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}


ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}

header('Location: ' . $vnp_Url);


die();

?>