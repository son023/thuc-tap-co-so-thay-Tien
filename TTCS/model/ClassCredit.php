<?php
require_once("Subject.php");
require_once("User.php");
require_once("Schedule.php");
require_once("ClassRoom.php");
class ClassCredit {
  private int $classCreditId;
  private string $classCreditName;
  private Subject $subject;
  private int $groupClass;
  private Schedule $schedule;
  private ClassRoom $classRoom;
  private DateTime $timeStart;
  private DateTime $timeEnd;


  public function __construct(int $classCreditId,
      $classCreditName, $subject, $groupClass, $schedule, $classRoom,$timeStart,  $timeEnd
  ) {
    $this->classCreditId = $classCreditId;
    $this->classCreditName = $classCreditName;
    $this->subject = $subject;
    $this->groupClass = $groupClass;
    $this->schedule = $schedule;
    $this->classRoom = $classRoom;
    $this->timeStart = $timeStart;
    $this->timeEnd = $timeEnd;
  }

  public function getClassCreditId() {
    return $this->classCreditId;
  }
  public function getTimeStart() {
    return $this->timeStart;
  }
  public function getTimeEnd() {
    return $this->timeEnd;
  }

  public function getClassCreditName() {
    return $this->classCreditName;
  }

  public function getSubject() {
    return $this->subject;
  }
  public function getGroupClass() {
    return $this->groupClass;
  }

  public function getSchedule() {
    return $this->schedule;
  }

  public function getClassRoom() {
    return $this->classRoom;
  }
}
?>