<?php
require_once '../models/ModelDAO.php';
$pass='123456';
$hash=password_hash($pass, PASSWORD_DEFAULT);

$modelUser=new ModelUser();
$user=$modelUser->getById(2);
$user->setPassword($hash);
echo $user->getPassword();
$user->setUserName('admin');
$user->setUserRole(4);

if($modelUser->updateObject($user))
    echo 'ok';

?>