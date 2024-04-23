<?php
require "header.php";
?>

<div class="section-one">
    
        <div class="row">
            <div class="col-xl-3">
                <?php
                require "narbar.php";
                ?>
            </div>
            <div class="col-xl-9">
           
                    <h2>Responsive Table</h2>
                    <p>The .table-responsive class adds a scrollbar to the table when needed:</p>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <?php
                                   
                                    $class=new ModelClassRoom();
                                    $c=$class->getById(1);
                                    $user=new ModelUser();
                                    $u=$user->getById(2);

                                    ?>
                                    <th>o</th>
                                    <th><?php echo($c->getBuilding())?></th>
                                    <th><?php echo($u->getUserName())?></th>
                                    <th><?php echo($u->getUserName())?></th>
                                    <th><?php  echo($u->getUserName())?></th>
                                    <th><?php  echo($u->getUserName())?></th>
                                    <th><?php  echo($u->getUserName())?></th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                    <th>Example</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Anna</td>
                                    <td>Pitt</td>
                                    <td>35</td>
                                    <td>New York</td>
                                    <td>USA</td>
                                    <td>Female</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Anna</td>
                                    <td>Pitt</td>
                                    <td>35</td>
                                    <td>New York</td>
                                    <td>USA</td>
                                    <td>Female</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Anna</td>
                                    <td>Pitt</td>
                                    <td>35</td>
                                    <td>New York</td>
                                    <td>USA</td>
                                    <td>Female</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Anna</td>
                                    <td>Pitt</td>
                                    <td>35</td>
                                    <td>New York</td>
                                    <td>USA</td>
                                    <td>Female</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Anna</td>
                                    <td>Pitt</td>
                                    <td>35</td>
                                    <td>New York</td>
                                    <td>USA</td>
                                    <td>Female</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Anna</td>
                                    <td>Pitt</td>
                                    <td>35</td>
                                    <td>New York</td>
                                    <td>USA</td>
                                    <td>Female</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                </tr>
                            </tbody>
                        </table>
                  
                </div>
            </div>

    
    </div>
</div>
    


<?php
require "footer.php";
?>