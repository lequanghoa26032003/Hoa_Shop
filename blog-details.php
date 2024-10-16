<?php
include 'inc/header.php';
?>
<?php
$userid = Session::get('id');
$idblog=null;
if (!isset($_GET['idblog']) || $_GET['idblog'] == null) {
    echo "<script>window.location='blog.php';</script>";
} else {
    $idblog = $_GET['idblog'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['blogcmt'])) {
    $blog_id = $_POST['blog_id'];
    $cmt = $_POST['cmt'];
    $insertcmt = $blog->insert_blog_comment($userid, $blog_id, $cmt);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editblogcmt'])) {
 
        $blog_comment_id = $_POST['edit_comment_id'];
        $cmt = $_POST['editcmt'];
        $insertcmt = $blog->update_blog_comment($blog_comment_id, $cmt);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['replyblogcmt'])) {

        $blog_comment_id = $_POST['blog_comment_id'];
        $cmt = $_POST['replycmt'];
        $insertcmt = $blog->insert_reply_blog_comment($blog_comment_id,$userid, $cmt);

}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_reply_blogcmt'])) {
 
    $blog_reply_comment_id = $_POST['edit_reply_comment_id'];
    $cmt = $_POST['edit_reply_cmt'];
    $insertcmt = $blog->update_reply_blog_comment($blog_reply_comment_id, $cmt);
}
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $delblog = $blog->del_blog_comment($id);
}
if (isset($_GET['delidreply'])) {
    $id = $_GET['delidreply'];
    $delblogreply = $blog->del_blog_comment_reply($id);
    
}
?>
<!-- -->

