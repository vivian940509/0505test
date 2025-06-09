<?php
namespace Models;
use Vendor\DB;


class Employee extends Controller
{
    private $employeeModel;
    
    public function __construct() {
        $this->employeeModel = new EmployeeModel();
    }
    
    public function getUsers() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            return $this->employeeModel->getUser($id);
        }
        return $this->employeeModel->getUsers();

    }
    
    public function newUser(){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $JoinDate = $_POST['JoinDate'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        return $this->employeeModel->newUser($name, $password, $JoinDate,$address, $email, $phone);
    }

    public function removeUser() {
        $id = $_POST['name'];
        return $this->em->removeUser($name);
    }
    public function updateUser() {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $JoinDate = $_POST['JoinDate'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        return $this->em->updateUser($name, $password, $JoinDate,$address, $email, $phone);
    }
}


?>