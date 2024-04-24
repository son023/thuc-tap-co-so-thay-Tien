<?php
    require_once "header.php";
    $modeluser=new ModelUser();
    $modelsemester=new ModelSubjectSemester();
    $listsubject=$modelsemester->getByNameAndBranch(1,$modeluser->getByUserName($_SESSION['login']['username'])->getClassFormal()->getBranch()->getBranchId());
    $list=[];
    $modelcredit=new ModelClassCredit();
    foreach ($listsubject as $value) {
        $creditlist=$modelcredit->getBySubject($value->getSubject()->getSubjectId());
        $list = array_merge($list, $creditlist);
    }
    $number=70;
    
    

    
    
?>

<div class="section-one">

    <div class="row">
        <div class="col-xl-3">
            <?php
            require "narbar.php";
            ?>
        </div>
        <div class="col-xl-9">

            <div class="suscribe-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
                            <div class="suscribe-text text-center">
                                <h3>Đăng Ký Môn Học Học Kỳ 2 - Năm Học 2023 - 2024</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Suscribe Section -->

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th> </th>
                        <th>Mã MH</th>
                        <th>Tên môn học</th>
                        <th>Nhóm</th>
                        <th>Số TC</th>
                        <th>Lớp</th>
                        <th>Số lượng</th>
                        <th>Còn lại</th>
                        <th>Thời khóa biểu</th>
                    </tr>
                </thead>
                <tbody>
               <?php foreach ($list as $key => $li) {
                    echo '<tr>';
                    echo '<td>'  .'
                    <form method="post"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> <input type="checkbox" id="'. $li->getClassCreditId().'" name="checkbox_'. $li->getClassCreditId().'" value="1"> </form>
                    
                    '. '</td>';
                    echo '<td>' . $li->getSubject()->getSubjectCode() . '</td>';
                    echo '<td>' . $li->getSubject()->getSubjectName() . '</td>';
                    echo '<td>' . $li->getGroupClass() . '</td>';
                    echo '<td>' . $li->getSubject()->getCredit() . '</td>';
                    echo '<td>' . $li->getGroupClass() . '</td>';
                    echo '<td>' . $number . '</td>';
                    echo '<td>' . $number . '</td>';
                    $timeStart=$li->getSchedule()->getKipStudy()->getTimeStart();
                    $timeEnd=addDate($timeStart,$li->getSchedule()->getKipStudy()->getTimeStudy());
                    echo 
                        '<td>' .'Thứ '. $li->getSchedule()->getDayStudy() . ' Từ '. toStr($timeStart) .' đến ' .toStr($timeEnd) .

                    
                    
                    
                    
                        '</td>';
                    echo '</tr>';
                }
                foreach ($list as $key => $li) {
                    if (isset($_POST[(string)$li->getClassCreditId()])) {
                        $_SESSION['register'] [(string)$li->getClassCreditId()]= $_POST[(string)$li->getClassCreditId()];
                    } else {
                        
                        echo "Checkbox không được chọn";
                    }
                }
                foreach ($_SESSION['register'] as $key => $value) {
                    echo "Key: " . $key . " - Value: " . $value . "<br>";
                  }
                ?>

                </tbody>
            </table>

        </div>
    </div>


</div>
</div>



<?php
require "footer.php";
?>