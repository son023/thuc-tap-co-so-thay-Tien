<?php
require("DAO.php");
require("ModelUser.php");
require("ModelClassCredit.php");
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
  
?>