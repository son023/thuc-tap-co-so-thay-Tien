<?php
$modelUser = new ModelUser();
$user = $modelUser->getByUserName($_SESSION['login']['username']);

?>
<div class="user-container">
  <div class="inner-box">
    <div class="inner-title kanit-medium">
      <i class="fa-solid fa-user"></i> TÀI KHOẢN
    </div>
    <div class="row" style="margin:0;">
      <div class="col-6">
        <div class="inner-head">Tài khoản</div>
      </div>
      <div class="col-6">
        <div class="inner-head" > <?php echo $_SESSION['login']['username'] ?></div>
      </div>
      <div class="col-6">
        <div class="inner-head">Họ và tên</div>
      </div>
      <div class="col-6">
        <div class="inner-head"><?php echo $user->getFullName() ?></div>
      </div>
    </div>
    <a href="logout">
    <button name="dangxuat" type="submit" class="form-control btn btn-primary kanit-medium">Đăng Xuất</button></a>
  </div>


</div>
<nav class="navbar bg-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="news">Thông báo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="registercredit">Đăng ký tín chỉ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="schedules">Thời khoá biểu</a>
    </li>
  </ul>
</nav>