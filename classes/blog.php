<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
$db=new Database();
$fm=new Format();

$query = "SELECT b.*,(SELECT COUNT(*) FROM tbl_blog_comments c WHERE c.blog_id = b.id) +
                     (SELECT COUNT(*) FROM tbl_reply_to_comments rc 
                      JOIN tbl_blog_comments c ON rc.blog_comment_id = c.id
                      WHERE c.blog_id = b.id) AS comment_count
            FROM tbl_blog b
            WHERE b.status='1'";
if (isset($_POST["input"]) && !empty($_POST["input"])) {
$input=$_POST["input"];
$query .= " AND b.title  BETWEEN '$input'";
}
if(isset($_POST['brand'])){
    $list_brand=implode("','",$_POST['brand']);
    $query.= "AND e.id  IN ('$list_brand')";
}
if (isset($_POST["begin"]) && !empty($_POST["begin"])) {

    $begin=$_POST['begin'];
$query .= "  order by id desc limit $begin,6";

    }
$result = $db->select($query);

class blog
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_blog($data, $files, $status)
    {
        $category_post_id = mysqli_real_escape_string($this->db->link, $data['category_post_id']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $status);

        $image = $_FILES['image']['name'];
        $path = "../uploads";
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . "." . $image_ext;

        if ($name == ""|| $description == "") {
            $_SESSION['error'] = 'không được để trống';
            return false;
        } else {
            $query = "INSERT INTO tbl_blog(title,description,content,category_post_id,image,status) VALUES('$name','$description','$content','$category_post_id','$filename','$status') ";
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

    public function show_blog()
    {
        $query = "SELECT b.*, COUNT(c.id) AS comment_count
                  FROM tbl_blog b
                  LEFT JOIN tbl_blog_comments c ON b.id = c.blog_id
                  WHERE b.status='1'
                  GROUP BY b.id
                  ORDER BY b.id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function page_blog()
    {
        $query = "SELECT *
                  FROM tbl_blog
                  ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_status_blog($id, $status)
    {

        $status = mysqli_real_escape_string($this->db->link, $status);
        $query = "UPDATE tbl_blog SET status = '$status' where id='$id'";
        $result = $this->db->update($query);
        return $result;
    }

    public function update_blog($data, $files, $id, $status)
    {
        $category_post_id = mysqli_real_escape_string($this->db->link, $data['category_post_id']);
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content = mysqli_real_escape_string($this->db->link, $data['content']);
        $status = mysqli_real_escape_string($this->db->link, $status);

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];
        if ($name == "" || $description == "") {
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
            $query = "UPDATE tbl_blog SET 
						title='$name',
						description = '$description',
						content = '$content',
                        category_post_id='$category_post_id',
						image = '$update_filename',
						status = '$status'

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
    public function del_blog($id)
    {
        $products_query = "SELECT * FROM tbl_blog WHERE id = $id";
        $pd_q_run = $this->db->select($products_query);
        $products_data = $pd_q_run->fetch_assoc();
        $image = $products_data['image'];
        $query = "DELETE FROM tbl_blog WHERE id = '$id'";
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


    public function getblogbyId($id)
    {
        $query = "SELECT * FROM tbl_blog where id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function insert_blog_comment($userid, $blog_id, $cmt){
		if(!empty($userid)){
            if(empty($cmt)){
            $_SESSION['error']='Không thể gửi bình luận trống';
            return true;
            }else{
                $insert_query = "INSERT INTO tbl_blog_comments(user_id,blog_id, cmt) VALUES ( '$userid', '$blog_id', '$cmt')";
                $insert_result = $this->db->insert($insert_query);
                if ($insert_result) {
                    $_SESSION['alert'] = 'Đã thêm mới bình luận thành công';
                    return true;
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra';
                    return false;
                }
            }
        }else{
            $_SESSION['error']='Vui lòng đăng nhập để bình luận';
            return true;
        }
	}
    public function show_blog_comment($blog_id){
		$select_query = "SELECT b.id as bid,u.id as uid,b.*,u.* FROM  tbl_blog_comments b JOIN users u ON b.user_id =u.id WHERE blog_id='$blog_id' ";
		$select_result = $this->db->select($select_query);
        return $select_result;
	}
    public function show_blog_comments(){
		$select_query = "SELECT bl.image as blimage,b.id as bid,u.id as uid,b.*,u.* FROM  tbl_blog_comments b JOIN users u ON b.user_id =u.id JOIN tbl_blog bl ON bl.id=b.blog_id ";
		$select_result = $this->db->select($select_query);
        return $select_result;
	}
    public function show_blog_comments_page($begin){
		$select_query = "SELECT bl.image as blimage,b.id as bid,u.id as uid,b.*,u.* FROM  tbl_blog_comments b JOIN users u ON b.user_id =u.id JOIN tbl_blog bl ON bl.id=b.blog_id ORDER BY bid LIMIT $begin,10";
		$select_result = $this->db->select($select_query);
        return $select_result;
	}
    public function update_blog_comment($id, $cmt){
		$update_query = "UPDATE tbl_blog_comments SET cmt= '$cmt' WHERE id='$id' ";
		$update_result = $this->db->update($update_query);
		if ($update_result) {
			$_SESSION['alert'] = 'Cập nhật bình luận thành công';
			return true;
		} else {
			$_SESSION['error'] = 'Có lỗi xảy ra';
			return false;
		}
	}
    public function del_blog_comment($blog_comment_id){
		$select_query = "DELETE FROM  tbl_blog_comments   WHERE id='$blog_comment_id' ";
		$select_result = $this->db->delete($select_query);
        if ($select_result) {
			$_SESSION['alert'] = 'Xóa bình luận thành công';
			return true;
		} else {
			$_SESSION['error'] = 'Có lỗi xảy ra';
			return false;
		}  
    }
    public function insert_reply_blog_comment($blog_comment_id,$us, $cmt){
            if(empty($cmt)){
            $_SESSION['error']='Không thể gửi bình luận trống';
            return true;
            }else{
                $insert_query = "INSERT INTO tbl_reply_to_comments(blog_comment_id,user_id, cmt) VALUES ('$blog_comment_id','$us', '$cmt')";
                $insert_result = $this->db->insert($insert_query);
                if ($insert_result) {
                    $_SESSION['alert'] = 'Đã thêm mới bình luận thành công';
                    return true;
                } else {
                    $_SESSION['alert'] = 'Có lỗi xảy ra';
                    return false;
                }
            }
    }
    public function show_reply_blog_comment($blog_cmt_id){
		$select_query = "SELECT u.id as uid ,u.name as uname, u.image as uimage, r.cmt as rcmt,r.id as rid
        FROM tbl_reply_to_comments r 
        JOIN tbl_blog_comments b ON r.blog_comment_id = b.id 
        JOIN users u ON r.user_id = u.id 
        WHERE r.blog_comment_id = '$blog_cmt_id'
        ";
		$select_result = $this->db->select($select_query);
        return $select_result;
	}
    public function update_reply_blog_comment($id, $cmt){
		$update_query = "UPDATE tbl_reply_to_comments SET cmt= '$cmt' WHERE id='$id'";
		$update_result = $this->db->update($update_query);
		if ($update_result) {
			$_SESSION['alert'] = 'Cập nhật bình luận thành công';
			return true;
		} else {
			$_SESSION['alert'] = 'Có lỗi xảy ra';
			return false;
		}
	}
    public function del_blog_comment_reply($id){
		$select_query = "DELETE FROM  tbl_reply_to_comments WHERE id='$id' ";
		$select_result = $this->db->delete($select_query);
		if ($select_result) {
			$_SESSION['alert'] = 'Xóa bình luận thành công';
			return true;
		} else {
			$_SESSION['error'] = 'Có lỗi xảy ra';
			return false;
		}    
    }
    public function show_blog_page_6($begin)
	{
		$query = "SELECT b.*,(SELECT COUNT(*) FROM tbl_blog_comments c WHERE c.blog_id = b.id) +
                     (SELECT COUNT(*) FROM tbl_reply_to_comments rc 
                      JOIN tbl_blog_comments c ON rc.blog_comment_id = c.id
                      WHERE c.blog_id = b.id) AS comment_count
            FROM tbl_blog b
            WHERE b.status='1'
            ORDER BY b.id DESC limit $begin,6";
		$result = $this->db->select($query);
		return $result;

	}
    public function show_blog_page($begin)
	{
		$query = "SELECT b.*,(SELECT COUNT(*) FROM tbl_blog_comments c WHERE c.blog_id = b.id) +
                     (SELECT COUNT(*) FROM tbl_reply_to_comments rc 
                      JOIN tbl_blog_comments c ON rc.blog_comment_id = c.id
                      WHERE c.blog_id = b.id) AS comment_count
            FROM tbl_blog b
            ORDER BY b.id DESC limit $begin,5";
		$result = $this->db->select($query);
		return $result;

	}
    public function show_blog_page_index()
	{
		$query = "SELECT b.*,(SELECT COUNT(*) FROM tbl_blog_comments c WHERE c.blog_id = b.id) +
                     (SELECT COUNT(*) FROM tbl_reply_to_comments rc 
                      JOIN tbl_blog_comments c ON rc.blog_comment_id = c.id
                      WHERE c.blog_id = b.id) AS comment_count
            FROM tbl_blog b
            ORDER BY b.id DESC ";
		$result = $this->db->select($query);
		return $result;

	}
}