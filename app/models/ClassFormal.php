<?php
require_once("Department.php");
class ClassFormal {
  private int $classFormalId;
  private int $classNumber;  // Đã sửa tên biến thành classNumber
  private Department $department;
  private int $classCourse;

  public function __construct(
      int $classFormalId, 
      int $classNumber, 
      Department $department, 
      int $classCourse
  ) {
    $this->classFormalId = $classFormalId;
    $this->classNumber = $classNumber;
    $this->department = $department;
    $this->classCourse = $classCourse;
  }

  public function getClassFormalId(): int {
    return $this->classFormalId;
  }

  public function getClassNumber(): int {  // Đã sửa tên hàm thành getClassNumber
    return $this->classNumber;
  }

  public function getDepartment(): Department {
    return $this->department;
  }

  public function getClassCourse(): int {
    return $this->classCourse;
  }
}

?>
