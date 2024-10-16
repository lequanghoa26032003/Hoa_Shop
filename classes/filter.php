<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
$db=new Database();
$fm=new Format();
$begin=$_POST['begin'];

$query = "SELECT p.id,p.name,p.sale, p.selling_price, p.original_price, p.image FROM products p JOIN categories e ON p.category_id =e.id  WHERE p.status='1'";
if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
$min=$_POST["minimum_price"];
$max=$_POST["maximum_price"];
$query .= " AND selling_price  BETWEEN '$min' AND '$max'";
}
if(isset($_POST['brand'])){
    $list_brand=implode("','",$_POST['brand']);
    $query.= "AND e.id  IN ('$list_brand')";
}
$query .= "  order by id desc limit $begin,6";
$result = $db->select($query);

if (!empty($result)) { // Kiểm tra có dữ liệu trả về không
    while ($row = $result->fetch_assoc()) { // Sử dụng mysqli_fetch_assoc để lấy từng hàng dữ liệu
?>
    <div class="col-lg-4 col-sm-6">
        <div class="product-item">
            <form action="" method="POST" >
                <div class="pi-pic ">
                    <img style="height:265px; width:265px;" src="uploads/<?= $row['image'] ?>" alt="">
                    <div class="sale pp-sale">Sale</div>                    
                    <ul>
                      <li class="quick-view"><a href="product.php?product=<?= $row['id'] ?>">+ Xem chi tiết</a></li>
                    </ul>
                </div>
                <div class="pi-text">
                    <div class="catagory-name">Towel</div>
                    <a href=""><h5><?= $row['name'] ?></h5></a>
                    <div class="product-price">
                        <?php if($row['sale']=='1'){?>
                        <?= "₫" . $fm->format_currency($row['selling_price']) ?>
                        <span><?= "₫" .$fm->format_currency($row['original_price'])?></span>
                        <?php }else{?>
                        <?= "₫" . $fm->format_currency($row['original_price']) ?>

                        <?php }?>

                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
    }
} else {
    echo "Không có sản phẩm nào.";
}
?>
