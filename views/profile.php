<?php
require "header.php";
$roleString='';
if($data[1]==1) $roleString='sinh viên';
else if($data[1]==2) $roleString='trợ giảng';
else   $roleString='giảng viên';

?>

<div class="section-one">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-3">
        <?php
        require "narbar.php";
        ?>
      </div>

      <div class="col-xl-7">
        <div class="inner-profile">
          
          <?php echo '<h3>Thông tin '.$roleString. '</h3>' ?>
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
              <?php echo '<p>Mã '.$roleString.' </p>'; ?>
              <p>Họ và tên</p>
              <p>Ngày sinh</p>
              <p>Giới tính</p>
              <p>Email</p>
              <p>Nơi sinh</p>
              <p>Địa chỉ</p>
              <p>Hiện diện</p>
              <p>Link sosial</p>

            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
               <?php
               $gender=$data[0]->getGender()==1?'Nam':'Nữ';
               $status=$data[0]->getStatus()==1?'Đang học':'False';
               echo '<p>'.$data[0]->getUserName().'</p>';
               echo '<p>'.$data[0]->getFullName().'</p>';
               echo '<p>'.$data[0]->getDateOfBirth().'</p>';
               echo '<p>'.$gender.'</p>';
               echo '<p>'.$data[0]->getUserName().'</p>';
               echo '<p>'.$data[0]->getBirthplace().'</p>';
               echo '<p>'.$data[0]->getCurrentAddress().'</p>';
               echo '<p>'.$status.'</p>';
               echo '<p>'.$data[0]->getLinkSocial().'</p>';
              ?>
            </div>
          </div>
        </div>
      </div>
        <div class="col-xl-2">
          <?php echo '<img src="' . $data[0]->getAvatarImagePath() . '" width=200 height=200>' ?>
        </div>
      
    </div>
  </div>
</div>



<?php
require "footer.php";
?>