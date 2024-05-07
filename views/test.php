<?php
require_once '../models/ModelDAO.php';
$model=new ModelClassFormal();
$list=$model->getAll();
foreach ($list as $key=>$li) {
	if (!is_null($li)) {
		$classCourse = $li->getClassCourse();
		$classNumber = $li->getClassNumber();
		$brand = $li->getBranch()->getBrandName();
		$id = $li->getClassFormalId();
		$classFormal = 'D' . $classCourse . $brand . $classNumber;
		echo '<option value="' . $id . '">' . $classFormal . '</option>';
	}
}
?>