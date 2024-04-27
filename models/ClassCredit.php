<?php
require_once("Subject.php");
require_once("User.php");
require_once("ListSchedule.php");

class ClassCredit {
  private int $classCreditId;
  private string $classCreditName;
  private Subject $subject;
  private int $groupClass;
  private  ListSchedule $listSchedule;

  


  public function __construct(int $classCreditId,
      $classCreditName, $subject, $groupClass, $listSchedule
  ) {
    $this->classCreditId = $classCreditId;
    $this->classCreditName = $classCreditName;
    $this->subject = $subject;
    $this->groupClass = $groupClass;
  
    $this->listSchedule = $listSchedule;
    
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