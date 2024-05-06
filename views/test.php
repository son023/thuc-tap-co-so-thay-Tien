<?php
require_once '../models/ModelDAO.php';
$pass='123456';
$hash=password_hash($pass, PASSWORD_DEFAULT);

$modelUser=new ModelUser();
$user=$modelUser->getById(2);
$user->setPassword($hash);
$user->setUserName('B21DCCN6532');
if($modelUser->addObject($user))
 echo 'ok';

?>