<?php
require("DAO.php");
require("../model/ClassRoom.php");
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
  
?>