<!-- Blog Fetails Section Begin -->
<div class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $getblogid=$blog->getblogbyId($idblog);
                    $result=$getblogid->fetch_assoc();
                ?>
                <div class="blog-details-inner">
                    <div class="blog-detail-title">
                        <h2><?=$result['title']?></h2>
                        <p >
                            <?php 
                            $cateblog=$category_blog->show_category_blog();
                            if($cateblog){
                                while($cateresult=$cateblog->fetch_assoc()){
                            ?>    
                            <?=$result['category_post_id']==$cateresult['id'] ? $cateresult['title'] : '' ?>
                            <?php }} ?>
                            <span><?=date('d/m/Y',strtotime($result['created_at']))?></span>
                        </p>
                    </div>
                    <div class="blog-larger-pic">
                        <img  style="width:410px; height:280px;"  src="uploads/<?=$result['image']?>" alt="">
                    </div>
                    <div class="blog-detail-desc">
                        <p><?=$result['description']?></p>
                    </div>
                    <div class="blog-qoute">
                        <p><?=$result['content']?>.</p>
                    </div>
                    <?php 
                        $list = $blog->show_blog_comment($idblog);
                        $i=0;

                        if($list){
                            while($result_cmt_blog = $list->fetch_assoc()){
                        ?>
                        <div class="posted-by">
                            <div class="pb-pic">
                                <img style="height: 70px;width: 70px;border-radius: 50%;" src="uploads/<?=$result_cmt_blog['image']?>" alt="">
                            </div>
                            <div class="pb-text">
                                <a href="#">
                                    <h5><?=$result_cmt_blog['name']?></h5>
                                </a>
                                <p>
                                    <?=$result_cmt_blog['cmt']?>
                                    
                                </p>
                                <?php if(!empty($userid)){ ?>
                                
                                <span style="padding-right:10px;" class="reply-feedback" onclick="toggleReplyForm(<?=$result_cmt_blog['bid']?>)" data-user="<?=$userid?>" >Phản hồi</span>
                                <form action="" method="POST" class="comment-form" id="reply-form-<?=$result_cmt_blog['bid']?>" style="display: none;">
                                    <div class="leave-comment row">
                                        <input type="hidden" name="blog_id" value="<?=$idblog?>" >
                                        <div class="col-lg-6">
                                            <input type="hidden" name="blog_comment_id" value="<?=$result_cmt_blog['bid']?>" >
                                            <textarea style="width: 400px; magrin-top:-20px;" name="replycmt"  placeholder="Messages"></textarea>
                                            <button type="submit" name="replyblogcmt" class="site-btn">Gửi</button>
                                        </div>
                                    </div>
                                </form>
                                <?php  }else{ ?>
                                <span style="padding-right:10px;" class="reply-feedback reply-cmt" >Phản hồi</span>

                                <?php  } ?>
                                <?php if($result_cmt_blog['user_id']=== $userid){ ?>

                                <input type="hidden" value="<?=$result_cmt_blog['user_id']?>" >
                                <span class="edit-comment-text" onclick="tonggleEdit(<?=$result_cmt_blog['bid']?>)" style="padding-right:10px;">Chỉnh sửa</span>
                                <form action="" method="POST" class="comment-form" id="edit-form-<?=$result_cmt_blog['bid']?>" style="display: none;">
                                    <div class="leave-comment row">
                                        <div class="col-lg-6">
                                            <input type="hidden" name="edit_comment_id" value="<?=$result_cmt_blog['bid']?>" >
                                            <textarea style="width: 400px; magrin-top:-20px;" name="editcmt"  placeholder="Messages"><?=$result_cmt_blog['cmt']?></textarea>
                                            <button type="submit" name="editblogcmt" class="site-btn">Gửi</button>
                                        </div>
                                    </div>
                                </form>
                                <?php  } ?>

                                <?php if($result_cmt_blog['user_id']=== $userid){ ?>
                                <a  onclick="return confirm('Bạn thực sự muốn xóa?')" href="blog-details.php?idblog=<?=$idblog?>&delid=<?=$result_cmt_blog['bid']?>" class="edit-comment-text">Xóa</a>
                                <?php  } ?>
                                <?php 
                                $list1 = $blog->show_reply_blog_comment($result_cmt_blog['bid']);
                                if($list1){
                                    while($result_reply_cmt_blog = $list1->fetch_assoc()){
                                ?>
                                <div class="posted-by-reply">
                                    <div class="pb-pic">
                                        <img style="height: 70px;width: 70px;border-radius: 50%;" src="uploads/<?=$result_reply_cmt_blog['uimage']?>" alt="">
                                    </div>
                                    <div class="pb-text">
                                        <a href="#">
                                            <h5><?=$result_reply_cmt_blog['uname']?></h5>
                                        </a>
                                        <p>
                                            <?=$result_reply_cmt_blog['rcmt']?>
                                            
                                        </p>

                                        <?php if($result_reply_cmt_blog['uid']=== $userid){ ?>

                                        <a onclick="return confirm('Bạn thực sự muốn xóa?')" href="blog-details.php?idblog=<?=$idblog?>&delidreply=<?=$result_reply_cmt_blog['rid']?>" class="edit-comment-text">Xóa</a>

                                        <span class="edit-comment-text" onclick="tonggleEdit(<?=$result_reply_cmt_blog['rid']?>)" style="padding-right:10px;">Chỉnh sửa</span>
                                        <form action="" method="POST" class="comment-form" id="edit-form-<?=$result_reply_cmt_blog['rid']?>" style="display: none;">
                                            <div class="leave-comment row">
                                                <div class="col-lg-6">
                                                    <input type="hidden" name="edit_reply_comment_id" value="<?=$result_reply_cmt_blog['rid']?>" >
                                                    <textarea style="width: 400px; magrin-top:-20px;" name="edit_reply_cmt"  placeholder="Messages"><?=$result_reply_cmt_blog['rcmt']?></textarea>
                                                    <button type="submit" name="edit_reply_blogcmt" class="site-btn">Gửi</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php  } ?>

                                    </div>
                                </div>

                                <?php 
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <?php 
                            }
                        }
                        ?>

                    <div class="leave-comment">
                        <h4>Hãy để lại 1 bình luận</h4>
                        <?php ?>

                        <?php ?>
                        <form action="" method="POST" class="comment-form">
                            <div class="row">
                                    <input type="hidden" name="blog_id" value="<?=$idblog?>" >
                                <div class="col-lg-6">
                                    <textarea name="cmt"  placeholder="Nhập..."></textarea>
                                    <button type="submit" name="blogcmt" class="site-btn">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Blog Fetails Section End -->
<?php
include 'inc/footer.php';
?>