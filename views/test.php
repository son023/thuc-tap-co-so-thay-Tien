<!-- 
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    <input type="checkbox" id="add-to-cart" data-product-id="20">
    <input type="checkbox" id="add" data-product-id="30">
    <input type="checkbox" id="add-" data-product-id="40">
    <input type="checkbox" id="add-t" data-product-id="50">
    <input type="checkbox" id="add-to" data-product-id="60">
    <div id="cart-container"></div>
    
    <script>
//         $(document).ready(function() {
//         $("#add-to-cart").click(function() {
//             var productId = $(this).data("product-id");
//             $.ajax({
//             method: "POST",
//             data: { product_id: productId },
//             success: function(data) {
//                 $("#cart-container").html(data); // Cập nhật nội dung giỏ hàng
//                 alert("Đã thêm sản phẩm vào giỏ hàng!");
//       }
//     });
//   });
// });
    $(document).ready(function() {
        const checkboxes =  document.querySelectorAll('input[type="checkbox"]');
        for (const checkbox of checkboxes) {
            checkbox.addEventListener('click', handleCheckboxClick);
        }
    });
    function handleCheckboxClick(event) {
    // const productId = event.target.value;
    const productId = event.target.getAttribute('data-product-id'); // Lấy ID sản phẩm từ giá trị của checkbox
    const isChecked = event.target.checked; // Kiểm tra xem checkbox có được chọn hay không

    if (isChecked) {
        // Product is being added to the cart
        $.ajax({
            method: "POST",
            data: { product_id: productId },
            url:"http://localhost:3000/views/registerlist.php",
            success: function(data) {
                $("#cart-container").html(data);
            //   alert("Đã thêm sản phẩm vào giỏ hàng!");
            }
        });
        } else {
            $.ajax({
            method: "POST",
            data: { product_id: productId },
            url:"http://localhost:3000/views/removeproduct.php",
            success: function(data) {
                $("#cart-container").html(data);
            //   alert("Đã thêm sản phẩm vào giỏ hàng!");
            }
        });
        }
        
    }
  

 
    </script>

</body>
</html> -->
<?php 
    // require_once '../configs/functions.php';
    // require_once '../models/ModelDAO.php';
    // $modelWeek=new ModelKipStudy();
    // $week=$modelWeek->getById(1);
    // echo toStr($week->getTimeStart());
    // echo toStr(addDate($week->getTimeStart(),$week->getTimeStudy())); -->
    // $modelweek=new ModelSchedule();
    // $week=$modelweek->getById(2);
    // show($week);

session_start();
ob_start();
require_once '../configs/functions.php';
require_once '../models/ModelDAO.php';
$modelUser=new ModelUser();
$modelRegister=new ModelRegister();
$modelcredit=new ModelClassCredit();
$userId=$_SESSION['login']['username'];
$user = $modelUser->getByUserName($userId);

     $classCredit=$modelcredit->getById(5);
     $classCredit1=$modelcredit->getById(21);
     
     if(checkClassCredit($classCredit, $classCredit1)){
        echo 'trung';
     }
     else{
        echo 'ko';
     }
    //  $user=$modelUser->getByUserName($userId);
//     // show($modelRegister->getByUserId($user->getUserId()));
//     if($modelRegister->deleteByUserAndClassCredit($user->getUserId(), 7)){
//         echo  $user->getUserId();
//         echo 'ok';
//     }
// else echo 'loi';
// $user = $modelUser->getByUserName($userId);

// $list1 = $modelRegister->getByUserId($user->getUserId());
// foreach ($list1 as $key1 => $li1) {
//     if (!is_null($key1)) {
//         show($key1);
//     }
// }
    // $regiter=new Register(1,$classCredit,$user,new DateTime());
    // if($modelRegister->addObject($regiter)){
    //     show($regiter);
    // }
    // else{
    //     echo "looi";
    // }

    
