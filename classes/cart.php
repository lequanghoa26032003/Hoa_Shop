<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/session.php');

include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['auth'])) {
        if (isset($_POST['scope'])) {
            $scope = $_POST['scope'];

            switch ($scope) {
                case "add":
                    $prod_id = $_POST['prod_id'];
                    $prod_qty = $_POST['prod_qty'];
                    $user_id = $_SESSION['id'];

                    $check_query = "SELECT * FROM carts WHERE user_id='$user_id' AND prod_id='$prod_id'";
                    $check_result = mysqli_query($con, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        $update_query = "UPDATE carts SET prod_qty=prod_qty+'$prod_qty' WHERE user_id='$user_id' AND prod_id='$prod_id'";
                        $update_result = mysqli_query($con, $update_query);

                        if ($update_result) {
                            echo 200;
                        } else {
                            echo 500;
                        }
                    } else {
                        $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ('$user_id', '$prod_id', '$prod_qty')";
                        $insert_result = mysqli_query($con, $insert_query);

                        if ($insert_result) {
                            echo 201;
                        } else {
                            echo 500;
                        }
                    }
                    break;
                case "update":
                    $prod_id = $_POST['prod_id'];
                    $prod_qty = $_POST['prod_qty'];
                    $user_id = $_SESSION['id'];

                    $check_query = "SELECT * FROM carts WHERE user_id='$user_id' AND prod_id='$prod_id'";
                    $check_result = mysqli_query($con, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE user_id='$user_id' AND prod_id='$prod_id'";
                        $update_result = mysqli_query($con, $update_query);
                        if ($update_result) {
                            echo 200;
                        } else {
                            echo 500;
                        }
                    }
                    break;

                case "delete":
                    $user_id = $_SESSION['id'];

                    $cart_id = $_POST['cart_id'];

                    $check_query = "SELECT * FROM carts WHERE cart_id='$cart_id' AND user_id='$user_id'  ";
                    $check_result = mysqli_query($con, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        $delete_query = "DELETE FROM carts  WHERE cart_id='$cart_id' ";
                        $delete_result = mysqli_query($con, $delete_query);
                        if ($delete_result) {
                            echo 200;
                        } else {
                            echo 500;
                        }
                    }
                    break;

                default:
                    echo 500;
            }
        }
    } else {
        echo 401;

    }
}

