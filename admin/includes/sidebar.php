<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>
<aside
  class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0 " href=" index.php " target="_blank">
      <span class="ms-1 font-weight-bold text-white">Hoa_Shop</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link text-white <?= $page == "index.php" ? 'active bg-gradient-primary' : '' ?>"
          href="index.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">Trang chủ</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "category.php" ? 'active bg-gradient-primary' : '' ?>"
          href="category.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">Danh sách loại sản phẩm</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white  <?= $page == "product.php" ? 'active bg-gradient-primary' : '' ?>"
          href="product.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">Danh sách sản phẩm</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white  <?= $page == "order.php" ? 'active bg-gradient-primary' : '' ?>"
          href="order.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">Danh sách đơn đặt hàng</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "slider.php" ? 'active bg-gradient-primary' : ''; ?>"
          href="slider.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Slider</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "category-blog.php" ? 'active bg-gradient-primary' : ''; ?>" href="category-blog.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Danh sách loại tin tức</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "blog.php" ? 'active bg-gradient-primary' : ''; ?>" href="blog.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Danh sách tin tức</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "user.php" ? 'active bg-gradient-primary' : ''; ?>"
          href="user.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Danh sách người dùng</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "comment.php" ? 'active bg-gradient-primary' : ''; ?>"
          href="comment.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Danh sách bình luận</span>
        </a>
      </li>
      <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Trang tài khoản</h6>
        </li>
      <li class="nav-item">
          <a class="nav-link text-white " href="../pages/profile.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="?action=logout">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Đăng xuất</span>
          </a>
        </li>
    </ul>
  </div>
</aside>