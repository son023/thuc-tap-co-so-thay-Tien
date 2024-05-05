<?php
require_once _DIR_ROOT . '\views\header.php';

?>
<style>
  
#accordion {
 
  margin-bottom: 0; 
  list-style: none; 
  padding: 0; 
  border: 1px solid #ddd; 
  border-radius: 5px; 
}

#accordion .card {
   
  margin-bottom: 15px; 
  border: none; 
  border-radius: 5px; 
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); 
  transition: all 0.3s ease-in-out; 
}

#accordion .card-header {
  padding: 10px 15px;
  cursor: pointer; 
  background-color: #f5f5f5; 
  transition: all 0.3s ease-in-out; 
}

#accordion .card-header:hover {
  background-color: #e0e0e0;
}

#accordion .card-header.active {
  background-color: #ddd; 
  border-bottom: 1px solid #ddd; 
}

#accordion .card-body {
    margin: 0 auto;
  padding: 15px;
  font-size: 17px;
  line-height: 1.5;
}
</style>
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