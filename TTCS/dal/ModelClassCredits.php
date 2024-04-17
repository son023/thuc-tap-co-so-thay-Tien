<?php
require("DAO.php");
require("ModelSchedule.php");
require("ModelSubject.php");
require("ModelClassRoom.php");

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
                    $result["time_start"],
                    $result["time_end"]
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
          $sql = "INSERT INTO class_credits (class_credit_name, subject_id, group_class, schedule_id, class_room_id,time_start,time_end) VALUES (?, ?, ?, ?, ?, ?,?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1,$classCredit->getClassCreditName(), PDO::PARAM_STR);
          $stmt->bindParam(2, $classCredit->getSubject()->getSubjectId(), PDO::PARAM_INT);
          $stmt->bindParam(3,$classCredit->getGroupClass(), PDO::PARAM_INT);
          $stmt->bindParam(4, $classCredit->getSchedule()->getScheduleId() , PDO::PARAM_INT);
          $stmt->bindParam(5,$classCredit->getClassRoom()->getClassRoomId(), PDO::PARAM_INT);
          $stmt->bindParam(3,$classCredit->getTimeStart(), PDO::PARAM_STR);
          $stmt->bindParam(3,$classCredit->getTimeEnd(), PDO::PARAM_STR);
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
        $sql = "UPDATE class_credits SET class_credit_name = ?, subject_id = ?, group_class = ?, schedule_id = ?, class_room_id = ?,time_start = ?,time_end = ? WHERE class_credit_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1,$classCredit->getClassCreditName(), PDO::PARAM_STR);
        $stmt->bindParam(2, $classCredit->getSubject()->getSubjectId(), PDO::PARAM_INT);
        $stmt->bindParam(3,$classCredit->getGroupClass(), PDO::PARAM_INT);
        $stmt->bindParam(4, $classCredit->getSchedule()->getScheduleId() , PDO::PARAM_INT);
        $stmt->bindParam(5,$classCredit->getClassRoom()->getClassRoomId(), PDO::PARAM_INT);
        $stmt->bindParam(6,$classCredit->getTimeStart(), PDO::PARAM_STR);
        $stmt->bindParam(7,$classCredit->getTimeEnd(), PDO::PARAM_STR);
        $stmt->bindParam(8,$classCredit->getClassCreditId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  
?>