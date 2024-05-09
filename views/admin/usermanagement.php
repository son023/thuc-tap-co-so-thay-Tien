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
                <h3 style="left:490px  "class="animate__animated animate__fadeInDown mb-10">Danh sách nguời dùng</h3>
                <p class="animate__animated animate__fadeInDown text-center"><?php check_message() ?></p>
                <?php echo '<div><a class=" btn-get-started" href="http://localhost/thuc-tap-co-so-thay-Tien/admin/adduser" title="Sửa Thông Tin" data-toggle="tooltip" >  Thêm người dùng </a> </div>';?>

                <table class="table table-hover table-bordered table-responsive animate__animated animate__fadeInUp">
                    <thead class="thead-light">
                        <tr>

                            <th class="text-center align-middle"
                                style="width: 5%;background-color: #3ec1d5; color:#fff">STT</th>
                            <th class="text-center align-middle"
                                style="width: 10%;background-color: #3ec1d5; color:#fff">Họ và tên</th>
                            <th class="text-center align-middle"
                                style="width: 3%;background-color: #3ec1d5; color:#fff">Mã định danh</th>
                            <th class="text-center align-middle"
                                style="width: 5%;background-color: #3ec1d5; color:#fff">Vai trò</th>
                            <th class="text-center align-middle"
                                style="width: 5%;background-color: #3ec1d5; color:#fff">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ok = 1;
                        foreach ($data as $key => $li) {
                            if (!is_null($li)) {
                                $roleString = '';
                                if ($li->getUserRole() == 1) {
                                    $roleString = 'Sinh viên';

                                } else if ($li->getUserRole() == 2) {
                                    $roleString = 'Trợ giảng';

                                } 
                                else if ($li->getUserRole() == 4) {
                                    $roleString = 'Admin';

                                } else {
                                    $roleString = 'Giảng viên';

                                }
                                echo '<tr>';
                                echo '<td class="text-center align-middle">' . $ok . '</td>';
                                echo '<td class="text-center align-middle">' . $li->getFullName() . '</td>';
                                echo '<td class="text-center align-middle">' . $li->getUserName() . '</td>';
                                echo '<td class="text-center align-middle">' . $roleString . '</td>';
                                echo '<td>';
                                    echo '<a class="btn-crud" href="http://localhost/thuc-tap-co-so-thay-Tien/admin/usermanagement/'.$li->getUserId().'" title="Xem Người Dùng" data-toggle="tooltip" ><i class="fa-regular fa-eye"></i></a>';
                                    echo '<a class="btn-crud" href="http://localhost/thuc-tap-co-so-thay-Tien/admin/updateuser/'.$li->getUserId().'" title="Sửa Thông Tin" data-toggle="tooltip" > <span><i class="fa-solid fa-pen"></i> </span> </a> ';
                                    echo '<a class="btn-crud" href="http://localhost/thuc-tap-co-so-thay-Tien/admin/deleteuser/'.$li->getUserId().'" title="Xoá Người Dùng" data-toggle="tooltip" ><i class="fa-solid fa-delete-left"></i></a> ';

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