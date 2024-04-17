<?php
require("DAO.php");
require("ModelUser.php");
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
  
?>