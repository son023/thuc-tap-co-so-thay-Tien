<?php
require("DAO.php");
require("../model/KipStudy.php");
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
  
?>