/**
 * 
 */
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function get_product_cart()
    {
        $userid = $_SESSION['id'];
        $query = "SELECT c.cart_id as cid, c.prod_id, c.prod_qty, p.id as pid,p.sale, p.name, p.image, p.selling_price, p.original_price 
        FROM carts c 
        INNER JOIN products p ON c.prod_id = p.id 
        WHERE c.user_id='$userid' 
        ORDER BY c.cart_id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function Orders($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $total_price = mysqli_real_escape_string($this->db->link, $data['total_price']);
        $payment_mode = mysqli_real_escape_string($this->db->link, $data['payment_mode']);
        // $payment_id = mysqli_real_escape_string($this->db->link, $data['payment_id']);

        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $_SESSION['error'] = "Hãy nhập đầy đủ các trường thông tin";
            return false;
        }
        $tracking_no = "hoa_shop" . rand(1111, 9999) . substr($phone, 2);
        $user_id = $_SESSION['id'];
        $insert = "INSERT INTO orders (tracking_no,user_id,name,phone,email,address,total_price,payment_mode) VALUES ('$tracking_no','$user_id','$name','$phone','$email',
        '$address','$total_price','$payment_mode') ";
        $query = $this->db->insert($insert);
        if ($query) {
            $order_id = mysqli_insert_id($this->db->link);
            $list = $this->get_product_cart();
            if ($list) {
                while ($result = $list->fetch_assoc()) {
                    $prod_id = $result['prod_id'];
                    $prod_qty = $result['prod_qty'];
                    $price = $result['selling_price'];
                    $insert_item_query = "INSERT INTO order_items(order_id,prod_id,qty,price)VALUES
                    ('$order_id','$prod_id','$prod_qty','$price')";
                    $insert_item_query = $this->db->insert($insert_item_query);
                    $qty_product = "SELECT qty FROM  products WHERE id='$prod_id'";
                    $update_product = "UPDATE products SET qty=qty-'$prod_qty' WHERE ID='$prod_id'";
                    mysqli_query($this->db->link, $update_product);
                }
                $deleteCart = "DELETE FROM carts WHERE user_id='$user_id'";
                mysqli_query($this->db->link, $deleteCart);
                $_SESSION['alert'] = "Đặt hàng thành công";
                return true;
            }
        }

        return true;
    }
    public function Ordersonl($data)
    {
        $total_price = $data['vnp_Amount'] / 100;
        $payment_mode = $data['vnp_BankCode'];
        $tracking_no = $data['vnp_TxnRef'];
        $user_id = $data['vnp_OrderInfo'];
        $user = "SELECT * FROM users WHERE id='$user_id'";
		$check_query = $this->db->select($user);
        $result=$check_query->fetch_assoc();
        $name=$result['name'];
        $email=$result['email'];
        $phone=$result['phone'];
        $address=$result['address'];
        $insert = "INSERT INTO orders (tracking_no,user_id,name,phone,email,address,total_price,payment_mode) VALUES ('$tracking_no','$user_id','$name','$phone','$email',
        '$address','$total_price','$payment_mode') ";
        $query = $this->db->insert($insert);
        if ($query) {
            $order_id = mysqli_insert_id($this->db->link);
            $list = $this->get_product_cart();
            if ($list) {
                while ($result = $list->fetch_assoc()) {
                    $prod_id = $result['prod_id'];
                    $prod_qty = $result['prod_qty'];
                    $price = $result['selling_price'];
                    $insert_item_query = "INSERT INTO order_items(order_id,prod_id,qty,price)VALUES
                    ('$order_id','$prod_id','$prod_qty','$price')";
                    $insert_item_query = $this->db->insert($insert_item_query);
                    $qty_product = "SELECT qty FROM  products WHERE id='$prod_id'";
                    $update_product = "UPDATE products SET qty=qty-'$prod_qty' WHERE ID='$prod_id'";
                    mysqli_query($this->db->link, $update_product);
                }
                $deleteCart = "DELETE FROM carts WHERE user_id='$user_id'";
                mysqli_query($this->db->link, $deleteCart);
                $_SESSION['alert'] = "Đặt hàng thành công";
                return true;
            }
        }

        return true;
    }
    public function get_Order()
    {

        $userid = $_SESSION['id'];
        $query = "SELECT * FROM orders  WHERE user_id='$userid' order by id desc ";
        $result = $this->db->select($query);
        return $result;

    }
    public function getAllOrder()
    {
        $query = "SELECT * FROM orders  WHERE status='0' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;

    }
    public function showAllOrder()
    {
        $query = "SELECT * FROM orders   ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;

    }
    public function gethistoryOrder()
    {
        $query = "SELECT * FROM orders  WHERE status!='0'";
        $result = $this->db->select($query);
        return $result;

    }
    public function detailGetAllOrder($tracking_no)
    {
        $query = "SELECT * FROM orders  WHERE tracking_no='$tracking_no'";
        $result = $this->db->select($query);
        return $result;

    }
    public function detail_Order($tracking_no)
    {
        $userid = $_SESSION['id'];

        $query = "SELECT * FROM orders  WHERE user_id='$userid' AND tracking_no='$tracking_no'";
        $result = $this->db->select($query);
        return $result;

    }

    public function update_Order($tracking_no, $order_status)
    {
        $query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$tracking_no'";
        $result = $this->db->update($query);

        if ($result) {
            return "order-detail.php?t=$tracking_no";
        }
    }
    public function order_today(){
        $query="SELECT COUNT(*) AS order_count, SUM(total_price) AS total_amount FROM orders WHERE DATE(created_at) = CURDATE() AND status='1'";
        $result=$this->db->select($query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
    public function order_all(){
        $query="SELECT COUNT(*) AS order_count, SUM(total_price) AS total_amount FROM orders  WHERE status='1'";
        $result=$this->db->select($query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
    public function show_order_page($begin)
	{
		$query = "SELECT * FROM orders WHERE status='0' order by id desc limit $begin,5 ";
		$result = $this->db->select($query);
        if($result){
            return $result;
        }else{
            return false;
        }
	}
    public function order_today_page($begin){
        $query = "SELECT * FROM orders WHERE DATE(created_at) = CURDATE() AND status = '1' ORDER BY created_at DESC LIMIT $begin, 5";
        $result=$this->db->select($query);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

}

?>