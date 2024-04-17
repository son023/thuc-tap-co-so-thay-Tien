<?php
require("DAO.php");
require("../model/Subject.php");
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
  
?>