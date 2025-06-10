<?php
namespace App\Controllers;

use vendor\Controller;
use vendor\DB;
use App\Models\Employee as EmployeeModel;

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
        return $this->employeeModel->newUser($name, $password, $JoinDate, $address, $email, $phone);
    }

    public function removeUser() {
        $name = $_POST['name'];
        return $this->employeeModel->removeUser($name);
    }
    public function updateUser() {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $JoinDate = $_POST['JoinDate'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        return $this->employeeModel->updateUser($name, $password, $JoinDate, $address, $email, $phone);
    }
}


?>