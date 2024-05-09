<?php
require_once '../models/ModelDAO.php';
$modelEmail=new ModelEmail();
var_dump($modelEmail->getByUserId(40));