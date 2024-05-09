<?php
$modelUser = new ModelUser();
$user = $modelUser->getByUserName($_SESSION['login']['username']);

?>
<div class="user-container mr-0">
  <div class="inner-box">
    <div class="inner-title kanit-medium">
      <i class="fa-solid fa-user"></i> TÀI KHOẢN
    </div>
    <div class="row" style="margin:0;">
      <div class="col-6 pr-0">
        <div class="inner-head ">Tài khoản</div>
      </div>
      <div class="col-6 pl-0">
        <div class="inner-head "> <?php echo $_SESSION['login']['username'] ?></div>
      </div>
      <div class="col-6 pr-0">
        <div class="inner-head ">Họ và tên</div>
      </div>
      <div class="col-6 pl-0">
        <div class="inner-head "><?php echo $user->getFullName() ?></div>
      </div>
    </div>
    <a href="/thuc-tap-co-so-thay-Tien/logout">
      <button name="dangxuat" type="submit" class="form-control btn btn-primary kanit-medium">Đăng Xuất</button></a>
  </div>


</div>
<div class="setting-container ">
  <div class="inner-box">
    <div class="inner-title kanit-medium">
    <i class="fa-solid fa-gears"></i> TÍNH NĂNG
    </div>
    <nav class="navbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/thuc-tap-co-so-thay-Tien/home">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/thuc-tap-co-so-thay-Tien/profile">Thông tin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/thuc-tap-co-so-thay-Tien/registercredit">Đăng ký tín chỉ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/thuc-tap-co-so-thay-Tien/schedules">Thời khoá biểu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/thuc-tap-co-so-thay-Tien/classcre">Lớp tín chỉ</a>
        </li>
   
      </ul>
    </nav>
  </div>
</div>