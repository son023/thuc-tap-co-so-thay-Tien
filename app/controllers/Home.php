<?php
require_once _DIR_ROOT. '/app/dal/ModelDAO.php';
class Home{
    public function index($id='',$slug=''){
        echo 'id san pham' .$id. '<br>';
        echo 'id san pham' .$slug. '<br>';

    }
    public function search(){
        $keyword=$_GET['keyword'];
        echo 'Tu khoa can tim: ' . $keyword ;
        $dao=new ModelUser();
        $user=$dao->getById(1);
        echo $user->getUserName();


        
    }
    public function render($view, $data=[]){
        extract(($data));
        if(file_exists(_DIR_ROOT . '/app/views/' .$view. '.php')){
            require_once _DIR_ROOT . '/app/views/' .$view. '.php';
        }

    }
    public function show(){
        $dao=new ModelUser();
        $user=$dao->getById(1);
        
        $this->render('login');
        
    }
  
}
?>