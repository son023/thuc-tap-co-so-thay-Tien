<?php

class Week {

    private $weekId;
    private $weekName;
    private $startTime;
    private $endTime;

    // Constructor (optional for flexibility)
    public function __construct($weekId = null, $weekName = null, $startTime = null, $endTime = null) {
        $this->weekId = $weekId;
        $this->weekName = $weekName;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    // Getters and Setters
    public function getWeekId() {
        return $this->weekId;
    }

    public function setWeekId($weekId) {
        $this->weekId = $intVal($weekId); // Ensure integer for auto-increment compatibility
    }

    public function getWeekName() {
        return $this->weekName;
    }

    public function setWeekName($weekName) {
        $this->weekName = $weekName;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }
}
?>