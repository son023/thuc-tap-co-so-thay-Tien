<?php
require "header.php";
?>

<div class="section-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3">
                <?php
                require "narbar.php";
                ?>
            </div>
            <div class="col-xl-9">
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <select name="schedule">
                <?php
                    $modelWeek=new ModelWeek();
                    for($i=8;$i<=31;$i++){
                        $week=$modelWeek->getById($i); 
                        echo '<option value="'.$i.'">Tuần '.$week->getWeekName().' bắt đầu từ '.toStrYear($week->getStartTime()).' đến '.toStrYear($week->getEndTime()).'</option>';
                    }
                ?>
                </select>
                <input type="submit" class="btn-get-started" value="Gửi">
            </form>
            <?php 
                $week_id=0;
                if(isset( $_POST['schedule'])){
                    $schedule = $_POST['schedule'];
                    // echo $schedule;
                    for($ok=8;$ok<=31;$ok++){
                        if($ok==$schedule){
                        $week_id=$schedule;
                        break; 
                        }
                    }
                }
                $modelUser = new ModelUser();
                $modelRegister = new ModelRegister();
                $user = $modelUser->getByUserName($_SESSION['login']['username']);
                $listRegister = $modelRegister->getByUserId($user->getUserId());
                $modelKipStudy=new ModelKipStudy();
                $modelWeek=new ModelWeek();
                if($week_id==0) {
                    $now = new DateTime();
                    $dateStr= $now->format('Y-m-d');
                    $dateObject = DateTime::createFromFormat('Y-m-d', $dateStr);
                    for($ok=8;$ok<=32;$ok++){
                        $week=$modelWeek->getById($ok);
                        $time=$week->getStartTime();
                        if(getDaysDiffBetweenDates($dateObject,$time)<7){
                            $week_id=$ok;
                            break;
                        }                     
                    }
                    
                }
                $week=$modelWeek->getById($week_id); 
                echo 'Tuần '.$week->getWeekName().' bắt đầu từ '.toStrYear($week->getStartTime()).' đến '.toStrYear($week->getEndTime());
                echo '<h1> Lịch học</h1>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Thứ 2</th>
                            <th>Thứ 3</th>
                            <th>Thứ 4</th>
                            <th>Thứ 5</th>
                            <th>Thứ 6</th>
                            <th>Thứ 7</th>
                            <th>Chủ nhật</th>
                            <th>Thời gian</th>

                            
                        </tr>
                    </thead>
                    <tbody>';
                        for($tmp=1;$tmp<=6;$tmp++){
                            echo '<tr>
                            <td>Kíp '.$tmp .'</td>';
                            for($i=2;$i<=8;$i++){
                                $ok=1;
                                foreach($listRegister as $key => $value){
                                    if(!is_null($value)){
                                        $classCredit=$value->getClassCredit();
                                        $listSchedule=$classCredit->getListSchedule();
                                        foreach($listSchedule as $key1 => $value1){
                                            if(!is_null($value1)){
                                                $week=$value1->getWeek()->getWeekId();
                                                $week_end=$value1->getWeekEnd()->getWeekId();
                                                if($week_id>=$week && $week_end>=$week_id){
                                                    if($value1->getDayStudy()==$i && $value1->getKipStudy()->getKipStudyId()==$tmp){
                                                        echo '<td><strong>'
                                                        .$classCredit->getSubject()->getSubjectName().' ('.
                                                        $classCredit->getSubject()->getSubjectCode().')</strong> <br/> <b>Nhóm : </b>'.
                                                        $classCredit->getGroupClass().'<br><strong>Phòng học : </strong>'.
                                                        $value1->getClassRoom()->getClassRoomName().' '.$value1->getClassRoom()->getBuilding();
                                                        $listGv=$modelRegister->getGvByClassCreditId($classCredit->getClassCreditId());
                                                        $listTg=$modelRegister->getTgByClassCreditId($classCredit->getClassCreditId());
                                                        echo '<br><strong>' ;
                                                        if(sizeof($listGv)!=0){
                            
                                                            echo 'Giảng viên: ';
                                                            echo '</strong>';
                                                            foreach($listGv as $ok=>$gv){
                                                                if(!is_null($gv)){
                                                                    echo $gv->getFullName().'<br>';
                                                                }
                                
                                                            }
                                                           
                                                        }
                                                        if(sizeof($listTg)!=0){
                                                            echo '<strong>' ;
                                                            echo 'Trợ giảng: ';
                                                            echo '</strong>';
                                                            foreach($listTg as $ok=>$gv){
                                                                if(!is_null($gv)){
                                                                    echo $gv->getFullName().'<br>';
                                                                }
                                
                                                            }
                                                        } 
                                                        
                                                        echo   '</td>';
                                                        $ok=2;
                                                    }
                                                }
                                            }
            
                                        }
                                    }
                                }
                                if($ok==1){
                                    echo '<td> </td>';
                                }
                            }
                            
                            $kipStudy=$modelKipStudy->getById($tmp);
                            $timeStart = $kipStudy->getTimeStart();
                            echo '<td>'. toStr($timeStart) . ' đến ' . toStr(addDate($timeStart, $kipStudy->getTimeStudy())) .'</td>';
                            
                            echo '</tr>';
                    }
                    
                    echo '
                    </tbody>
                </table>';         
            ?>                       
                    </div>
               
            </div>

        </div>
</div>
</div>
    


<?php
require "footer.php";
?>