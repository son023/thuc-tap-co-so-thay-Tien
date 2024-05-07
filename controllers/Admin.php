<?php

class Admin extends Controller{
   
    public function index($id=''){
        $this->viewAdmin('loginadmin');
    }
    public function usermanagement($id=''){
        $modelUser=new ModelUser();
        $list=$modelUser->getAll();
        $this->viewAdmin('usermanagement',$list);
    }
    public function classcreditmanagement($id=''){
        $this->viewAdmin('classcreditmanagement');
    }
    public function registermanagement($id=''){
        $this->viewAdmin('registermanagement');
    }

}

?>