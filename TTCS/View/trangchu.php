<?php if (session_id() == '' || !isset($_SESSION)) {
  session_start();
} ?>
<!DOCTYPE html>
<html>
<head>
<!--     <link rel="stylesheet" href="css/qlbh.css" /> -->
    <title>Đăng ký học</title>
</head>
<body>
  <div>
    <style type="text/css">
      * {
  margin: 0;
  padding: 0;
}
.button {
  -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
  -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
  box-shadow:inset 0px 1px 0px 0px #ffffff;
  background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
  background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
  background-color:#ededed;
  -webkit-border-top-left-radius:6px;
  -moz-border-radius-topleft:6px;
  border-top-left-radius:6px;
  -webkit-border-top-right-radius:6px;
  -moz-border-radius-topright:6px;
  border-top-right-radius:6px;
  -webkit-border-bottom-right-radius:6px;
  -moz-border-radius-bottomright:6px;
  border-bottom-right-radius:6px;
  -webkit-border-bottom-left-radius:6px;
  -moz-border-radius-bottomleft:6px;
  border-bottom-left-radius:6px;
  text-indent:0;
  border:1px solid #dcdcdc;
  display:inline-block;
  color:#777777;
  font-family:Times New Roman;
  font-size:15px;
  font-weight:normal;
  font-style:normal;
  height:25px;
  line-height:25px;
  width:100px;
  text-decoration:none;
  text-align:center;
  text-shadow:1px 1px 0px #ffffff;
}
.button:hover {
  background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
  background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
  background-color:#dfdfdf;
}.button:active {
  position:relative;
  top:1px;
}
/* This button was generated using http://tools.ngoisaoso.vn/css3button/ */


#menu {
        font-size: 15px;
    color: white;
    padding: 5px 5px 0 5px;
    background-color: #FF6600;
    height: 30px;
    top: 89px;
    right: 0px;
   text-align: right;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
#menu a{
  color: white;
  padding: 5px;
  text-decoration: none;
  text-align: center;
  
  right: 5px;

}
.h1{
  font-family: arial;
  width: 300px;
  height: 50px;
  padding-left: 10px;
  font-size: 20px;
  font-weight: bold;
  text-align: justify;
}
.h2{
    font-family: arial;
  width: 700px;
  height: 150px;
  padding-left: 10px;
  font-size: 18px;
  text-align: justify;
  padding-top: 5px;
}
#news-block-title {
    font-size: 18px;
        border-bottom: 1px solid #cd2122;
        position: relative;
        left: 300px;
        font-size: 30px;
        top: 50px;

}
p{
  padding-top: 10px;
  font-size: 16px;
  font-weight: normal;
}
.a3{
  font-size: 20px;
  text-decoration: none;
  font-style: bold;
  color: black;
  font-size: 20px;
}
.a3:hover{
  color: #CD2122;
}
.tr{
      margin: 0 0 30px;
    overflow: hidden;
    list-style-type: none;
}
    </style>
    <div align="center">
        <a href="">
            <img src="img/logo.png">
        </a>
    </div>
<div id="menu">
    
    <a href="trangchu.php">Trang Chủ</a>
    |
    <a href="view/dangky.php">Đăng ký học phần</a>
    |
     <a href="view/dsdangky.php">Thời khóa biểu</a>
    |
    <a href="view/profile.php"> 
      <?php 
      include('publish/connect.php');
     
    //Lấy dữ liệu nhập vào
    $username = $_SESSION['username'] ;

    $sql="SELECT * FROM sinhvien WHERE username='$username'";
    $kq=mysqli_query($conn,$sql);
    if (mysqli_num_rows($kq) > 0) {
      {while ($row= mysqli_fetch_assoc($kq)) {
            # code...
            echo $row['hoten'];

            
          }
          }
    }


       ?></a>
       -
    <a href="login.php">Đăng Xuất</a>
    

</div>
</div>
<div >
<span style="z-index: -1; " id="news-block-title">TIN TỨC SỰ KIỆN</span>

