<?php
require("DAO.php");
require("../model/SubjectSemester.php");
require("ModelDepartment.php");
require("ModelSubject.php");

class ModelSubjectSemester extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM subject_semesters WHERE subject_semester_id = ?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $uid, PDO::PARAM_INT);   
            $stmt->execute(); 
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
            if ($result) {
                $modelDepartment=new ModelDepartment();
                $department = $modelDepartment->getById($result["department_id"]);
                $modelSubject= new ModelSubject();
                $subject=$modelSubject->GetById($result["subject_id"]);
                return new SubjectSemester(
                  $result['subject_semester_id'],
                  $result['subject_semester_name'],
                  $subject,
                  $department
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }

    }
    public function getByNameAndDepartment(int $name, int $departmentCode): array {
        $sql = "SELECT * FROM subject_semesters WHERE subject_semester_name = ? and department_code=?";
        try {
            $stmt = $this->link->prepare($sql);
            $stmt->bindParam(1, $name, PDO::PARAM_INT);   
            $stmt->bindParam(2, $departmentCode, PDO::PARAM_INT);
            $stmt->execute();   
            $list=[];  
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $modelDepartment=new ModelDepartment();
                $department = $modelDepartment->getById($result["department_id"]);
                $modelSubject= new ModelSubject();
                $subject=$modelSubject->GetById($result["subject_id"]);
                
                array_push($list, new SubjectSemester(
                  $result['subject_semester_id'],
                  $result['subject_semester_name'],
                  $subject,
                  $department ));
                
            } 
            return $list;
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
           
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof SubjectSemester) {
            $subject = $object;
          }
          $sql = "INSERT INTO subject_semesters(subject_semester_name,subject_id,department_id) VALUES (?, ?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $subject->getSubjectSemesterName(), PDO::PARAM_INT);
          $stmt->bindParam(2,  $subject->getSubject()->getSubjectId(), PDO::PARAM_INT);
          $stmt->bindParam(1, $subject->GetDepartment()->getDepartmentId() , PDO::PARAM_INT);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM subject_semesters WHERE subject_semester_id = ?";
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
        if ($object instanceof SubjectSemester) {
            $subject  = $object;
        }
        $sql = "UPDATE subject_semesters SET subject_semester_name = ?, subject_id = ?,department_id = ? WHERE subject_semester_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $subject->getSubjectSemesterName(), PDO::PARAM_INT);
        $stmt->bindParam(2,  $subject->getSubject()->getSubjectId(), PDO::PARAM_INT);
        $stmt->bindParam(1, $subject->GetDepartment()->getDepartmentId() , PDO::PARAM_INT);
        $stmt->bindParam(2,  $subject->getSubjectSemesterId(), PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  
?>