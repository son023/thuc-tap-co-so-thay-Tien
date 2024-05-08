<?php
require_once _DIR_ROOT . '\views\header.php';

$modelClassCredit=new ModelClassCredit();
$modelUser = new ModelUser();
$modelRegister = new ModelRegister();
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_POST['addregister']) ) {
    $userId =  test_input($_POST['username']);
    $user = $modelUser->getByUserName($userId);
    $creditId = test_input($_POST['classcredit']);
    $listGv=$modelRegister->getGvByClassCreditId($creditId);
    $listTg=$modelRegister->getTgByClassCreditId($creditId);
    $listSv=$modelRegister->getSvByClassCreditId($creditId);
    $classCredit = $modelClassCredit->getById($creditId);
    $gvMax=$classCredit->getGvMax();
    $tgMax=$classCredit->getTgMax();
    $svMax=$classCredit->getSvMax();
    $role=$user->getUserRole();
    if(checkRegister($listGv,$listTg,$listSv,$gvMax,$tgMax,$svMax,$role)){
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
                $modelRegister->deleteByUserAndClassCredit($user->getUserId(),$tmp->getClassCreditId());
                $_SESSION['error'] = 'Thêm đăng ký thành công';
                header('Location: registermanagement');
            }
            else{
                $_SESSION['error'] = getSchedule($credittmp,'Trùng lịch học với môn');
                header('Location: registermanagement');
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
                $_SESSION['error'] = 'Thêm đăng ký thành công';
                $regiter = new Register(1, $classCredit, $user, new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh')));
                $modelRegister->addObject($regiter);
                header('Location: registermanagement');
            }
            else{
              
                $_SESSION['error'] = getSchedule($credittmp,'Trùng lịch học với môn');
                header('Location: registermanagement');
            }
    
        }
    }
    else{
        $_SESSION['error'] = 'Lớp đã đủ số lượng.';
        header('Location: registermanagement');
        
    }
  


}



 
   
?>

<div class="section-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2">
                <?php
                require "narbaradmin.php";
                ?>
            </div>

            <div class="col-xl-10">
                <?php echo ' <h3   style="left:490px  "class="animate__animated animate__fadeInDown"> Thêm đăng ký</h3>' ?>
                <div class="row" style="font-family: 'Inria Serif', sans-serif;">
                   
                    <div class="col-xs-12">
                        <form method="post" action="/admin/addregister" role="form" class="form-horizontal" id="form-edit">
                            <div class="form-group">
                                <label class="col-xs-2">Mã Sinh viên / Giáo viên / Trợ giảng</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                         
                            <div class="form-group">
                                <label class="col-xs-2"></label>
                                <div class="col-xs-9">
                                    <select class="form-control" name="classcredit" id="districtId">

                                        <option>---Chọn lớp tín chỉ---</option>
                                        <?php
                                      
                                        $list = $modelClassCredit->getAll();

                                        foreach ($list as $key => $li) {
                                            if (!is_null($li)) {
                                                $subject=$li->getSubject()->getSubjectName();
                                                $groupclass=$li->getGroupClass();
                                                $class=$subject.' nhóm '.$groupclass;
                                                $id=$li->getClassCreditId();
                                                echo '<option value="' . $id . '">' . $class. '</option>';
                                            }
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>
                           
                            

                            <div class="form-group">
                                <div class="col-xs-2"></div>
                                <div class="col-xs-9">
                                    <button class='btn btn-primary' style="margin-right: 10px;" name='addregister'>
                                        <i class="ace-icon glyphicon glyphicon-plus"></i>
                                        <span> Thêm đăng ký</span>
                                    </button>
                                    <button>
                                        <i class="fa-solid fa-trash-can" name='huy'></i>
                                        <span> Hủy thao tác</span>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
require_once _DIR_ROOT . '\views\footer.php';
?>