<div align="center" style="padding-top: 20px">
  <table style="position: relative; top: 80px;" width="1000px">
    <tr class="tr">
      <td class="" rowspan="2"><img height="250px" src="img/h1.jpg" alt=""></td>
      <td class="h1"><a class="a3" href="http://www.utt.edu.vn/utt/tin-tuc-su-kien/tap-huan-nghiep-vu-va-cac-quy-dinh-phap-luat-cho-nguoi-dieu-hanh-van-tai-a11980.html">
      Tập huấn Nghiệp vụ và các quy định pháp luật cho người điều hành vận tải</a>
        
                      <p>16/11/2019</p>
</td >
      <tr><td class="h2" >Ngày 16/11/2019 tại Phân hiệu Hà Nội, Trung tâm Hỗ trợ sinh viên khởi nghiệp và Quan hệ doanh nghiệp phối hợp với Hiệp hội Vận tải ô tô Việt Nam (VATA) tổ chức khai mạc Khóa Tập huấn nghiệp vụ và các quy định pháp luật cho người...</td></tr>
    </tr>

    <tr>
      <td class="" rowspan="2"><img height="250px" src="img/h2.jpg" alt=""></td>
      <td class="h1"><a class="a3" href="http://www.utt.edu.vn/utt/tin-tuc-su-kien/doan-bo-giao-duc-va-the-thao-lao-tham-va-lam-viec-tai-truong-dai-hoc-cong-nghe-gtvt-a11975.html">
      Đoàn Bộ Giáo dục và Thể thao Lào thăm và làm việc tại Trường Đại học Công nghệ GTVT
Đoàn Bộ Giáo dục và Thể thao Lào thăm và làm việc tại Trường Đại học Công nghệ GTVT</a>
        
                      <p>15/11/2019</p>
</td >
      <tr><td class="h2" >Ngày 13/11/2019, Đoàn công tác của Bộ Giáo dục và Thể thao Nước CHDCND Lào do Bà Thongmy Duansakda - Phó Vụ trưởng Vụ Công tác sinh viên - Bộ Giáo dục và Thể thao làm Trưởng đoàn đã có buổi làm việc với Trường Đại học Công nghệ Giao...</td></tr>
    </tr>
<tr>
      <td class="" rowspan="2"><img height="250px" src="img/h3.jpg" alt=""></td>
      <td class="h1"><a class="a3" href="http://utt.edu.vn/utt/tin-tuc-su-kien/toa-dam-trao-doi-hoc-tap-kinh-nghiem-cong-tac-trong-boi-canh-toan-cau-hoa-giao-duc-dai-hoc-a11967.html">
      Tọa đàm Trao đổi, học tập kinh nghiệm công tác trong bối cảnh toàn cầu hóa giáo dục đại học
Tọa đàm Trao đổi, học tập kinh nghiệm công tác trong bối cảnh toàn cầu hóa giáo dục đại học</a>
        
                      <p>14/11/2019</p>
</td >
      <tr><td class="h2" >Với xu hướng hội nhập và toàn cầu hóa, các quốc gia trong đó có Việt Nam đang có những bước đi thiết thực nhất để đổi mới và nâng cao chất lượng ngành nghề nhằm đáp ứng các yêu cầu thực tiễn và hội nhập quốc tế. Một trong...</td></tr>
    </tr>

<tr>
      <td class="" rowspan="2"><img height="250px" src="img/h4.jpg" alt=""></td>
      <td class="h1"><a class="a3" href="http://utt.edu.vn/utt/tin-tuc-su-kien/khai-giang-cao-hoc-khoa-51-va-trao-bang-thac-si-dot-2-2019-a11934.html">
      Khai giảng Cao học Khóa 5.1 và trao bằng Thạc sĩ đợt 2 - 2019
Khai giảng Cao học Khóa 5.1 và trao bằng Thạc sĩ đợt 2 - 2019</a>
        
                      <p>4/11/2019</p>
</td >
      <tr><td class="h2" >Hòa trong không khí HS-SV cả nước đang nô nức phấn khởi bước vào năm học mới, chào mừng các ngày lễ lớn của đất nước, của dân tộc, hướng tới kỷ niệm ngày Nhà giáo Việt Nam 20/11. Ngày 03/11/2019, Trường Đại học Công nghệ GTVT...</td></tr>
    </tr>
  </table>
</div>
</div>
</body>
</html>