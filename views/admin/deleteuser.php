<?php
require_once 'C:xampp/htdocs/thuc-tap-co-so-thay-Tien/models/ModelDAO.php';
$modelUser = new ModelUser();
$data['id']=-1;
if(isset($_POST['userId'])){
    $id=$_POST['userId'];
    if($modelUser->deleteObject($id))  $data['id']=$id;
    else  $data['id']=-1;   
}
echo json_encode($data) ;