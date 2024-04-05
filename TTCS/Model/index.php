<?php
require("ModelDepartment.php");
$modelDepartment=new ModelDepartment();

$okk = new Department(6,'update','update ĐẠI ỌC BACK KHOA');
$modelDepartment->updateObject($okk);

?>