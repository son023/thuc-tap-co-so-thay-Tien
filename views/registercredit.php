<?php
require_once "header.php";
$modelUser = new ModelUser();
$modelsemester = new ModelSubjectSemester();
$listsubject = $modelsemester->getByNameAndBranch(1, $modelUser->getByUserName($_SESSION['login']['username'])->getClassFormal()->getBranch()->getBranchId());
$list = [];
$modelcredit = new ModelClassCredit();
$modelRegister = new ModelRegister();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$userId = $_SESSION['login']['username'];
$user = $modelUser->getByUserName($userId);

$list1 = $modelRegister->getByUserId($user->getUserId());
foreach ($listsubject as $value) {
    $creditlist = $modelcredit->getBySubject($value->getSubject()->getSubjectId());
    if (!is_null($creditlist)) {
        $list = array_merge($list, $creditlist);

    }

}

$number = 70;






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
                    <?php

                    foreach ($list as $key => $li) {
                        $check = 1;
                        echo '<tr>';
                            foreach ($list1 as $key1 => $li1) {
                                if (!is_null($key1)) {
                                    if ((int) $li->getClassCreditId() == $li1->getClassCredit()->getClassCreditId())
                                        $check = 0;
                                }
                            }
                      
                        if ($check == 1)
                            echo '<td><input type="checkbox" id="' . $li->getClassCreditId() . '" data-credit-id="' . $li->getClassCreditId() . '"></td>';
                        else
                            echo '<td><input type="checkbox" id="' . $li->getClassCreditId() . '" data-credit-id="' . $li->getClassCreditId() . '" checked ></td>';
                        echo '<td>' . $li->getSubject()->getSubjectCode() . '</td>';
                        echo '<td>' . $li->getSubject()->getSubjectName() . '</td>';
                        echo '<td>' . $li->getGroupClass() . '</td>';
                        echo '<td>' . $li->getSubject()->getCredit() . '</td>';
                        echo '<td>' . $li->getGroupClass() . '</td>';
                        echo '<td>' . $number . '</td>';
                        echo '<td>' . $number . '</td>';

                        echo
                            '<td>';
                        foreach ($li->getListSchedule()->getSchedule() as $key => $schedule) {
                            if (!is_null($schedule)) {
                                $timeStart = $schedule->getKipStudy()->getTimeStart();
                                echo 'Thứ ' . $schedule->getDayStudy() . ' Kíp '.$schedule->getKipStudy()->getKipStudyId() .' Từ ' . toStr($timeStart) . ' đến ' . toStr(addDate($timeStart, $schedule->getKipStudy()->getTimeStudy())) . 
                                ', Phòng ' .$schedule->getClassRoom()->getClassRoomName(). '. Thời gian học từ ' . formatYear($schedule->getWeek()->getStartTime()). ' đến '.formatYear($schedule->getWeekEnd()->getEndTime()) .
                                '<br/>';
                            }
                        }

                        echo '</td>';
                        echo '</tr>';
                    }

                    ?>

                </tbody>
            </table>
            <h1 class="text-center"> DANH SÁCH MÔN ĐĂNG KÝ</h1>
            <div id="credit-container">
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
                     
                         showRegister($list1);
                        ?>

                    </tbody>
                </table>

            </div>
            <div id="cart-container"></div>
            <div>
                <button class="btn-get-started animate__animated animate__fadeInUp">Lưu đăng ký</button>
            </div>

        </div>
    </div>


</div>


<script>

    $(document).ready(function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        myElement = document.getElementById('credit-container');
        function handleCheckboxClick(event) {
            const creditId = event.target.getAttribute('data-credit-id');
            const isChecked = event.target.checked;
            myElement.style.display = "none";
            if (isChecked) {
                $.ajax({
                    method: "POST",
                    data: { credit_id: creditId },
                    url: "http://localhost:3000/views/registerlist.php",
                    success: function (data) {
                        $("#cart-container").html(data);
                        //   alert("Đã thêm sản phẩm vào giỏ hàng!");
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    data: { credit_id: creditId },
                    url: "http://localhost:3000/views/removecredit.php",
                    success: function (data) {
                        $("#cart-container").html(data);
                    }
                });
            }

        }
        for (const checkbox of checkboxes) {

            checkbox.addEventListener('click', handleCheckboxClick);
        }
    });
</script>

<?php

require "footer.php";
?>