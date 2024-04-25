<?php
session_start();
ob_start();
require_once '../configs/functions.php';
require_once '../models/ModelDAO.php';
if (isset($_POST['credit_id'])) {
    $credit = $_SESSION['credit'];
    $creditId = $_POST['credit_id'];
    unset($_SESSION['credit'][$creditId]);
    $modelcredit = new ModelClassCredit();
}
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
                <th>Còn lại</th>
                <th>Thời khóa biểu</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            if(isset($_SESSION['credit'])){$ok=1;
            foreach ($_SESSION['credit']  as $key => $li) {
                if(!is_null($key)){
                    $creditlist = $modelcredit->getById($key);
                    echo '<tr>';
                    echo '<td>' .$ok.'</td>';
                    $ok+=1;
                    echo '<td>' .$creditlist->getSubject()->getSubjectCode() . '</td>';
                    echo '<td>' .$creditlist->getSubject()->getSubjectName() . '</td>';
                    echo '<td>' . $creditlist->getGroupClass() . '</td>';
                    echo '<td>' . $creditlist->getSubject()->getCredit() . '</td>';
                    echo '<td>' . $creditlist->getGroupClass() . '</td>';
                    echo '<td>' .$creditlist->getGroupClass(). '</td>';
                    echo '<td>' .$creditlist->getGroupClass(). '</td>';
                    $timeStart = $creditlist->getSchedule()->getKipStudy()->getTimeStart();
                    $timeEnd = addDate($timeStart, $creditlist->getSchedule()->getKipStudy()->getTimeStudy());
                    echo
                        '<td>' . 'Thứ ' . $creditlist->getSchedule()->getDayStudy() . ' Từ ' . toStr($timeStart) . ' đến ' . toStr($timeEnd) .





                        '</td>';
                    echo '</tr>';
                }
            }}

            ?>

        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (const checkbox of checkboxes) {
                checzkbox.addEventListener('click', handleCheckboxClick);
            }
        });
    </script>
    <script src="public/js/main.js"></script>
</body>

</html>