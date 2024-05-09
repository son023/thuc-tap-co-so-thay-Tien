<?php
require "header.php";
?>
<style>
    form {
        display: flex;
        margin: 1rem 0;
    }

    option {
        margin-right: 0.5rem;
    }

    select {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px 40px;
        font-size: 1rem;
        background-color: #fff;
    }

    select:focus {
        outline: 2px solid #3ec1d5;
    }

    th {
        background-color: #3ec1d5;
        color: #fff
    }
</style>
<div class="section-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2">
                <?php
                require "narbar.php";
                ?>
            </div>
            <div class="col-xl-10 justify-content-center">

                <form action="<?php echo htmlspecialchars("/thuc-tap-co-so-thay-Tien/schedules"); ?>" method="post">
                    <select name="schedule" class="animate__animated animate__fadeInLeft">
                        <?php
                        $modelWeek = new ModelWeek();
                        for ($i = 8; $i <= 31; $i++) {
                            $week = $modelWeek->getById($i);
                            echo '<option value="' . $i . '">Tuần ' . $week->getWeekName() . ' bắt đầu từ ' . toStrYear($week->getStartTime()) . ' đến ' . toStrYear($week->getEndTime()) . '</option>';
                        }
                        ?>
                    </select>
                    <input type="submit" class="btn-get-started animate__animated animate__fadeInRight" style="border:0;"
                        value="Xem lịch">
                </form>
                <div class="schedule-body animate__animated animate__fadeInUp ">
                    <?php
                    $week_id = 0;
                    if (isset($_POST['schedule'])) {
                        $schedule = $_POST['schedule'];
                        // echo $schedule;
                        for ($ok = 8; $ok <= 31; $ok++) {
                            if ($ok == $schedule) {
                                $week_id = $schedule;
                                break;
                            }
                        }
                    }
                    $modelUser = new ModelUser();
                    $modelRegister = new ModelRegister();
                    $user = $modelUser->getByUserName($_SESSION['login']['username']);
                    $listRegister = $modelRegister->getByUserId($user->getUserId());
                    $modelKipStudy = new ModelKipStudy();
                    $modelWeek = new ModelWeek();
                    if ($week_id == 0) {
                        $now = new DateTime();
                        $dateStr = $now->format('Y-m-d');
                        $dateObject = DateTime::createFromFormat('Y-m-d', $dateStr);
                        for ($ok = 8; $ok <= 32; $ok++) {
                            $week = $modelWeek->getById($ok);
                            $time = $week->getStartTime();
                            if (getDaysDiffBetweenDates($dateObject, $time) < 7) {
                                $week_id = $ok;
                                break;
                            }
                        }

                    }
                    $week = $modelWeek->getById($week_id);

                    echo '
                    <div class="suscribe-area animate__animated animate__fadeInDown "
                    style="display:block;margin: 5px 0px; border-radius: 10px;  ">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="suscribe-text text-center">
                                <h4> Lịch học tuần ' . $week->getWeekName() . ' bắt đầu từ ' . toStrYear($week->getStartTime()) . ' đến ' . toStrYear($week->getEndTime()) . '</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" style="width: 5%;background-color: #3ec1d5; 
                            color:#fff"></th>
                            <th class="text-center align-middle" style="width: 13%;background-color: #3ec1d5; 
                            color:#fff">Thứ 2</th>
                            <th class="text-center align-middle" style="width: 13%;background-color: #3ec1d5; 
                            color:#fff">Thứ 3</th>
                            <th class="text-center align-middle" style="width: 13%;background-color: #3ec1d5; 
                            color:#fff">Thứ 4</th>
                            <th class="text-center align-middle" style="width: 13%;background-color: #3ec1d5; 
                            color:#fff">Thứ 5</th>
                            <th class="text-center align-middle" style="width: 13%;background-color: #3ec1d5; 
                            color:#fff">Thứ 6</th>
                            <th class="text-center align-middle" style="width: 13%;background-color: #3ec1d5; 
                            color:#fff">Thứ 7</th>
                            <th class="text-center align-middle" style="width: 12%;background-color: #3ec1d5; 
                            color:#fff">Chủ nhật</th>
                            <th class="text-center align-middle" style="width: 5%;background-color: #3ec1d5; 
                            color:#fff">Thời gian</th>

                            
                        </tr>
                    </thead>
                    <tbody>';
                    //duyet kip 1-6
                    for ($tmp = 1; $tmp <= 6; $tmp++) {
                        echo '<tr>
                            <td class="text-center align-middle"  style="background-color: #3ec1d5; 
                            color:#fff">Kíp ' . $tmp . '</td>';
                        //duyet thu 2-cn
                        for ($i = 2; $i <= 8; $i++) {
                            $ok = 1;
                            //duyet lish dki kiem tra
                            foreach ($listRegister as $key => $value) {
                                if (!is_null($value)) {
                                    $classCredit = $value->getClassCredit();
                                    $listSchedule = $classCredit->getListSchedule();
                                    foreach ($listSchedule as $key1 => $value1) {
                                        if (!is_null($value1)) {
                                            $week = $value1->getWeek()->getWeekId();
                                            $week_end = $value1->getWeekEnd()->getWeekId();
                                            //neu tuan bang tuan dang tim + thu = thu + kip =kip => in r
                                            if ($week_id >= $week && $week_end >= $week_id) {
                                                if ($value1->getDayStudy() == $i && $value1->getKipStudy()->getKipStudyId() == $tmp) {
                                                    echo '<td class="text-left align-middle " style="background-color:#CAEEF3;" ><strong>'
                                                        . $classCredit->getSubject()->getSubjectName() . ' (' .
                                                        $classCredit->getSubject()->getSubjectCode() . ')</strong> <br/> <b>Nhóm : </b>' .
                                                        $classCredit->getGroupClass() . '<br><strong>Phòng học : </strong>' .
                                                        $value1->getClassRoom()->getClassRoomName() . ' ' . $value1->getClassRoom()->getBuilding();
                                                    $listGv = $modelRegister->getGvByClassCreditId($classCredit->getClassCreditId());
                                                    $listTg = $modelRegister->getTgByClassCreditId($classCredit->getClassCreditId());
                                                    echo '<br>';
                                                    if (sizeof($listGv) != 0) {

                                                        echo '<strong>Giảng viên: ';
                                                        echo '</strong>';
                                                        foreach ($listGv as $ok => $gv) {
                                                            if (!is_null($gv)) {
                                                                echo $gv->getFullName() . '<br>';
                                                            }

                                                        }

                                                    }
                                                    if (sizeof($listTg) != 0) {
                                                        echo '<strong>';
                                                        echo 'Trợ giảng: ';
                                                        echo '</strong>';
                                                        foreach ($listTg as $ok => $gv) {
                                                            if (!is_null($gv)) {
                                                                echo $gv->getFullName() . '<br>';
                                                            }

                                                        }
                                                    }

                                                    echo '</td>';
                                                    $ok = 2;
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                            if ($ok == 1) {
                                echo '<td> </td>';
                            }
                        }

                        $kipStudy = $modelKipStudy->getById($tmp);
                        $timeStart = $kipStudy->getTimeStart();
                        echo '<td class="text-center align-middle" style="background-color: #3ec1d5; 
                    color:#fff">' . toStr($timeStart) . ' đến ' . toStr(addDate($timeStart, $kipStudy->getTimeStudy())) . '</td>';

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
</div>



<?php
require "footer.php";
?>