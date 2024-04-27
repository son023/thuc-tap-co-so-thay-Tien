<?php

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}




function check_message()
{

	if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
}
function toStr($date)
{
	return $date->format('H:i');
}
function toStrYear($date)
{
	return $date->format('d-m-Y');
}
function toStrRegister($date)
{
	return $date->format('d-m-Y H:i:s');
}
// function addDate($date,$time){
// 	$str = 'PT' . sprintf('%02dM', $time);
// 	return $date->add(new DateInterval($str));
// }
function addDate($date, $minutes)
{
	$str = 'PT' . sprintf('%02dM', $minutes);
	$interval = new DateInterval($str);
	return $date->add($interval);
}
function formatYear($date)
{
	return toStrYear($date);
}
function getSchedule($creditlist,$ok1){
	$ok=$ok1.' '. $creditlist->getSubject()->getSubjectName();
	foreach ($creditlist->getListSchedule() as $key => $schedule) {
		if (!is_null($schedule)) {
			$timeStart = $schedule->getKipStudy()->getTimeStart();
			$ok.= ': Thứ ' . $schedule->getDayStudy() . ' Kíp ' . $schedule->getKipStudy()->getKipStudyId() . ' Từ ' . toStr($timeStart) . ' đến ' . toStr(addDate($timeStart, $schedule->getKipStudy()->getTimeStudy())) .
				', Phòng ' . $schedule->getClassRoom()->getClassRoomName() .' '.$schedule->getClassRoom()->getBuilding(). '. Thời gian học từ ' . formatYear($schedule->getWeek()->getStartTime()) . ' đến ' . formatYear($schedule->getWeekEnd()->getEndTime()) .
				'. ';
		}
	}
	return $ok;
}

function showRegister($list)
{
	$ok = 1;
	foreach ($list as $key => $li) {
		if (!is_null($key)) {
			$creditlist = $li->getClassCredit();
			echo '<tr>';
			echo '<td>' . $ok . '</td>';
			$ok += 1;
			echo '<td>' . $creditlist->getSubject()->getSubjectCode() . '</td>';
			echo '<td>' . $creditlist->getSubject()->getSubjectName() . '</td>';
			echo '<td>' . $creditlist->getGroupClass() . '</td>';
			echo '<td>' . $creditlist->getSubject()->getCredit() . '</td>';
			echo '<td>' . $creditlist->getGroupClass() . '</td>';

			echo '<td>' . toStrRegister($li->getRegisterTime()) . '</td>';
			echo
				'<td>';
			foreach ($creditlist->getListSchedule() as $key => $schedule) {
				if (!is_null($schedule)) {
					$timeStart = $schedule->getKipStudy()->getTimeStart();
					echo 'Thứ ' . $schedule->getDayStudy() . ' Kíp ' . $schedule->getKipStudy()->getKipStudyId() . ' Từ ' . toStr($timeStart) . ' đến ' . toStr(addDate($timeStart, $schedule->getKipStudy()->getTimeStudy())) .
						', Phòng ' . $schedule->getClassRoom()->getClassRoomName() .' '.$schedule->getClassRoom()->getBuilding(). '. Thời gian học từ ' . formatYear($schedule->getWeek()->getStartTime()) . ' đến ' . formatYear($schedule->getWeekEnd()->getEndTime()) .
						'<br/>';
				}
			}

			echo '</td>';
			echo '</tr>';
		}
	}
}

function checkClassCredit($classCredit1,$classCredit2){
	
	foreach($classCredit1->getListSchedule() as $key1=>$li1){
	
		foreach($classCredit2->getListSchedule() as $key2=>$li2){
			if(!is_null($key1)&&!is_null($key2)){
				
				if($li1->getWeek()->getWeekName()==$li2->getWeek()->getWeekName()){
					if(($li1->getDayStudy()==$li2->getDayStudy())&&$li1->getKipStudy()->getTimeStart()->format('H:i') == $li2->getKipStudy()->getTimeStart()->format('H:i')){
						return true;
					}
				}
				
			}

		}
	}
	return false;
}

