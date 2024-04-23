<?php

class Home extends Controller{
    public function index($id='',$slug=''){
        $this->view('home');
    }
}
?>