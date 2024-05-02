<?php
require_once _DIR_ROOT . '\views\header.php';

?>
<style>
  
/* Overall accordion styling */
#accordion {
    /* justify-content:between; */
 
  margin-bottom: 0; /* Remove default bottom margin */
  list-style: none; /* Remove default list styling */
  padding: 0; /* Reset padding */
  border: 1px solid #ddd; /* Add a thin border */
  border-radius: 5px; /* Add rounded corners */
}

/* Individual card styling */
#accordion .card {
   
  margin-bottom: 15px; /* Add spacing between cards */
  border: none; /* Remove default card border */
  border-radius: 5px; /* Add rounded corners */
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle box-shadow for depth */
  transition: all 0.3s ease-in-out; /* Smooth transition on hover */
}

/* Card header styling */
#accordion .card-header {
  padding: 10px 15px; /* Adjust padding for content */
  cursor: pointer; /* Indicate clickability */
  background-color: #f5f5f5; /* Light background color */
  transition: all 0.3s ease-in-out; /* Smooth transition on hover */
}

/* Card header hover effect */
#accordion .card-header:hover {
  background-color: #e0e0e0; /* Slightly darker on hover */
}

/* Active card header styling */
#accordion .card-header.active {
  background-color: #ddd; /* Distinguish active header */
  border-bottom: 1px solid #ddd; /* Add bottom border for active state */
}

/* Card content styling */
#accordion .card-body {
    margin: 0 auto;
  padding: 15px; /* Adjust padding for content */
  font-size: 17px; /* Set font size */
  line-height: 1.5; /* Adjust line spacing for readability */
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
                    <h2>Thông báo từ phòng giáo vụ</h2>
                    <?php
                    echo '
                        <div class="accordion" id="accordion">';
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