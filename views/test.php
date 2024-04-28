<?php
 require_once '../models/ModelDAO.php';
 require_once '../configs/functions.php';
$currentDate = getdate();

// Gán giá trị cho các biến
$month = $currentDate['mon'];
$year = $currentDate['year'];
// echo $month . $year;
$model=new ModelClassCredit();
$modelRegister = new ModelRegister();
$list=$modelRegister->getGvByClassCreditId(19);
$listtg=$modelRegister->getTgByClassCreditId(19);
$creditId = 19;
$listGv=$modelRegister->getGvByClassCreditId($creditId);
$listTg=$modelRegister->getTgByClassCreditId($creditId);
$listSv=$modelRegister->getSvByClassCreditId($creditId);
$classCredit = $model->getById($creditId);
$gvMax=$classCredit->getGvMax();
$tgMax=$classCredit->getTgMax();
$svMax=$classCredit->getSvMax();
if(checkRegister($listGv,$listTg,$listSv,$gvMax,$tgMax,$svMax,2)){
    echo 'ok';

}
else echo 'ko ok';

?>