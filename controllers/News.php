<?php

class News extends Controller{
    public function index($id='',$slug=''){
        $this->view('news');
    }
}
?>