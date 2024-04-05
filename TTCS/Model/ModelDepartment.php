<?php
require("DAO.php");
require("Class/Department.php");
class ModelDepartment extends DAO {

    public function getById(int $uid): Object {
        $sql = "SELECT * FROM departments WHERE department_id = ?";
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
                return new Department(
                  $result['department_id'],
                  $result['department_code'],
                  $result['department_name'],
                );
                
            } 
        } 
        catch (PDOException $e) {
            // 7. Xử lý lỗi cơ sở dữ liệu tiềm ẩn
            echo "Lỗi: " . $e->getMessage();
            return new Department(0,'1','2');
        }

    }
    public function addObject(Object $object):bool{
        try {
          if ($object instanceof Department) {
            $department = $object;
          }
          $sql = "INSERT INTO departments(department_code,department_name) VALUES (?, ?)";
          $stmt =$this->link->prepare($sql);
          $stmt->bindParam(1, $department->getDepartmentCode(), PDO::PARAM_STR);
          $stmt->bindParam(2,$department->getDepartmentName(), PDO::PARAM_STR);
          $stmt->execute();
          return true;
        } catch (PDOException $e) {
          return false;
        }
      

    }
    public function deleteObject(int $objectid):bool{
      try {
        $sql = "DELETE FROM departments WHERE department_id = ?";
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
        if ($object instanceof Department) {
          $department = $object;
        }
        $sql = "UPDATE departments SET department_code = ?, department_name = ? WHERE department_id = ?";
        $stmt = $this->link->prepare($sql);
        $stmt->bindParam(1, $department->getDepartmentCode(), PDO::PARAM_STR);
        $stmt->bindParam(2, $department->getDepartmentName(), PDO::PARAM_STR);
        $stmt->bindParam(3, $department->getDepartmentId(),PDO::PARAM_INT);
        $stmt->execute();
        return true;
      } catch (PDOException $e) {
        return false;
      }
    }
  }
  
?>