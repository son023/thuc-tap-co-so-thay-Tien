<?php
require_once "header.php";
$modeluser = new ModelUser();
$modelsemester = new ModelSubjectSemester();
$listsubject = $modelsemester->getByNameAndBranch(1, $modeluser->getByUserName($_SESSION['login']['username'])->getClassFormal()->getBranch()->getBranchId());
$list = [];
$modelcredit = new ModelClassCredit();
foreach ($listsubject as $value) {
    $creditlist = $modelcredit->getBySubject($value->getSubject()->getSubjectId());
    $list = array_merge($list, $creditlist);
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
                            $check=1;
                            echo '<tr>';
                            if(isset($_SESSION['credit'])){
                                foreach ($_SESSION['credit'] as $key1 => $li1) {
                                    if (!is_null($key1)) {
                                        if((int)$key1== $li->getClassCreditId()) $check=0;
                                    }
                                }
                            }
                            if($check==1)  echo '<td><input type="checkbox" id="' . $li->getClassCreditId() . '" data-credit-id="' . $li->getClassCreditId() . '"></td>';
                            else echo '<td><input type="checkbox" id="' . $li->getClassCreditId() . '" data-credit-id="' . $li->getClassCreditId() . '" checked ></td>';
                            echo '<td>' . $li->getSubject()->getSubjectCode() . '</td>';
                            echo '<td>' . $li->getSubject()->getSubjectName() . '</td>';
                            echo '<td>' . $li->getGroupClass() . '</td>';
                            echo '<td>' . $li->getSubject()->getCredit() . '</td>';
                            echo '<td>' . $li->getGroupClass() . '</td>';
                            echo '<td>' . $number . '</td>';
                            echo '<td>' . $number . '</td>';
                            $timeStart = $li->getSchedule()->getKipStudy()->getTimeStart();
                            $timeEnd = addDate($timeStart, $li->getSchedule()->getKipStudy()->getTimeStudy());
                            echo
                                '<td>' . 'Thứ ' . $li->getSchedule()->getDayStudy() . ' Từ ' . toStr($timeStart) . ' đến ' . toStr($timeEnd) .





                                '</td>';
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
                            <th>Còn lại</th>
                            <th>Thời khóa biểu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_SESSION['credit'])){
                             $ok = 1;
                        foreach ($_SESSION['credit'] as $key => $li) {
                            if (!is_null($key)) {

                                $creditlist = $modelcredit->getById($key);
                                echo '<tr>';
                                echo '<td>' . $ok . '</td>';
                                $ok += 1;
                                echo '<td>' . $creditlist->getSubject()->getSubjectCode() . '</td>';
                                echo '<td>' . $creditlist->getSubject()->getSubjectName() . '</td>';
                                echo '<td>' . $creditlist->getGroupClass() . '</td>';
                                echo '<td>' . $creditlist->getSubject()->getCredit() . '</td>';
                                echo '<td>' . $creditlist->getGroupClass() . '</td>';
                                echo '<td>' . $creditlist->getGroupClass() . '</td>';
                                echo '<td>' . $creditlist->getGroupClass() . '</td>';
                                $timeStart = $creditlist->getSchedule()->getKipStudy()->getTimeStart();
                                $timeEnd = addDate($timeStart, $creditlist->getSchedule()->getKipStudy()->getTimeStudy());
                                echo
                                    '<td>' . 'Thứ ' . $creditlist->getSchedule()->getDayStudy() . ' Từ ' . toStr($timeStart) . ' đến ' . toStr($timeEnd) .





                                    '</td>';
                                echo '</tr>';
                            }
                        }
                        }

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
                    url: "http://localhost:3000/views/removeproduct.php",
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