<?php session_start();
ob_start();
ini_set('default_charset', 'UTF-8');
require_once '../configs/functions.php';
require_once '../models/ModelDAO.php';
$modelUser=new ModelUser();
$modelRegister=new ModelRegister();
$modelcredit=new ModelClassCredit();
$userId=$_SESSION['login']['username'];
$user = $modelUser->getByUserName($userId);

     $classCredit=$modelcredit->getById(5);
     $classCredit1=$modelcredit->getById(21);
     
     $list=[];
     $list['error']=getSchedule($classCredit,'trung');
     $list[1]['oke']='2';

     echo json_encode($list,JSON_UNESCAPED_UNICODE) ;
    ?>

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
    

  

 

</body>
</html> 
    