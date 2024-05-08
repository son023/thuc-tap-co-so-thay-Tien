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
                <h3 style="left:450px  " class="animate__animated animate__fadeInDown mb-10">Danh sách đăng ký lớp tín
                    chỉ</h3>
                <p class="animate__animated animate__fadeInDown text-center"><?php check_message() ?></p>
                <?php echo '<div><a class=" btn-get-started" href="http://localhost:3000/admin/addregister" title="Sửa Thông Tin" data-toggle="tooltip" >  Thêm đăng ký </a> </div>'; ?>
                <table class="table table-hover table-bordered table-responsive animate__animated animate__fadeInUp">
                    <thead class="thead-light">
                        <tr>

                            <th class="text-center align-middle"
                                style="width: 1%;background-color: #3ec1d5; color:#fff">STT</th>
                            <th class="text-center align-middle"
                                style="width: 3%;background-color: #3ec1d5; color:#fff">Mã định danh</th>
                            <th class="text-center align-middle"
                                style="width: 4%;background-color: #3ec1d5; color:#fff">Họ tên</th>
                                <th class="text-center align-middle"
                                style="width: 4%;background-color: #3ec1d5; color:#fff">Môn học</th>
                            <th class="text-center align-middle"
                                style="width: 5%;background-color: #3ec1d5; color:#fff">Thời gian</th>
                            
                            <th class="text-center align-middle"
                                style="width: 1%;background-color: #3ec1d5; color:#fff">Nhóm</th>
                            <th class="text-center align-middle"
                                style="width: 4%;background-color: #3ec1d5; color:#fff">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ok = 1;
                        foreach ($data as $key => $li) {
                            if (!is_null($li)) {

                                echo '<tr>';
                                echo '<td class="text-center align-middle">' . $ok . '</td>';
                                echo '<td class=" align-middle">' . $li->getUser()->getUserName() . '</td>';
                                echo '<td class="text-center align-middle">' .  $li->getUser()->getFullName() . '</td>';
                                echo '<td class="text-center align-middle">' .  $li->getClassCredit()->getSubject()->getSubjectName() . '</td>';
                                echo '<td class="text-center align-middle">' .  toStrRegister($li->getRegisterTime()) . '</td>';
                                
                                echo '<td class="text-center align-middle">' . $li->getClassCredit()->getGroupClass() . '</td>';
                              
                                echo '<td>';
                             
                               
                                echo '<a class="btn-crud text-center align-middle" href="http://localhost:3000/admin/deleteregister/'.$li->getRegisterId().'" title="Xoá lớp tín chỉ" data-toggle="tooltip" ><i class="fa-solid fa-delete-left"></i></a> ';

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