<?php

include_once '../lib/session.php';
Session::checkLogin();
include_once '../lib/database.php';
include '../helpers/format.php';
?>



<?php
/**
 * 
 */
class adminlogin
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function login_admin($adminEmail, $adminPass)
	{
		$adminEmail = $this->fm->validation($adminEmail); //gọi ham validation từ file Format để ktra
		$adminPass = $this->fm->validation($adminPass);

		$adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass); //mysqli gọi 2 biến. (adminEmail and link) biến link -> gọi conect db từ file db

		if (empty($adminEmail) || empty($adminPass)) {
			$_SESSION['error'] = "Tài khoản và mật khẩu không được trống";
			return false;
		} else {
			$query = "SELECT * FROM tbl_admin WHERE adminEmail = '$adminEmail' AND adminPass = '$adminPass' LIMIT 1 ";
			$result = $this->db->select($query);

			if ($result != false) {
				// session_start();
				// $_SESSION['login'] = 1;
				// $_SESSION['user'] = $adminEmail;
				$value = $result->fetch_assoc();
				Session::set('login', true); // set adminlogin đã tồn tại
				// gọi function Checklogin để kiểm tra true.
				Session::set('adminId', $value['adminId']);
				Session::set('adminEmail', $value['adminEmail']);
				Session::set('adminName', $value['adminName']);
				header("Location:index.php");
			} else {
				$_SESSION['error'] = "Tài khoản hoặc mật khẩu không chính xác";
				return false;
			}
		}


	}

}
?>