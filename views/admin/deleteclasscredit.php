<?php
require_once 'C:xampp/htdocs/thuc-tap-co-so-thay-Tien/models/ModelDAO.php';
$modelClassCredit = new ModelClassCredit();
$data['id']=-1;
if(isset($_POST['classCreditId'])){
    $id=$_POST['classCreditId'];
    if($modelClassCredit->deleteObject($id))  $data['id']=$id;
    else  $data['id']=-1;   
}
echo json_encode($data) ;