
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <select name="nghenghiep">
    <option value="0">Bạn làm nghề gì?</option>
    <option value="1">Sinh viên</option>
    <option value="2">Học sinh</option>
    <option value="3">Giáo viên</option>
    <option value="4">Công nhân</option>
  </select>
  <input type="submit" value="Gửi">
</form>
<?php
 require_once '../models/ModelDAO.php';
 require_once '../configs/functions.php';
 $currentDate = getdate();
 show($currentDate);

//  if (is_array($currentDate)) {
//    $month = $currentDate['mon'];
//    $year = $currentDate['year'];
//    $day = $currentDate['day'];
//    echo $day;
//  } 
?>
 </body>
 </html>
