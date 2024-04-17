<?php
require("DAO.php");
require("../model/User.php");
require("ModelClassFormal.php");
class ModelUser extends DAO {


    public function getByUserName(int $uid): Object {
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