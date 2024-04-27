<?php
require_once("Schedule.php");
class ListSchedule {
    private $listScheduleId;
    private  $listScheduleCode;
    private  $listSchedule ;

    public function __construct($listScheduleId, $listScheduleCode ,  $listSchedule) {
        $this->listScheduleId = $listScheduleId;
        $this->listScheduleCode = $listScheduleCode;
        $this->listSchedule = $listSchedule;
    }

    public function getListScheduleId() {
        return $this->listScheduleId;
    }

    public function getListScheduleCode() {
        return $this->listScheduleCode;
    }
    public function getSchedule() {
        return $this->listSchedule;
    }
  
}
?>