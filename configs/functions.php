<?php 

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}




function check_message()
{

	if(isset($_SESSION['error']) && $_SESSION['error'] != "")
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
}
function toStr($date){
	return $date->format('H:i');
}
function addDate($date,$time){
	$str = 'PT' . sprintf('%02dM', $time);
	return $date->add(new DateInterval($str));
}

