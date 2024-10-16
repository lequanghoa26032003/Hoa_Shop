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
				case "delete":
					$user_id = $_SESSION['id'];

					$id = $_POST['id'];

					$check_query = "SELECT * FROM tbl_wishlist WHERE id='$id' AND customer_id='$user_id'  ";
					$check_result = mysqli_query($con, $check_query);

					if (mysqli_num_rows($check_result) > 0) {
						$delete_query = "DELETE FROM tbl_wishlist  WHERE id='$id' ";
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
if (isset($_POST['index'])) {
	$index = $_POST['index'];
	$prod_id = $_POST['product_id'];
	$customerid = $_POST['customer_id'];
	$cmt = $_POST['cmt'];

	$check_query = "SELECT id FROM tbl_rating WHERE user_id='$customerid' AND prod_id='$prod_id'";
	$check_result = mysqli_query($con, $check_query);

	if ($check_result && mysqli_num_rows($check_result) > 0) {
		$row = mysqli_fetch_assoc($check_result);
		$rating_id = $row['id'];
		$update_query = "UPDATE tbl_rating SET rating='$index', comment='$cmt' WHERE id='$rating_id'";
		$update_result = mysqli_query($con, $update_query);
		if ($update_result) {
			$_SESSION['alert'] = 'Đã cập nhật đánh giá và comment thành công';
			return true;
		} else {
			$_SESSION['alert'] = 'Có lỗi xảy ra khi cập nhật đánh giá và comment';
			return false;
		}
	} else {
		$insert_query = "INSERT INTO tbl_rating(prod_id, user_id, rating, comment) VALUES ('$prod_id', '$customerid', '$index', '$cmt')";
		$insert_result = mysqli_query($con, $insert_query);
		if ($insert_result) {
			$_SESSION['alert'] = 'Đã thêm mới đánh giá và comment thành công';
			return true;
		} else {
			$_SESSION['alert'] = 'Có lỗi xảy ra khi thêm mới đánh giá và comment';
			return false;
		}
	}
}



?>


<?php
/**
 * 
 */
class product
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insert_product($data, $files, $status, $trending,$sale)
	{
		$category_id = mysqli_real_escape_string($this->db->link, $data['category_id']);
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$slug = mysqli_real_escape_string($this->db->link, $data['slug']);
		$small_description = mysqli_real_escape_string($this->db->link, $data['small_description']);
		$description = mysqli_real_escape_string($this->db->link, $data['description']);
		$original_price = mysqli_real_escape_string($this->db->link, $data['original_price']);
		$selling_price = mysqli_real_escape_string($this->db->link, $data['selling_price']);
		$qty = mysqli_real_escape_string($this->db->link, $data['qty']);
		$status = mysqli_real_escape_string($this->db->link, $status);
		$trending = mysqli_real_escape_string($this->db->link, $trending);
		$sale = mysqli_real_escape_string($this->db->link, $sale);



		$image = $_FILES['image']['name'];
		$path = "../uploads";
		$image_ext = pathinfo($image, PATHINFO_EXTENSION);
		$filename = time() . "." . $image_ext;

		if ($slug == '' || $name == "" || $small_description == "" || $description == "" || $original_price == "" || $selling_price == "" ) {
			$_SESSION['alert'] = 'không được để trống';
			return false;
		} else {
			$query = "INSERT INTO products(category_id,name,slug,small_description,description,original_price,selling_price,image,qty,status,trending,sale) VALUES('$category_id','$name','$slug','$small_description','$description','$original_price','$selling_price','$filename','$qty','$status','$trending','$sale') ";
			$result = $this->db->insert($query);
			if ($result) {
				move_uploaded_file($_FILES["image"]["tmp_name"], $path . '/' . $filename);
				$_SESSION['alert'] = 'Đã được thêm thành công';
				return true;
			} else {
				$_SESSION['alert'] = 'Thêm không thành công';
				return false;
			}

		}
	}

	public function show_product()
	{
		$query = "SELECT * FROM products order by id desc";
		$result = $this->db->select($query);
		return $result;
		// $query =
		// 	"SELECT products.*, tb_cat.catName

		// 	 FROM products INNER JOIN tb_cat ON products.id = tb_cat.id

		// 	 order by products.id desc ";

		// // $query = "SELECT * FROM products order by id desc ";
		// $result = $this->db->select($query);
		// return $result;
	}
	public function show_product_page($begin)
	{
		$query = "SELECT * FROM products order by id desc limit $begin,5";
		$result = $this->db->select($query);
		return $result;

	}
	public function ktrasl($sl){
		$sql="SELECT * FROM products where qty<='$sl' ";
		$runsql=$this->db->select($sql);
		if(!$runsql){
			$_SESSION['alert'] = 'so luong san pham khong du';
		}
	}
	public function update_product($data, $files, $id, $status, $trending,$sale)
	{
		$category_id = mysqli_real_escape_string($this->db->link, $data['category_id']);
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$slug = mysqli_real_escape_string($this->db->link, $data['slug']);
		$small_description = mysqli_real_escape_string($this->db->link, $data['small_description']);
		$description = mysqli_real_escape_string($this->db->link, $data['description']);
		$original_price = mysqli_real_escape_string($this->db->link, $data['original_price']);
		$selling_price = mysqli_real_escape_string($this->db->link, $data['selling_price']);
		$qty = mysqli_real_escape_string($this->db->link, $data['qty']);
		$status = mysqli_real_escape_string($this->db->link, $status);
		$trending = mysqli_real_escape_string($this->db->link, $trending);
		$sale = mysqli_real_escape_string($this->db->link, $sale);



		$new_image = $_FILES['image']['name'];
		$old_image = $_POST['old_image'];
		if ($category_id == "" || $slug == '' || $name == "" || $small_description == "" || $description == "" || $original_price == "" || $selling_price == "" ) {
			$_SESSION['alert'] = 'không được để trống';
			return false;
		} else {
			if ($new_image != "") {
				//$update_filename = $new_image;
				$image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
				$update_filename = time() . "." . $image_ext;

			} else {
				$update_filename = $old_image;
			}
			$path = "../uploads";
			$query = "UPDATE products SET 
						category_id='$category_id',
						name ='$name',
						slug = '$slug',
						small_description = '$small_description',
						description = '$description',
						original_price = '$original_price',
						selling_price = '$selling_price',
						qty = '$qty',
						status = '$status',
						trending = '$trending',
						sale = '$sale',
						image = '$update_filename'

						WHERE id = '$id' ";
			$result = $this->db->update($query);
			if ($result) {
				if ($_FILES['image']['name'] != "") {
					move_uploaded_file($_FILES["image"]["tmp_name"], $path . '/' . $update_filename);
					if (file_exists("../uploads/" . $old_image)) {
						unlink("../uploads/" . $old_image);
					}
				}
				$_SESSION['alert'] = 'Cập nhật thành công';
				return true;
			} else {
				$_SESSION['alert'] = 'Cập nhật thất bại';
				return false;
			}

		}


	}
	public function view_product($id){
		$sql="SELECT count_view FROM products WHERE id='$id' ";
		$run_view=$this->db->select($sql);
		$qty_view=$run_view->fetch_assoc();
		$view=$qty_view['count_view'];
		$view+=1;
		$query = "UPDATE products SET count_view = '$view' WHERE id = '$id'";
		$this->db->update($query);

	}
	public function del_product($id)
	{
		$products_query = "SELECT * FROM products WHERE id = $id";
		$pd_q_run = $this->db->select($products_query);
		$products_data = $pd_q_run->fetch_assoc();
		$image = $products_data['image'];
		$query = "DELETE FROM products WHERE id = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			if (file_exists("../uploads/" . $image)) {
				if (unlink("../uploads/" . $image)) {
					$_SESSION['alert'] = "Xóa thành công";
					return true;
				} else {
					$_SESSION['alert'] = "Không thể xóa tệp tin";
					return false;
				}
			} else {
				$_SESSION['alert'] = "Tệp tin không tồn tại";
				return false;
			}
		} else {
			$_SESSION['alert'] = 'Xóa không thành công';
			return false;
		}
	}


	public function getproductbyId($id)
	{
		$query = "SELECT * FROM products where id = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_product_category($id)
	{
		$query = "SELECT * FROM products WHERE category_id='$id' AND status='1'";
		$result = $this->db->select($query);
		return $result;
	}



	public function getproductslug($slug)
	{
		$query = "SELECT * FROM products WHERE slug='$slug' LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproductsale()
	{
		$query = "SELECT * FROM products WHERE sale='1' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproducttrend()
	{
		$query = "SELECT * FROM products WHERE trending='1' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproductbrand($name)
	{
		$query = "SELECT * FROM products WHERE name='$name' LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_product_qty($id)
	{
		$query = "SELECT * FROM products WHERE id='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	// public function show_product_slug($id, $slug)
	// {
	// 	$query = "SELECT * FROM products WHERE id='$id' AND slug='$slug'";
	// 	$result = $this->db->select($query);
	// 	return $result;
	// }

	public function insertWishlist($customer_id, $status, $id)
	{

		$productid = mysqli_real_escape_string($this->db->link, $id);
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
		if (empty($customer_id)) {
			$_SESSION['error'] = "Đăng nhập để tiếp tục.";
			return true;
		} else {
			// Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
			$check_wlist = "SELECT * FROM tbl_wishlist WHERE prod_id = '$productid' AND customer_id = '$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if ($result_check_wlist) {

				$query_delete = "DELETE FROM tbl_wishlist WHERE prod_id = '$productid' AND customer_id = '$customer_id'";
				$delete_status = $this->db->delete($query_delete);

				if ($delete_status) {
					$_SESSION['alert'] = "Đã xóa sản phẩm khỏi danh sách yêu thích.";
					return true;
				} else {
					$_SESSION['error'] = "Xóa sản phẩm khỏi danh sách yêu thích không thành công.";
					return false;
				}
			} else {
				// Nếu sản phẩm chưa có trong danh sách yêu thích, thêm vào với trạng thái là '1'
				$query_select_product = "SELECT * FROM products WHERE id = '$productid'";
				$result = $this->db->select($query_select_product)->fetch_assoc();

				if (!$result) {
					$_SESSION['error'] = "Không tìm thấy sản phẩm.";
					return false;
				}
				$prod_name = $result["name"];
				if($result['sale']=='1'){
					$price = $result["selling_price"];
				}else{
					$price = $result["original_price"];

				}
				$image = $result["image"];

				$status = '1'; // Trạng thái mới cho sản phẩm chưa có trong danh sách là '1'

				$query_insert = "INSERT INTO tbl_wishlist(customer_id, prod_id, prod_name, price, image, status) 
								VALUES ('$customer_id','$productid',  '$prod_name', '$price', '$image', '$status')";
				$insert_whishlist = $this->db->insert($query_insert);

				if ($insert_whishlist) {
					$_SESSION['alert'] = "Sản phẩm đã được thêm vào danh sách yêu thích.";
					return true;
				} else {
					$_SESSION['error'] = "Đã thêm vào danh sách yêu thích không thành công.";
					return false;
				}
			}
		}

	}
	// public function delWishlist($id)
	// {
	// 	$query = "DELETE FROM tbl_wishlist WHERE id = '$id'";
	// 	$result = $this->db->delete($query);
	// 	return $result;
	// }

	public function show_product_whishlist($id,$us)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$query = "SELECT * FROM tbl_wishlist WHERE prod_id = '$id' AND customer_id='$us' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_whishlist($customer_id)
	{
		$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
$query = "SELECT p.sale as sale, w.* FROM tbl_wishlist w JOIN products p ON w.prod_id = p.id WHERE w.customer_id = '$customer_id' AND w.status = '1'";		$result = $this->db->select($query);
		return $result;
	}
	public function get_star($id)
	{
		$query = "SELECT * FROM tbl_rating WHERE prod_id='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_comment_count($id)
	{
		$query = "SELECT COUNT(*) AS comment_count FROM tbl_rating WHERE prod_id='$id'";
		$result = $this->db->select($query);
		return $result;

	}

	public function get_yourating($id, $userid)
	{
		$query = "SELECT * FROM tbl_rating WHERE prod_id='$id'AND user_id='$userid'";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_comment($id)
	{
		$query = "SELECT * FROM tbl_rating r JOIN users u ON r.user_id=u.id WHERE r.prod_id='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_status_product($id, $status)
    {

        $status = mysqli_real_escape_string($this->db->link, $status);
        $query = "UPDATE products SET status = '$status' where id='$id'";
        $result = $this->db->update($query);
        if($result){
			$_SESSION['alert']='Cập nhật thành công';
		}else{
			$_SESSION['error']='Đã xảy ra lỗi';
		}    
    }
}
?>