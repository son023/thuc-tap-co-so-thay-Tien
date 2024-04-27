<?php
session_start();
ob_start();
require_once '../configs/functions.php';
require_once '../models/ModelDAO.php';
$modelUser = new ModelUser();
$modelRegister = new ModelRegister();
$modelcredit = new ModelClassCredit();
$userId = $_SESSION['login']['username'];
$user = $modelUser->getByUserName($userId);

if (isset($_POST['credit_id'])) {
    $creditId = $_POST['credit_id'];
    $modelRegister->deleteByUserAndClassCredit($user->getUserId(), $creditId);
    
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
            
            <?php showRegister($list);

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