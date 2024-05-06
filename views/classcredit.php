<?php
require_once _DIR_ROOT . '\views\header.php';

?>

<div class="section-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 ">

                <?php
                require "narbar.php";
                ?>

            </div>
            <div class="col-xl-9 ">
                <div class="inner-body text-center pt-3">
                    <h2 class="animate__animated animate__fadeInDown">Danh sách lớp tín chỉ</h2>
        
                    <table
                        class="table table-hover table-bordered table-responsive animate__animated animate__fadeInUp">
                        <thead class="thead-light">
                            <tr>
                               
                                <th class="text-center align-middle" style="width: 5%;background-color: #3ec1d5; 
                            color:#fff">Mã MH</th>
                                <th class="text-center align-middle" style="width: 10%;background-color: #3ec1d5; 
                            color:#fff">Tên môn học</th>
                                <th class="text-center align-middle" style="width: 3%;background-color: #3ec1d5; 
                            color:#fff">Nhóm</th>
                                <th class="text-center align-middle" style="width: 5%;background-color: #3ec1d5; 
                            color:#fff">Số TC</th>
                                <th class="text-center align-middle" style="width: 3%;background-color: #3ec1d5; 
                          
                            color:#fff">Danh sách</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach($data as $key => $li){
                                if(!is_null($li)){
                                    echo '<tr>';
                                    echo '<td class="text-center align-middle">'.$li->getClassCredit()->getSubject()->getSubjectCode().'</td>';
                                    echo '<td class="text-center align-middle ">'.$li->getClassCredit()->getSubject()->getSubjectName().'</td>';
                                    echo '<td class="text-center align-middle">'.$li->getClassCredit()->getGroupClass().'</td>';
                                    echo '<td class="text-center align-middle">'.$li->getClassCredit()->getSubject()->getCredit().'</td>';
                                    echo '<td class="text-center align-middle "> <a class="btn-get-started"href="/classcre/list/'.$li->getClassCredit()->getClassCreditId().'">Xem danh sách</a></td>';
                                    echo '</tr>';
                                }
                            }

                            ?>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>



<?php
require_once _DIR_ROOT . '\views\footer.php';

?>