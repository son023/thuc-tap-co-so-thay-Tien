<?php

    session_start();
    ob_start();
    define('_DIR_ROOT',__DIR__);
    require_once 'configs/functions.php';
    require_once 'models/ModelDAO.php';
    require_once 'controllers/Controller.php';
    require_once 'configs/routes.php';
    require_once 'App.php';


    $app=new App();
?>