<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/category_blog.php');

$category_blog=new category_blog();

$db = new Database();
$fm = new Format();

$query = "SELECT b.*,
                 (SELECT COUNT(*) FROM tbl_blog_comments c WHERE c.blog_id = b.id) +
                 (SELECT COUNT(*) FROM tbl_reply_to_comments rc 
                  JOIN tbl_blog_comments c ON rc.blog_comment_id = c.id
                  WHERE c.blog_id = b.id) AS comment_count
          FROM tbl_blog b
          WHERE b.status='1'";

if (isset($_POST['input']) && !empty($_POST['input'])) {
    $input = $_POST['input'];
    $query .= " AND b.title LIKE '%$input%'";
}

if (isset($_POST['types'])) {
    $list_brand = implode("','", $_POST['types']);
    $query .= " AND b.category_post_id IN ('$list_brand')";
}

if (isset($_POST["begin"]) && !empty($_POST["begin"])) {
    $begin = $_POST['begin'];
$query .= " ORDER BY id DESC LIMIT $begin,6";
}

$result = $db->select($query);

if (!empty($result)) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-lg-6 col-sm-6" id="search_result">
            <div class="blog-item">
                <div class="bi-pic">
                    <img class="blog-img" style="width: 400px; height: 220px;" src="uploads/<?= $row['image'] ?>" alt="">
                </div>
                <div class="bi-text">
                    <a href="blog-details.php?idblog=<?= $row['id'] ?>">
                        <h4><?= substr($row['title'], 0, 26) . "..." ?></h4>
                    </a>
                    <p>
                        <?php
                        $cateblog = $category_blog->show_category_blog();
                        if ($cateblog) {
                            while ($cateresult = $cateblog->fetch_assoc()) {
                                if ($row['category_post_id'] == $cateresult['id']) {
                                    echo $cateresult['title'];
                                }
                            }
                        }
                        ?>
                        <i class="fa fa-comment-o"></i><?= $row['comment_count'] ?>
                        <span><?= date('d/m/Y', strtotime($row['created_at'])) ?></span>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "Không có bài viết nào.";
}
?>
