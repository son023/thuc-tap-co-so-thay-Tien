<?php

class Profile extends Controller{
    public function index(){
        $modelUser=new ModelUser();
        $user=$modelUser->getByUserName($_SESSION['login']['username']);
        $list=array();
        $role=$_SESSION['login']['role'];
        array_push($list,$user);
        array_push($list,$role);
        $this->view('profile',$list);
    }
}
?>