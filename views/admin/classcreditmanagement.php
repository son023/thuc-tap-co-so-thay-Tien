<?php
require_once _DIR_ROOT . '\views\header.php';
?>
<div class="section-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 ">

                <?php
                require "narbaradmin.php";
                ?>

            </div>
            <div class="col-xl-10 justify-content-center">
                <h3 style="left:490px  "class="animate__animated animate__fadeInDown mb-10">Danh sách lớp tín chỉ</h3>
                <p class="animate__animated animate__fadeInDown text-center"><?php check_message() ?></p>
                <?php echo '<div><a class=" btn-get-started" href="http://localhost/thuc-tap-co-so-thay-Tien/admin/addclasscredit" title="Sửa Thông Tin" data-toggle="tooltip" >  Thêm lớp tín chỉ </a> </div>';?>
                <table class="table table-hover table-bordered table-responsive animate__animated animate__fadeInUp">
                    <thead class="thead-light">
                        <tr>

                            <th class="text-center align-middle"
                                style="width: 1%;background-color: #3ec1d5; color:#fff">STT</th>
                            <th class="text-center align-middle"
                                style="width: 4%;background-color: #3ec1d5; color:#fff">Tên môn học</th>
                                <th class="text-center align-middle"
                                style="width: 1%;background-color: #3ec1d5; color:#fff">Lớp</th>
                            <th class="text-center align-middle"
                                style="width: 1%;background-color: #3ec1d5; color:#fff">Nhóm</th>
                            <th class="text-center align-middle"
                                style="width: 9%;background-color: #3ec1d5; color:#fff">Lịch học</th>
                            <th class="text-center align-middle"
                                style="width: 3%;background-color: #3ec1d5; color:#fff">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ok = 1;
                        foreach ($data as $key => $li) {
                            if (!is_null($li)) {
        
                                echo '<tr>';
                                echo '<td class="text-center align-middle">' . $ok . '</td>';
                                echo '<td class=" align-middle">' . $li->getSubject()->getSubjectName() . '</td>';
                                echo '<td class="text-center align-middle">' . $li->getClassCreditName() . '</td>';
                                echo '<td class="text-center align-middle">' . $li->getGroupClass() . '</td>';
                                echo '<td class="text-justify align-middle">' . getSchedule($li,'') . '</td>';
                                echo '<td>';
                                    echo '<a class="btn-crud text-center align-middle" href="http://localhost/thuc-tap-co-so-thay-Tien/classcre/list/'.$li->getClassCreditId().'" title="Xem lớp" data-toggle="tooltip" ><i class="fa-regular fa-eye"></i></a>';
                                    echo '<a class="btn-crud text-center align-middle"  href="#" title="Sửa Thông Tin" data-toggle="tooltip" > <span><i class="fa-solid fa-pen"></i> </span> </a> ';
                                    echo '<a class="btn-crud text-center align-middle" href="http://localhost/thuc-tap-co-so-thay-Tien/admin/deleteclasscredit/'.$li->getClassCreditId().'" title="Xoá lớp tín chỉ" data-toggle="tooltip" ><i class="fa-solid fa-delete-left"></i></a> ';

                                echo '</tr>';
                                $ok += 1;
                            }
                        }



                        ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<?php
require_once _DIR_ROOT . '\views\footer.php';
?>