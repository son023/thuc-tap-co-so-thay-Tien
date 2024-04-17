<?php

include("KipStudy.php");

class Schedule {
  private int $scheduleId;  // Unique identifier for the schedule entry
  private KipStudy $kipStudy;  // The associated study session
  private int $dayStudy;     // Day of the week for the study session (consider using an enum for weekdays)

  public function __construct(int $scheduleId, KipStudy $kipStudy, int $dayStudy) {
    $this->scheduleId = $scheduleId;
    $this->kipStudy = $kipStudy;
    $this->dayStudy = $dayStudy;
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

