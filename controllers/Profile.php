<?php

class Profile extends Controller{
    public function index($id='',$slug=''){
        $this->view('profile');
    }
}
?>