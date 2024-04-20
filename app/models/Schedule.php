<?php

require_once("KipStudy.php");

class Schedule {
  private int $scheduleId;  // Unique identifier for the schedule entry
  private KipStudy $kipStudy;  // The associated study session
  private int $dayStudy; 
  private string $category;    // Day of the week for the study session (consider using an enum for weekdays)

  public function __construct(int $scheduleId, KipStudy $kipStudy, int $dayStudy, string $category) {
    $this->scheduleId = $scheduleId;
    $this->kipStudy = $kipStudy;
    $this->dayStudy = $dayStudy;
    $this->category = $category;
  }

  public function getScheduleId(): int {
    return $this->scheduleId;
  }

  public function getKipStudy(): KipStudy {
    return $this->kipStudy;
  }

  public function getDayStudy(): int {
    return $this->dayStudy;
  }
  public function getCategory(): string {
    return $this->category;
  }


  // Optional setter methods (consider adding if needed)
  public function setScheduleId(int $scheduleId): void {
    $this->scheduleId = $scheduleId;
  }

  public function setKipStudy(KipStudy $kipStudy): void {
    $this->kipStudy = $kipStudy;
  }

  // Consider using an enum for dayStudy if you need strong type checking for weekdays
  public function setDayStudy(int $dayStudy): void {
    $this->dayStudy = $dayStudy;
  }
}

