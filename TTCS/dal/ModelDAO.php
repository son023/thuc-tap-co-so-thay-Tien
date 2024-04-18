<?php
require_once("DAO.php");
require_once("../model/Department.php");
require_once("../model/ClassRoom.php");
require_once("../model/ClassCredit.php");
require_once("../model/ClassFormal.php");
require_once("../model/Email.php");
require_once("../model/KipStudy.php");
require_once("../model/PhoneNumber.php");
require_once("../model/Register.php");
require_once("../model/Schedule.php");
require_once("../model/Subject.php");
require_once("../model/SubjectSemester.php");
require_once("../model/User.php");
class ModelDepartment extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM departments WHERE department_id = ?";
        try {
        // 2. Chuẩn bị câu lệnh sử dụng PDO
            $stmt = $this->link->prepare($sql);
            // 3. Gắn tham số một cách an toàn (ngăn chặn SQL injection)
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            // 4. Thực thi câu lệnh
            $stmt->execute(); 
            // 5. Lấy kết quả dưới dạng mảng kết hợp
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                return new Department(
                  $result['department_id'],
                  $result['department_code'],
                  $result['department_name'],
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
            return new Department(0,'1','2');
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof Department) {
            $department = $object;
          }
          $sql = "INSERT INTO departments(department_code,department_name) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $department->getDepartmentCode(), PDO::PARAM_STR);
          $stmt->bindParam(2,$department->getDepartmentName(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM departments WHERE department_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof Department) {
          $department = $object;
        }
        $sql = "UPDATE departments SET department_code = ?, department_name = ? WHERE department_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $department->getDepartmentCode(), PDO::PARAM_STR);
        $stmt->bindParam(2, $department->getDepartmentName(), PDO::PARAM_STR);
        $stmt->bindParam(3, $department->getDepartmentId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }



  class ModelClassRoom extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM class_rooms WHERE class_room_id = ?";
        try {
    
            $stmt = $this->link->prepare($sql);         
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);          
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                return new ClassRoom(
                  $result['class_room_id'],
                  $result['class_room_name'],
                  $result['building'],
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof ClassRoom) {
            $classRoom = $object;
          }
          $sql = "INSERT INTO class_rooms(class_room_name,building) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1,  $classRoom ->getClassRoomName(), PDO::PARAM_STR);
          $stmt->bindParam(2,  $classRoom ->getBuilding(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM class_rooms WHERE class_room_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof ClassRoom) {
            $classRoom  = $object;
        }
        $sql = "UPDATE class_rooms SET class_room_name = ?, building = ? WHERE class_room_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1,  $classRoom ->getClassRoomName(), PDO::PARAM_STR);
          $stmt->bindParam(2,  $classRoom ->getBuilding(), PDO::PARAM_STR);
        $stmt->bindParam(3, $classRoom->getClassRoomId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }



   
   
  class ModelClassCredit extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM class_credits WHERE class_credit_id = ?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelSchedule= new ModelSchedule();
                $schedule= $modelSchedule->getById($result["schedule_id"]);
                $modelSubject= new ModelSubject();
                $subject=$modelSubject->GetById($result["subject_id"]);
                $modelClassRoom= new ModelClassRoom();
                $classRoom=$modelClassRoom->GetById($result["class_room_id"]);
                return new ClassCredit(
                    $result["class_credit_id"],
                    $result["class_credit_name"],
                    $subject,
                    $result["group_class"],
                    $schedule,
                    $classRoom,
                    $result["class_credit_code"],
                   
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof ClassCredit) {
            $classCredit = $object;
          }
          $sql = "INSERT INTO class_credits (class_credit_name, subject_id, group_class, schedule_id, class_room_id,class_credit_code) VALUES (?, ?, ?, ?, ?, ?,?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1,$classCredit->getClassCreditName(), PDO::PARAM_STR);
          $stmt->bindParam(2, $classCredit->getSubject()->getSubjectId(), PDO::PARAM_INT);
          $stmt->bindParam(3,$classCredit->getGroupClass(), PDO::PARAM_INT);
          $stmt->bindParam(4, $classCredit->getSchedule()->getScheduleId() , PDO::PARAM_INT);
          $stmt->bindParam(5,$classCredit->getClassRoom()->getClassRoomId(), PDO::PARAM_INT);
          $stmt->bindParam(6,$classCredit->getClassCreditCode(), PDO::PARAM_INT);
         
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM class_credits WHERE class_credit_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
        try {
            if ($object instanceof ClassCredit) {
              $classCredit = $object;
            }
        $sql = "UPDATE class_credits SET class_credit_name = ?, subject_id = ?, group_class = ?, schedule_id = ?, class_room_id = ?,class_credit_code=?  WHERE class_credit_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1,$classCredit->getClassCreditName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $classCredit->getSubject()->getSubjectId(), PDO::PARAM_INT);
        $stmt->bindParam(3,$classCredit->getGroupClass(), PDO::PARAM_INT);
        $stmt->bindParam(4, $classCredit->getSchedule()->getScheduleId() , PDO::PARAM_INT);
        $stmt->bindParam(5,$classCredit->getClassRoom()->getClassRoomId(), PDO::PARAM_INT);
        $stmt->bindParam(6,$classCredit->getClassCreditCode(), PDO::PARAM_INT);
        $stmt->bindParam(7,$classCredit->getClassCreditId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  



  class ModelClassFormal extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM class_formals WHERE class_formal_id = ?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelDepartment=new ModelDepartment;
                $department = $modelDepartment->getById($result["department_id"]);
                return new ClassFormal(
                  $result['class_formal_id'],
                  $result['class_number'],
                  $department,
                  $result['class_course'],
                );
                
            } 
        } 
        catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
     
           
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof  ClassFormal) {
            $classFormal = $object;
          }
          $sql = "INSERT INTO class_formals(class_number,department_id,class_course) VALUES (?, ?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $classFormal->getClassNumber() , PDO::PARAM_INT);
          $stmt->bindParam(2, $classFormal->getDepartment()->getDepartmentId(), PDO::PARAM_INT);
          $stmt->bindParam(3, $classFormal->getClassCourse(), PDO::PARAM_INT);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM class_formals WHERE class_formal_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
        try {
            if ($object instanceof  ClassFormal) {
              $classFormal = $object;
            }
        $sql = "UPDATE class_formals SET class_number = ?, department_id = ?, class_course = ? WHERE class_formal_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $classFormal->getClassNumber(), PDO::PARAM_INT);
        $stmt->bindParam(2, $classFormal->getDepartment()->getDepartmentId(), PDO::PARAM_INT);
        $stmt->bindParam(3, $classFormal->getClassCourse(), PDO::PARAM_INT);
        $stmt->bindParam(4, $classFormal->getClassFormalId(), PDO::PARAM_INT);

        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }

  class ModelEmail extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM emails WHERE email_id = ?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $uiad, PDO::PARAM_INT);   
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelUser= new ModelUser();
                $user= $modelUser->getById($result["user_id"]);
                return new Email(
                  $result['email_id'],
                  $user,
                  $result['email'],
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof Email) {
            $email = $object;
          }
          $sql = "INSERT INTO emails(user_id,email) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1,  $email->getUser()->getUserId(), PDO::PARAM_INT);
          $stmt->bindParam(2, $email->getEmail(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM emails WHERE email_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof Email) {
          $email = $object;
        }
        $sql = "UPDATE emails SET user_id = ?, email = ? WHERE email_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1,  $email->getUser()->getUserId(), PDO::PARAM_INT);
          $stmt->bindParam(2, $email->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(3,$email->getEmailId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }

  class ModelKipStudy extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM kip_studys WHERE kip_study_id = ?";
        try {
        // 2. Chuẩn bị câu lệnh sử dụng PDO
            $stmt = $this->link->prepare($sql);
            // 3. Gắn tham số một cách an toàn (ngăn chặn SQL injection)
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            // 4. Thực thi câu lệnh
            $stmt->execute(); 
            // 5. Lấy kết quả dưới dạng mảng kết hợp
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                return new KipStudy(
                  $result['kip_study_id'],
                  $result['time_start'],
                  $result['time_study'],
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
     
           
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof KipStudy) {
            $kipStudy = $object;
          }
          $sql = "INSERT INTO kip_studys(time_start,time_study) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1,  $kipStudy->getTimeStart(), PDO::PARAM_STR);
          $stmt->bindParam(2, $kipStudy->getTimeStudy(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM kip_studys WHERE kip_study_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof KipStudy) {
          $kipStudy = $object;
        }
        $sql = "UPDATE kip_studys SET time_start = ?, time_study = ? WHERE kip_study_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1,  $kipStudy->getTimeStart(), PDO::PARAM_STR);
        $stmt->bindParam(2, $kipStudy->getTimeStudy(), PDO::PARAM_STR);
        $stmt->bindParam(3,$kipStudy->getKipStudyId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  

  class ModelPhoneNumber extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM phone_numbers WHERE phone_number_id = ?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelUser= new ModelUser();
                $user= $modelUser->getById($result["user_id"]);
                return new PhoneNumber(
                  $result['phone_number_id'],
                  $user,
                  $result['phone_number'],
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof PhoneNumber) {
            $email = $object;
          }
          $sql = "INSERT INTO phone_numbers(user_id,phone_number) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $email->getUser()->getUserId(), PDO::PARAM_INT);
          $stmt->bindParam(2, $email->getPhoneNumberId(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM phone_numbers WHERE phone_number_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof PhoneNumber) {
          $email = $object;
        }
        $sql = "UPDATE phone_numbers SET user_id = ?, phone_number = ? WHERE phone_number_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1,  $email->getUser()->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $email->getPhoneNumber(), PDO::PARAM_STR);
        $stmt->bindParam(3,$email->getPhoneNumberId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  class ModelRegister extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM registers WHERE register_id = ?";
        try {
        // 2. Chuẩn bị câu lệnh sử dụng PDO
            $stmt = $this->link->prepare($sql);
            // 3. Gắn tham số một cách an toàn (ngăn chặn SQL injection)
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            // 4. Thực thi câu lệnh
            $stmt->execute(); 
            // 5. Lấy kết quả dưới dạng mảng kết hợp
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelUser= new ModelUser();
                $user= $modelUser->getById($result["user_id"]);
                $modelClassCredit= new ModelClassCredit();
                $classCredit= $modelClassCredit->getById($result["class_credit_id"]);
                return new Register(
                  $result['register_id'],
                  $classCredit,
                  $user,
                  $result['register_time']
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
     
           
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof Register) {
            $register = $object;
          }
          $sql = "INSERT INTO registers (class_credit_id, user_id, register_time) VALUES (?, ?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1,  $register->getClassCredit()->getClassCreditId(), PDO::PARAM_INT);
          $stmt->bindParam(2, $register->getUser()->getUserId(), PDO::PARAM_INT);
          $stmt->bindParam(3, $register->getRegisterTime(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM registers WHERE register_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof Register) {
            $register = $object;
          }
        $sql = "UPDATE registers SET class_credit_id = ?, user_id  = ?, register_time = ? WHERE register_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1,  $register->getClassCredit()->getClassCreditId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $register->getUser()->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(3, $register->getRegisterTime(), PDO::PARAM_STR);
        $stmt->bindParam(4, $register->getRegisterId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  class ModelWeek extends DAO{
    public function getById(int $uid): Object {
      $sql = "SELECT * FROM weeks WHERE week_id = ?";
      try {
          $stmt = $this->link->prepare($sql);
          $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
          $stmt->execute(); 
          $result = $stmt->fetch(PDO::FETCH_ASSOC);  
          if ($result) {
             
              return new Week(
                  $result["week_id"],
                  $result["week_name"],
                  $result["start_time"],
                $result['end_time']
              );
              
          } 
      } 
      catch (PDOException $e) {
          // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
          echo "Lỗi: " . $e->getMessage();
      }

  }
  public function addObject(Object $object):bool{
      try {
        if ($object instanceof Week) {
          $week = $object;
        }
        $sql = "INSERT INTO weeks(week_id,week_name,start_time,end_time) VALUES (?, ?, ?, ?)";
        $stmt =$this->link->prepare($sql);
        $stmt->bindParam(1,$week->getWeekId(), PDO::PARAM_INT);
        $stmt->bindParam(2,$week->getWeekName(), PDO::PARAM_INT);
        $stmt->bindParam(3,$week->getStartTime(), PDO::PARAM_STR);
        $stmt->bindParam(4,$week->getEndTime(), PDO::PARAM_STR);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    

  }
  public function deleteObject(int $objectid):bool{
    try {
      $sql = "DELETE FROM weeks WHERE week_id = ?";
      $stmt = $this->link->prepare($sql);
      $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
      $stmt->execute();
      return true;
     
    } catch (PDOException $e) {
      echo "". $e->getMessage();
      return false;
    }
  }
  public function updateObject($object):bool{
    
    return false;
  
}
  }
  class ModelSchedule extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM schedules WHERE schedule_id = ?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelKipstudy= new ModelKipStudy();
                $kipStudy= $modelKipstudy->getById($result["kip_study_id"]);
                return new Schedule(
                  $result["schedule_id"],
                  $kipStudy,
                  $result['day_study'],
                  $result['category']
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof Schedule) {
            $schedule = $object;
          }
          $sql = "INSERT INTO schedules(kip_study_id,day_study,category) VALUES (?, ?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $schedule->getKipStudy()->getKipStudyId(), PDO::PARAM_INT);
          $stmt->bindParam(2, $schedule->getDayStudy(), PDO::PARAM_INT);
          $stmt->bindParam(3, $schedule->getCategory(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM schedules WHERE schedule_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
        try {
            if ($object instanceof Schedule) {
              $schedule = $object;
            }
        $sql = "UPDATE schedules SET kip_study_id = ?, day_study = ?, category= ? WHERE schedule_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $schedule->getKipStudy()->getKipStudyId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $schedule->getDayStudy(), PDO::PARAM_INT);
        $stmt->bindParam(3, $schedule->getCategory(), PDO::PARAM_STR);
        $stmt->bindParam(4,$schedule->getScheduleId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  class ModelSubject extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM subjects WHERE subject_id = ?";
        try {
        // 2. Chuẩn bị câu lệnh sử dụng PDO
            $stmt = $this->link->prepare($sql);
            // 3. Gắn tham số một cách an toàn (ngăn chặn SQL injection)
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            // 4. Thực thi câu lệnh
            $stmt->execute(); 
            // 5. Lấy kết quả dưới dạng mảng kết hợp
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                return new Subject(
                  $result['subject_id'],
                  $result['subject_code'],
                  $result['subject_name'],
                  $result['credit '],
                  $result['price_credit']
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof Subject) {
            $subject = $object;
          }
          $sql = "INSERT INTO subjects(subject_code,subject_name,credit, price_credit) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $subject->getSubjectCode(), PDO::PARAM_STR);
          $stmt->bindParam(2,  $subject->getSubjectName(), PDO::PARAM_STR);
          $stmt->bindParam(1, $subject->getCredit(), PDO::PARAM_INT);
          $stmt->bindParam(2,  $subject->getPriceCredit(), PDO::PARAM_INT);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM subjects WHERE subject_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof Subject) {
            $subject  = $object;
        }
        $sql = "UPDATE subjects SET subject_code = ?, subject_name = ?,credit = ?, price_credit = ? WHERE subject_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $subject->getSubjectCode(), PDO::PARAM_STR);
        $stmt->bindParam(2,  $subject->getSubjectName(), PDO::PARAM_STR);
        $stmt->bindParam(1, $subject->getCredit(), PDO::PARAM_INT);
        $stmt->bindParam(2,  $subject->getPriceCredit(), PDO::PARAM_INT);
        $stmt->bindParam(3, $subject->getSubjectId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  class ModelSubjectSemester extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM subject_semesters WHERE subject_semester_id = ?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelDepartment=new ModelDepartment();
                $department = $modelDepartment->getById($result["department_id"]);
                $modelSubject= new ModelSubject();
                $subject=$modelSubject->GetById($result["subject_id"]);
                return new SubjectSemester(
                  $result['subject_semester_id'],
                  $result['subject_semester_name'],
                  $subject,
                  $department
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }

    }
    public function getByNameAndDepartment(int $name, int $departmentCode): array {
        $sql = "SELECT * FROM subject_semesters WHERE subject_semester_name = ? and department_code=?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $name, PDO::PARAM_INT);   
            $stmt->bindParam(2, $departmentCode, PDO::PARAM_INT);
            $stmt->execute();   
            $list=[];  
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $modelDepartment=new ModelDepartment();
                $department = $modelDepartment->getById($result["department_id"]);
                $modelSubject= new ModelSubject();
                $subject=$modelSubject->GetById($result["subject_id"]);
                
                array_push($list, new SubjectSemester(
                  $result['subject_semester_id'],
                  $result['subject_semester_name'],
                  $subject,
                  $department ));
                
            } 
            return $list;
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof SubjectSemester) {
            $subject = $object;
          }
          $sql = "INSERT INTO subject_semesters(subject_semester_name,subject_id,department_id) VALUES (?, ?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $subject->getSubjectSemesterName(), PDO::PARAM_INT);
          $stmt->bindParam(2,  $subject->getSubject()->getSubjectId(), PDO::PARAM_INT);
          $stmt->bindParam(1, $subject->GetDepartment()->getDepartmentId() , PDO::PARAM_INT);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM subject_semesters WHERE subject_semester_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function updateObject($object):bool{
      try {
        if ($object instanceof SubjectSemester) {
            $subject  = $object;
        }
        $sql = "UPDATE subject_semesters SET subject_semester_name = ?, subject_id = ?,department_id = ? WHERE subject_semester_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $subject->getSubjectSemesterName(), PDO::PARAM_INT);
        $stmt->bindParam(2,  $subject->getSubject()->getSubjectId(), PDO::PARAM_INT);
        $stmt->bindParam(1, $subject->GetDepartment()->getDepartmentId() , PDO::PARAM_INT);
        $stmt->bindParam(2,  $subject->getSubjectSemesterId(), PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }

  class ModelUser extends DAO {


    public function getByUserName(int $uid): User {
        $sql = "SELECT * FROM  users WHERE user_name = ?";
        try {
    
            $stmt = $this->link->prepare($sql);         
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);          
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelClassFormal=new ModelClassFormal();
                $classFormal = $modelClassFormal->getById($result["class_formal_id"]);
                return new User(
                  $result['user_id'],
                  $classFormal,
                  $result['user_name'],
                  $result['pass_word'],
                  $result['full_name'],
                  $result['teacher_id'],
                  $result['user_role'],
                  $result['status'],
                  $result['date_of_birth'],
                  $result['gender'],
                  $result['brithplace'],
                  $result['current_address'],
                  $result['avatar_image_path'],
                  $result['link_social'],
                  $result['description_text'],      
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }

    }
    public function getById(int $uid): Object {
      $sql = "SELECT * FROM  users WHERE user_id = ?";
        try {
    
            $stmt = $this->link->prepare($sql);         
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);          
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelClassFormal=new ModelClassFormal();
                
                return new User(
                  $result['user_id'],
                  $modelClassFormal->getById($result["class_formal_id"]),
                  $result['user_name'],
                  $result['pass_word'],
                  $result['full_name'],
                  $result['teacher_id'],
                  $result['user_role'],
                  $result['status'],
                  $result['date_of_birth'],
                  $result['gender'],
                  $result['birthplace'],
                  $result['current_address'],
                  $result['avatar_image_path'],
                  $result['link_social'],
                  $result['description_text'],      
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }
  }
    public function addObject(Object $object):bool{
        try {
        $classFormalId = $object->getClassFormalId();
        $userName = $object->getUserName();
        $password = $object->getPassword(); 
        $fullName = $object->getFullName();
        $teacherId = $object->getTeacherId(); // Optional, can be null if not applicable
        $userRole = $object->getUserRole();  // Assuming valid role values are defined
        $status = $object->getStatus();      // Assuming valid status values are defined
        $dateOfBirth = $object->getDateOfBirth(); // Assuming date format is appropriate for storage
        $gender = $object->getGender();        // Assuming valid gender values are defined
        $birthplace = $object->getBirthplace();
        $currentAddress = $object->getCurrentAddress();
        $avatarImagePath = $object->getAvatarImagePath(); // Optional
        $linkSocial = $object->getLinkSocial();          // Optional
        $descriptionText = $object->getDescriptionText(); // Optional

        $sql = "INSERT INTO users (
            class_formal_id,
            user_name,
            pass_word,
            full_name,
            teacher_id,
            user_role,
            status,
            date_of_birth,
            gender,
            birthplace,
            current_address,
            avatar_image_path,
            link_social,
            description_text,
            password_latest,
            password_latest_time,
            login_failed
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->link->prepare($sql);

        $stmt->bindParam(1, $classFormalId, PDO::PARAM_INT);
        $stmt->bindParam(2, $userName, PDO::PARAM_STR);
        $stmt->bindParam(3, $password, PDO::PARAM_INT); // Assuming password is hashed
        $stmt->bindParam(4, $fullName, PDO::PARAM_STR);
        $stmt->bindParam(5, $teacherId, PDO::PARAM_INT); // Optional, can be null if not applicable
        $stmt->bindParam(6, $userRole, PDO::PARAM_INT);  // Assuming valid role values are defined
        $stmt->bindParam(7, $status, PDO::PARAM_INT);    // Assuming valid status values are defined
        $stmt->bindParam(8, $dateOfBirth, PDO::PARAM_STR); // Assuming date format is appropriate for storage
        $stmt->bindParam(9, $gender, PDO::PARAM_STR);     // Assuming valid gender values are defined
        $stmt->bindParam(10, $birthplace, PDO::PARAM_STR);
        $stmt->bindParam(11, $currentAddress, PDO::PARAM_STR);
        $stmt->bindParam(12, $avatarImagePath, PDO::PARAM_STR); // Optional
        $stmt->bindParam(13, $linkSocial, PDO::PARAM_STR);     // Optional
        $stmt->bindParam(14, $descriptionText, PDO::PARAM_STR); // Optional
        $stmt->bindParam(15, 0, PDO::PARAM_INT); // Optional
        $stmt->bindParam(16, 0, PDO::PARAM_INT);     // Optional
        $stmt->bindParam(17, 0, PDO::PARAM_INT); // Optional

        $stmt->execute();

        return true; 
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }
    public function deleteUserByUserName(int $objectid):bool{
      try {
        $sql = "DELETE FROM users WHERE user_name = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $objectid, PDO::PARAM_INT);
        $stmt->execute();
        return true;
       
      } catch (PDOException $e) {
        echo "". $e->getMessage();
        return false;
      }

    }


    #update user with username 
    public function updateObject($object):bool{
      try {
        if ($object instanceof User) {
            $user = $object;
        }
        $sql = "UPDATE users SET class_formal_id,
        user_name  = ?,
        pass_word  = ?,
        full_name  = ?,
        teacher_id  = ?,
        user_role  = ?,
        status  = ?,
        date_of_birth  = ?,
        gender  = ?,
        birthplace  = ?,
        current_address  = ?,
        avatar_image_path  = ?,
        link_social  = ?,
        description_text  = ?,
        password_latest  = ?,
        password_latest_time  = ?,
        login_failed = ? WHERE user_name = ?";
        $stmt = $this->link->prepare($sql);
        $classFormalId = $object->getClassFormalId();
        $userName = $object->getUserName();
        $password = $object->getPassword(); 
        $fullName = $object->getFullName();
        $teacherId = $object->getTeacherId(); // Optional, can be null if not applicable
        $userRole = $object->getUserRole();  // Assuming valid role values are defined
        $status = $object->getStatus();      // Assuming valid status values are defined
        $dateOfBirth = $object->getDateOfBirth(); // Assuming date format is appropriate for storage
        $gender = $object->getGender();        // Assuming valid gender values are defined
        $birthplace = $object->getBirthplace();
        $currentAddress = $object->getCurrentAddress();
        $avatarImagePath = $object->getAvatarImagePath(); // Optional
        $linkSocial = $object->getLinkSocial();          // Optional
        $descriptionText = $object->getDescriptionText(); // Optional
        
        $stmt->bindParam(1, $classFormalId, PDO::PARAM_INT);
        $stmt->bindParam(2, $userName, PDO::PARAM_STR);
        $stmt->bindParam(3, $password, PDO::PARAM_INT); // Assuming password is hashed
        $stmt->bindParam(4, $fullName, PDO::PARAM_STR);
        $stmt->bindParam(5, $teacherId, PDO::PARAM_INT); // Optional, can be null if not applicable
        $stmt->bindParam(6, $userRole, PDO::PARAM_INT);  // Assuming valid role values are defined
        $stmt->bindParam(7, $status, PDO::PARAM_INT);    // Assuming valid status values are defined
        $stmt->bindParam(8, $dateOfBirth, PDO::PARAM_STR); // Assuming date format is appropriate for storage
        $stmt->bindParam(9, $gender, PDO::PARAM_STR);     // Assuming valid gender values are defined
        $stmt->bindParam(10, $birthplace, PDO::PARAM_STR);
        $stmt->bindParam(11, $currentAddress, PDO::PARAM_STR);
        $stmt->bindParam(12, $avatarImagePath, PDO::PARAM_STR); // Optional
        $stmt->bindParam(13, $linkSocial, PDO::PARAM_STR);     // Optional
        $stmt->bindParam(14, $descriptionText, PDO::PARAM_STR); // Optional
        $stmt->bindParam(15, $user->getPasswordLatest(), PDO::PARAM_INT); // Optional
        $stmt->bindParam(16, $user->getPasswordLatestTime(), PDO::PARAM_INT);     // Optional
        $stmt->bindParam(17, $user->getLoginFailed(), PDO::PARAM_INT); // Optional
        $stmt->bindParam(3, $user->getUserName(),PDO::PARAM_STR);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
?>