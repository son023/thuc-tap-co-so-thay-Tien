<?php

class Admin extends Controller
{

    public function index($id = '')
    {
        $this->viewAdmin('loginadmin');
    }
    public function usermanagement($id = '')
    {
        $modelUser = new ModelUser();
        if ($id == '') {
            $list = $modelUser->getAll();
            $this->viewAdmin('usermanagement', $list);
        } else {
            $list = [];
            $user = $modelUser->getById($id);
            array_push($list, $user);
            array_push($list,$user->getUserRole());
            $teacher=$modelUser->getById($user->getClassFormal()->getTeacherId());
            array_push($list,$teacher);
            $this->viewAdmin('viewuser', $list);
        }
    }
    public function adduser($id = '')
    {
        $this->viewAdmin('adduser');
    }
    public function deleteuser($id = '')
    {
        $modelUser = new ModelUser();
        if($modelUser->deleteObject((int)$id)){
            $_SESSION['error']='Xoá người dùng thành công';
            
        }
        else{
            $_SESSION['error']='Xoá thất bại';
           
        }
        $list = $modelUser->getAll();
        $this->viewAdmin('usermanagement', $list);
        
    }

    public function updateuser($id = '')
    {
        $modelUser = new ModelUser();
        $list = [];
        $user = $modelUser->getById((int)$id);
        array_push($list, $user);
        $this->viewAdmin('updateuser', $list);
    }
    public function classcreditmanagement($id = '')
    {
        $this->viewAdmin('classcreditmanagement');
    }
    public function registermanagement($id = '')
    {
        $this->viewAdmin('registermanagement');
    }

}

?>