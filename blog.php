<?php
include 'inc/header.php';
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
if($page==''||$page==1){
    $begin=0;
}else{
    $begin=($page*6)-6;
}
?>
<!-- -->


<!-- Blog Section Begin-->
<div class="breacrub-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home">Home</i></a>
                    <span>Blog</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog-section spad">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                <div class="blog-sidebar">
                    <!-- Search Form -->
                    <div class="search-form">
                        <h4>Search</h4>
                        <form action="#">
                            <input type="text" id="live_search" placeholder="Search...">
                        </form>
                    </div>
                    <!-- Category Filter -->
                    <div class="blog-catagory">
                        <h4>Loại tin tức</h4>
                        <?php 
                        $cateblog = $category_blog->show_category_blog();
                        if ($cateblog) {
                            while ($cateresult = $cateblog->fetch_assoc()) {
                                ?>
                                <div class="bc-item">
                                    <label for="bc-calvin<?= $cateresult['id'] ?>">
                                        <input type="checkbox" name="type[]" value="<?= $cateresult['id'] ?>" id="bc-calvin<?= $cateresult['id'] ?>" class="blog_selector type">
                                        <?= $cateresult['title'] ?>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- Recent Posts -->
                    <div class="recent-post">
                        <h4>Bài viết gần đây</h4>
                        <?php 
                        $show_blog = $blog->show_blog();
                        if ($show_blog) {
                            while ($blogresult = $show_blog->fetch_assoc()) {
                                ?>
                                <div class="recent-blog">
                                    <a href="#" class="rb-item">
                                        <div class="rb-pic">
                                            <img src="uploads/<?= $blogresult['image'] ?>" alt="">
                                        </div>
                                        <div class="rb-text">
                                        <h6 onclick="window.location.href='blog-details.php?idblog=<?= $blogresult['id'] ?>'">
                                            <?= substr($blogresult['title'], 0, 17) . "..." ?>
                                        </h6>
                                            <p><?= substr($blogresult['description'], 0, 10) ?><span><?= date('d/m/Y', strtotime($blogresult['created_at'])) ?></span></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- Product Tags -->
                    <div class="blog-tags">
                        <h4>Product Tags</h4>
                        <div class="tag-item">
                            <a href="">Towel</a>
                            <a href="">Shoes</a>
                            <a href="">Coat</a>
                            <a href="">Dresses</a>
                            <a href="">A</a>
                            <a href="">B</a>
                            <a href="">C</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-lg-9 col-md-6 col-sm-8 order-1 order-lg-2">
                <div class="row filter_blog">
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <?php 
            $sql_trang = $blog->show_blog();
                $row_count = $sql_trang->num_rows;
                $page = ceil($row_count / 6);
            ?>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $page; $i++) { ?>
                <li class="page-item"><a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</section>
<!-- Blog Section End -->


<!-- Blog Section End-->

<?php
include 'inc/footer.php';
?>