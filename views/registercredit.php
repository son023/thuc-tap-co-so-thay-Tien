<?php
require_once "header.php";
$modelUser = new ModelUser();
$userId = $_SESSION['login']['username'];
$user = $modelUser->getByUserName($userId);
$modelsemester = new ModelSubjectSemester();
$currentDate = getdate();
$month = $currentDate['mon'];
$year = $currentDate['year'];
$classCourse = $user->getClassFormal()->getClassCourse();
if ($classCourse == 1) {
    $listsubject = $modelsemester->getByNameAndBranch(0, $user->getClassFormal()->getBranch()->getBranchId());
    // show($listsubject);
} else {
    $ki = -1;
    if ($month > 7)
        $ki = 2 * ($year - 2000 - $classCourse) + 1;
    else
        $ki = 2 * ($year - 2000 - $classCourse);
    $listsubject = $modelsemester->getByNameAndBranch($ki, $user->getClassFormal()->getBranch()->getBranchId());
}

$list = [];
$modelcredit = new ModelClassCredit();
$modelRegister = new ModelRegister();
date_default_timezone_set('Asia/Ho_Chi_Minh');
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
    <div class="container-fluid">
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

                <table class="table table-hover table-responsive">
                    <thead class="thead-light">
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
                            $listSv = $modelRegister->getSvByClassCreditId($li->getClassCreditId());
                            $listGv = $modelRegister->getGvByClassCreditId($li->getClassCreditId());
                            $listTg = $modelRegister->getTgByClassCreditId($li->getClassCreditId());
                            if ($check == 1)
                                echo '<td><input type="checkbox" id="' . $li->getClassCreditId() . '" data-credit-id="' . $li->getClassCreditId() . '"></td>';
                            else
                                echo '<td><input type="checkbox" id="' . $li->getClassCreditId() . '" data-credit-id="' . $li->getClassCreditId() . '" checked ></td>';
                            echo '<td>' . $li->getSubject()->getSubjectCode() . '</td>';
                            echo '<td>' . $li->getSubject()->getSubjectName() . '</td>';
                            echo '<td>' . $li->getGroupClass() . '</td>';
                            echo '<td>' . $li->getSubject()->getCredit() . '</td>';
                            echo '<td>' . $li->getGroupClass() . '</td>';
                            if ($_SESSION['login']['role'] == 1) {
                                echo '<td>' . $li->getSvMax() . '</td>';
                                echo '<td>' . $li->getSvMax() - sizeof($listSv) . '</td>';
                            } else if ($_SESSION['login']['role'] == 2) {
                                echo '<td>' . $li->getTgMax() . '</td>';
                                echo '<td>' . $li->getTgMax() - sizeof($listTg) . '</td>';
                            } else {
                                echo '<td>' . $li->getGvMax() . '</td>';
                                echo '<td>' . $li->getGvMax() - sizeof($listGv) . '</td>';
                            }

                            echo
                                '<td>';

                            foreach ($li->getListSchedule() as $key => $schedule) {
                                if (!is_null($schedule)) {
                                    $day='';
                                    if($schedule->getDayStudy()==8) $day='Chủ nhật';
                                    else $day='Thứ '.$schedule->getDayStudy();
                                    $timeStart = $schedule->getKipStudy()->getTimeStart();
                                    echo $day . ' Kíp ' . $schedule->getKipStudy()->getKipStudyId() . ' Từ ' . toStr($timeStart) . ' đến ' . toStr(addDate($timeStart, $schedule->getKipStudy()->getTimeStudy())) .
                                        ', Phòng ' . $schedule->getClassRoom()->getClassRoomName() . '. Thời gian học từ ' . formatYear($schedule->getWeek()->getStartTime()) . ' đến ' . formatYear($schedule->getWeekEnd()->getEndTime()) .
                                        '<br/>';
                                }
                            }
                            if (sizeof($listGv) != 0) {

                                echo 'Giảng viên: ';
                                foreach ($listGv as $ok => $gv) {
                                    if (!is_null($gv)) {
                                        echo $gv->getFullName() . ' ';
                                    }

                                }
                                echo '<br/>';
                            }
                            if (sizeof($listTg) != 0) {
                                echo 'Trợ giảng: ';
                                foreach ($listTg as $ok => $gv) {
                                    if (!is_null($gv)) {
                                        echo $gv->getFullName() . ' ';
                                    }

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
                    <table class="table table-hover  table-responsive">
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
                    <a href='/schedules' class="btn-get-started animate__animated animate__fadeInUp">Xem thời khoá
                        biểu</a>
                </div>

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
                        data = JSON.parse(data);
                        if (data[0].status == 1) {
                            checkbox = document.getElementById(data[0].error);
                            checkbox.checked = false;
                        }
                        else if (data[0].status == 2) {
                            event.target.checked = false;
                            alert(data[0].error);
                        }
                        else if (data[0].status == 3) {
                            event.target.checked = false;
                            alert(data[0].error);
                        }
                        else {
                            console.log(data[0].status);
                        }
                        const cartContainer = document.getElementById('cart-container');
                        const table = document.createElement('table');
                        table.className = 'table table-hover  table-responsive '
                        const tableHeader = document.createElement('thead');
                        const tableBody = document.createElement('tbody');
                        const headerRow = document.createElement('tr');
                        const headers = ['STT', 'Mã MH', 'Tên môn học', 'Nhóm', 'Số TC', 'Lớp', 'Ngày đăng ký', 'Thời khoá biểu'];
                        for (const header of headers) {
                            const headerCell = document.createElement('th');
                            headerCell.textContent = header;
                            headerRow.appendChild(headerCell);
                        }
                        tableHeader.appendChild(headerRow);

                        for (const key of data) {
                            if (key !== '0') {
                                const dataRow = document.createElement('tr');
                                const dataCells = [
                                    key.STT,
                                    key.subjectCode,
                                    key.subjectName,
                                    key.groupClass,
                                    key.credit,
                                    key.class,
                                    key.time,
                                    key.schedule
                                ];
                                for (const data of dataCells) {
                                    const dataCell = document.createElement('td');
                                    dataCell.textContent = data;
                                    dataRow.appendChild(dataCell);
                                }
                                tableBody.appendChild(dataRow);
                            }
                        }
                        table.appendChild(tableHeader);
                        table.appendChild(tableBody);
                        $("#cart-container").html(table);
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    data: { credit_id: creditId },
                    url: "http://localhost:3000/views/removecredit.php",
                    success: function (data) {
                        data = JSON.parse(data);
                        const cartContainer = document.getElementById('cart-container');
                        const table = document.createElement('table');
                        table.className = 'table table-hover  table-responsive '
                        const tableHeader = document.createElement('thead');
                        const tableBody = document.createElement('tbody');
                        const headerRow = document.createElement('tr');
                        const headers = ['STT', 'Mã MH', 'Tên môn học', 'Nhóm', 'Số TC', 'Lớp', 'Ngày đăng ký', 'Thời khoá biểu'];
                        for (const header of headers) {
                            const headerCell = document.createElement('th');
                            headerCell.textContent = header;
                            headerRow.appendChild(headerCell);
                        }
                        tableHeader.appendChild(headerRow);

                        for (const key of data) {
                            if (key !== '0') {
                                const dataRow = document.createElement('tr');
                                const dataCells = [
                                    key.STT,
                                    key.subjectCode,
                                    key.subjectName,
                                    key.groupClass,
                                    key.credit,
                                    key.class,
                                    key.time,
                                    key.schedule
                                ];
                                for (const data of dataCells) {
                                    const dataCell = document.createElement('td');
                                    dataCell.textContent = data;
                                    dataRow.appendChild(dataCell);
                                }
                                tableBody.appendChild(dataRow);
                            }
                        }
                        table.appendChild(tableHeader);
                        table.appendChild(tableBody);
                        $("#cart-container").html(table);
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