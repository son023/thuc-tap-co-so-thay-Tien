<?php
require("DAO.php");
require("../model/ClassFormal.php");
require("ModelDepartment.php");
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
  
?>