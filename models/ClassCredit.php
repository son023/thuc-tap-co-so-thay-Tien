<?php
require_once("Subject.php");
require_once("User.php");
require_once("Schedule.php");

class ClassCredit {
  private int $classCreditId;
  private string $classCreditName;
  private Subject $subject;
  private int $groupClass;
  private   $listSchedule;
  private $gvMax;
  private $tgMax;
  private $svMax;

  


  public function __construct(int $classCreditId,
      $classCreditName, $subject, $groupClass, $listSchedule,$gvMax=0,
      $tgMax=0, $svMax=0) {
    $this->classCreditId = $classCreditId;
    $this->classCreditName = $classCreditName;
    $this->subject = $subject;
    $this->groupClass = $groupClass;
    $this->listSchedule = $listSchedule;
    $this->gvMax = $gvMax;
    $this->tgMax = $tgMax;
    $this->svMax = $svMax;
    
  }
  public function getGvMax() {
    return $this->gvMax;
  }
  public function getTgMax() {
    return $this->tgMax;
  }
  public function getSvMax() {
    return $this->svMax;
  }

  public function getClassCreditId() {
    return $this->classCreditId;
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

  public function getListSchedule() {
    return $this->listSchedule;
  }

  
}
?>