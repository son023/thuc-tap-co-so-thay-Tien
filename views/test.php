<?php
require_once '../models/ModelDAO.php';
$modelSubject = new ModelSubject();
$list = $modelClassFormal->getAll();

foreach ($list as $key => $li) {
	if (!is_null($li)) {
		$subject=$li->getSubjectName();
		$id=$li->getSubjectId();
		echo '<option value="' . $id . '">' . $subject . '</option>';
	}
}
?>