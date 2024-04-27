<?php

session_start();
ob_start();
require_once '../configs/functions.php';
require_once '../models/ModelDAO.php';
$modelUser = new ModelUser();
$modelRegister = new ModelRegister();
$modelcredit = new ModelClassCredit();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$userId = $_SESSION['login']['username'];
$user = $modelUser->getByUserName($userId);
$listSchedule = $modelRegister->getByUserId($user->getUserId());
$tmp=null;
if (isset($_POST['credit_id'])) {
    $creditId = $_POST['credit_id'];
    $classCredit = $modelcredit->getById($creditId);
    foreach ($listSchedule as $key => $li){
        if(!is_null($key)){
            if($li->getClassCredit()->getSubject()->getSubjectId() == $classCredit->getSubject()->getSubjectId()) {
                $tmp=$li->getClassCredit();
            }
        }
    }
    
    if(!is_null($tmp)){
        $credittmp=null;
        foreach ($listSchedule as $key => $li){
            if(!is_null($key)){
                if(checkClassCredit($li->getClassCredit(),$classCredit)){
                    $credittmp=$li->getClassCredit();
                }
                
            }
        }
        if(is_null($credittmp)){
            $modelRegister->deleteByUserAndClassCredit($user->getUserId(),$tmp->getClassCreditId());
            $regiter = new Register(1, $classCredit, $user, new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh')));
            $modelRegister->addObject($regiter);
        }
        else{
            echo 'Trùng lịch học môn '.$credittmp->getClassCreditId();
        }
    }
    else{
        $credittmp=null;
        foreach ($listSchedule as $key => $li){
            if(!is_null($key)){
                if(checkClassCredit($li->getClassCredit(),$classCredit)){
                    $credittmp=$li->getClassCredit();
                }
                
            }
        }
        if(is_null($credittmp)){
          
            $regiter = new Register(1, $classCredit, $user, new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh')));
            $modelRegister->addObject($regiter);
        }
        else{
            echo 'Trùng lịch học môn '.$credittmp->getClassCreditId();
        }

    }
   



   

}
$list = $modelRegister->getByUserId($user->getUserId());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã MH</th>
                <th>Tên môn học</th>
                <th>Nhóm</th>
                <th>Số TC</th>
                <th>Lớp</th>
                <th>Ngày đăng ký</th>
               
                <th>Thời khóa biểu</th>
            </tr>
        </thead>
        <tbody>

            <?php
            showRegister($list);
                
            ?>

        </tbody>
    </table>

</body>

</html>