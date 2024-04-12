<?php
include 'app/repositories/employeeRepository.php';
class EmployeeController{
    public function index(){
        $employeRepo = new employeeRepository();
        $employees = $employeRepo->getAllEmployees();
        include("app/views/employees.php");
    }

    public function detail(){
        $id=$_GET['id'];
        $employee = new Employee($id,'','','');
        $emRepo = new employeeRepository();
        $emDetail = $emRepo->getDetail($employee);
        include("app/views/employees.php");
    }


    public function add(){
        if(isset($_POST['txtName'])){
            $name = $_POST['txtName'];
        }
        if(isset($_POST['txtAddress'])){
            $address = $_POST['txtAddress'];

        }
        if(isset($_POST['txtSalary'])) {
            $salary = $_POST['txtSalary'];

        }
        $employee = new Employee('',$name,$address,$salary);
        $emRepo = new employeeRepository();
        if ($emRepo->addEmployee($employee)){
            header('location:index.php?c=employee&a=index&success=add');

        }else {
            header('location:index.php?c=employee&a=index&success=false');

        }
    }

    public function edit(){

        if(isset($_POST['txtId'])){
            $id = $_POST['txtId'];
        }
        if(isset($_POST['txtName'])){
            $name = $_POST['txtName'];
        }
        if(isset($_POST['txtAddress'])){
            $address = $_POST['txtAddress'];

        }
        if(isset($_POST['txtSalary'])) {
            $salary = $_POST['txtSalary'];

        }
        $employee = new Employee($id,$name,$address,$salary);
        $emRepo = new employeeRepository();
        if ($emRepo->editEmployee($employee)){
            header('location:index.php?c=employee&a=index&success=save');

        }else {
            header('location:index.php?c=employee&a=index&success=false');

        }
    }

    public function delete(){
        if(isset($_POST['txtId'])){
            $id = $_POST['txtId'];
        }
        $employee = new Employee($id,'','','');
        $emRepo = new employeeRepository();
        if ($emRepo->deleteEmployee($employee)){
            header('location:index.php?c=employee&a=index&success=delete');

        }else {
            header('location:index.php?c=employee&a=index&success=false');

        }
    }
}