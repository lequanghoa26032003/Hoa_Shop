<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class category
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insert_category($data, $status, $popular)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);

		$status = mysqli_real_escape_string($this->db->link, $status);
		$popular = mysqli_real_escape_string($this->db->link, $popular);


		if ($name == "") {
			$_SESSION['error'] = 'không được để trống';
			return false;
		} else {
			$query = "INSERT INTO categories(name,status,popular) VALUES('$name','$status','$popular') ";
			$result = $this->db->insert($query);
			if ($result) {
				$_SESSION['alert'] = 'Đã được thêm thành công';
				return true;
			} else {
				$_SESSION['error'] = 'Thêm không thành công';
				return false;
			}

		}
	}
	public function update_category($data, $id, $status, $popular)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);

		$status = mysqli_real_escape_string($this->db->link, $status);
		$popular = mysqli_real_escape_string($this->db->link, $popular);


		if ($name == "") {
			$_SESSION['error'] = 'không được để trống';
			return false;
		} else {

			$query = "UPDATE categories SET 
						name ='$name',
						status = '$status',
						popular = '$popular'
						WHERE id = '$id' ";
			$result = $this->db->update($query);
			if ($result) {
				$_SESSION['alert'] = 'Cập nhật thành công';
				return true;
			} else {
				$_SESSION['error'] = 'Cập nhật thất bại';
				return false;
			}

		}


	}
	public function del_category($id)
	{

		$query = "DELETE FROM categories WHERE id = '$id'";
		$result = $this->db->delete($query);
		if ($result) {
			$_SESSION['alert'] = "Xóa thành công";
		} else {
			$_SESSION['error'] = 'Xóa không thành công';
			return false;
		}
	}


	public function insert_slider($data, $files)
	{
		$sliderName = mysqli_real_escape_string($this->db->link, $data['title']);
		$status = mysqli_real_escape_string($this->db->link, $data['type']);
		$des = mysqli_real_escape_string($this->db->link, $data['des']);

		$image = $_FILES['image']['name'];
		$path = "../uploads";
		$image_ext = pathinfo($image, PATHINFO_EXTENSION);
		$filename = time() . "." . $image_ext;

		if (empty($sliderName)) {
			$_SESSION['error'] = 'không được để trống';
			return false;
		} else {
			$query = "INSERT INTO tbl_slider(sliderName,description,sliderImage,type) VALUES('$sliderName','$des','$filename','$status') ";
			$result = $this->db->insert($query);
			if ($result) {
				move_uploaded_file($_FILES["image"]["tmp_name"], $path . '/' . $filename);
				$_SESSION['alert'] = 'Đã được thêm thành công';
				return true;
			} else {
				$_SESSION['error'] = 'Thêm không thành công';
				return false;
			}

		}

	}
	public function show_slider()
	{
		$query = "SELECT * FROM tbl_slider where type='1' order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function del_slider($id)
	{
		$query = "DELETE FROM tbl_slider where id='$id'";
		$result = $this->db->delete($query);
		return $result;
	}
	public function show_slider_list()
	{
		$query = "SELECT * FROM tbl_slider order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_status_slider($id, $status)
	{

		$status = mysqli_real_escape_string($this->db->link, $status);
		$query = "UPDATE tbl_slider SET type = '$status' where id='$id'";
		$result = $this->db->update($query);
		return $result;
	}
	public function update_slide($data, $files, $id)
	{
		$sliderName = mysqli_real_escape_string($this->db->link, $data['title']);
		$des = mysqli_real_escape_string($this->db->link, $data['des']);

		$status = mysqli_real_escape_string($this->db->link, $data['type']);

		$new_image = $_FILES['image']['name'];
		$old_image = $_POST['old_image'];
		if (empty($sliderName)) {
			$_SESSION['error'] = 'không được để trống';
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
			$query = "UPDATE tbl_slider SET 
						sliderName ='$sliderName',
						description ='$des',
						sliderImage = '$update_filename',
						type = '$status'
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
				$_SESSION['error'] = 'Cập nhật thất bại';
				return false;
			}

		}


	}
	public function getsliderbyId($id)
	{
		$query = "SELECT * FROM tbl_slider where id = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_categories_warehouse()
	{
		$query =
			"SELECT categories.*, tbl_warehouse.*

			 FROM categories INNER JOIN tbl_warehouse ON categories.id = tbl_warehouse.id_sanpham

			 order by tbl_warehouse.sl_ngaynhap desc ";


		$result = $this->db->select($query);
		return $result;
	}
	public function show_category()
	{
		$query = "SELECT * FROM categories order by id desc";
		$result = $this->db->select($query);
		return $result;
		// $query =
		// 	"SELECT categories.*, tb_cat.catName

		// 	 FROM categories INNER JOIN tb_cat ON categories.id = tb_cat.id

		// 	 order by categories.id desc ";

		// // $query = "SELECT * FROM categories order by id desc ";
		// $result = $this->db->select($query);
		// return $result;
	}




	public function getcategorybyId($id)
	{
		$query = "SELECT * FROM categories where id = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_slug_id($brand)
	{
		$query = "SELECT * FROM categories WHERE name='$brand' LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_brand_id($brand_filter)
	{
		$query = "SELECT * FROM categories WHERE name IN ('$brand_filter')";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_status_category($id, $status)
    {

        $status = mysqli_real_escape_string($this->db->link, $status);
        $query = "UPDATE categories SET status = '$status' where id='$id'";
        $result = $this->db->update($query);
        if($result){
			$_SESSION['alert']='Cập nhật thành công';
		}else{
			$_SESSION['error']='Đã xảy ra lỗi';
		}
    }
	public function show_slider_page($begin)
	{
		$query = "SELECT * FROM tbl_slider order by id desc limit $begin,5";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_category_page($begin)
	{
		$query = "SELECT * FROM categories order by id desc limit $begin,5";
		$result = $this->db->select($query);
		return $result;

	}
}