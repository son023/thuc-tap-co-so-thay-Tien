<?php
require("DAO.php");
require("ModelUser.php");
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
  
?>