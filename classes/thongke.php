<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
$db = new Database();
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
$query = "SELECT SUM(total_price) AS total FROM orders WHERE status='1'";
if (isset($_POST["startDate"], $_POST["endDate"]) && !empty($_POST["startDate"]) && !empty($_POST["endDate"])) {
    $min = $_POST["startDate"];
    $max = $_POST["endDate"];
    $query .= " AND DATE(created_at) BETWEEN '$min' AND '$max'";
}

$result = $db->select($query);
$total = 0;
if ($result) {
    $price = $result->fetch_assoc();
    $total = $price['total'];
}
?>
<p>Tổng doanh thu: <span><?= "đ".$fm->format_currency($total) ?></span></p>
<table class="revenue table table-hover">
    <thead>
        <tr>
            <th class="ps-2">#</th>
            <th class="ps-2">Mã đơn hàng</th>
            <th class="ps-2">Doanh thu</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(isset($min, $max)){
            $result = $db->select("SELECT * FROM orders WHERE DATE(created_at) BETWEEN '$min' AND '$max' AND status='1'");
        } else {
            $result = $db->select("SELECT * FROM orders WHERE status='1' ORDER BY id DESC LIMIT $begin,5");
        }

        if ($result && $result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['tracking_no'] ?></td>
                    <td><?="đ".$fm->format_currency($row['total_price']) ?></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='3'>Không có đơn hàng nào.</td></tr>";
        }
        ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
  <?php 
  if(!empty($result)){
    $row_count=$result->num_rows;
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
