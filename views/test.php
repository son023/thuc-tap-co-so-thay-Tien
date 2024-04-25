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
    require_once '../configs/functions.php';
    require_once '../models/ModelDAO.php';
    $modelWeek=new ModelSubject();
    $week=$modelWeek->getById(38);
    show($week);