<?php
include 'app/models/Employee.php';
include 'config/config.php';
class employeeRepository {
    public function getAllEmployees(){
        try{
            $db = new Database();
            $conn = $db->getConnection();
            $sql = 'select * from employees';
            $stmt=$conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            $employees = [];
            foreach ($result as $row){
                $employee = new Employee($row['id'],$row['name'],$row['address'],$row['salary']);
                $employees[]= $employee;
            }
            return $employees;
        }catch (PDOException $e){
            return null;
        }

    }

    public function getDetail($employee){
        try{
            $db = new Database();
            $conn = $db->getConnection();
            $sql = 'select * from employees where id=?';
            $stmt=$conn->prepare($sql);
            $id = $employee->getId();
            $stmt->bindParam(1,$id,PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
            $em = new Employee($result['id'],$result['name'],$result['address'],$result['salary']);
            return $em;
        }catch (PDOException $e){
            return null;
        }

    }

    public function addEmployee($employee){
        try{
            $db = new Database();
            $conn = $db->getConnection();
            $sql = 'insert into employees (name, address , salary) values (?,?,?)';
            $stmt=$conn->prepare($sql);
            $name = $employee->getName();
            $address = $employee->getAddress();
            $salary = $employee->getSalary();
            $stmt->bindParam(1,$name,PDO::PARAM_STR);
            $stmt->bindParam(2,$address,PDO::PARAM_STR);
            $stmt->bindParam(3,$salary,PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }

        }catch (PDOException $e){
            return false;
        }
    }

    public function editEmployee($employee){
        try{
            $db = new Database();
            $conn = $db->getConnection();
            $sql = 'UPDATE employees SET name = ?, address=?, salary = ?  WHERE id='.$employee->getId();
            $stmt=$conn->prepare($sql);
            $name = $employee->getName();
            $address = $employee->getAddress();
            $salary = $employee->getSalary();
            $stmt->bindParam(1,$name,PDO::PARAM_STR);
            $stmt->bindParam(2,$address,PDO::PARAM_STR);
            $stmt->bindParam(3,$salary,PDO::PARAM_INT);

            if($stmt->execute()){
                return true;
            }

        }catch (PDOException $e){
            return false;
        }
    }
    public function deleteEmployee($employee){
        try{
            $db = new Database();
            $conn = $db->getConnection();
            $sql = 'DELETE FROM employees WHERE id='.$employee->getId();
            $stmt=$conn->prepare($sql);
            if($stmt->execute()){
                return true;
            }

        }catch (PDOException $e){
            return false;
        }
    }
}
