<?php
require("DAO.php");
require("ModelKipStudy.php");
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
                  $result['day_study']
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
          $sql = "INSERT INTO schedules(kip_study_id,day_study) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $schedule->getKipStudy()->getKipStudyId(), PDO::PARAM_INT);
          $stmt->bindParam(2, $schedule->getDayStudy(), PDO::PARAM_INT);
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
        $sql = "UPDATE schedules SET kip_study_id = ?, day_study = ? WHERE schedule_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $schedule->getKipStudy()->getKipStudyId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $schedule->getDayStudy(), PDO::PARAM_INT);
        $stmt->bindParam(3,$schedule->getScheduleId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  
?>