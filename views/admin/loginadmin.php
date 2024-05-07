
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
            <div class="col-xl-10 ">
                <div class="inner-body text-center pt-3">
                    <h2 class="animate__animated animate__fadeInDown">Thông báo từ phòng giáo vụ</h2>
                    <?php
                    echo '
                        <div class="accordion table-responsive animate__animated animate__fadeInUp" id="accordion">';
                            foreach($data as $key => $value){
                                if(!is_null($value)){
                                    $check='';
                                    $check1='collapsed';
                                    if($key==0){ $check='show';$check1='';}
                                        echo '

                                    <div class="card">
                                      <div class="card-header">
                                        <a class="btn" data-bs-toggle="collapse" href="#'.$value->getNewId().'">
                                          '.$value->getNewTitle().' '.toStrRegister($value->getNewTime()).' 
                                        </a>
                                      </div>
                                      <div id="'.$value->getNewId().'" class="collapse '.$check.'" data-bs-parent="#accordion">
                                        <div class="card-body">
                                        '.$value->getNewBody().'
                                        </div>
                                      </div>
                                    ';

                                }
                            }
                        echo '</div>';  
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>


 <?php
require_once _DIR_ROOT . '\views\footer.php';
?>