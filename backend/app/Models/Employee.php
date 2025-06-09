<?php
namespace Models;
use vendor\DB;

class Employee
{
    public function getUsers(){
        $sql = "SELECT * FROM user";
        $arg = NULL;
        return DB::select($sql, $arg);  
    }
    
    public function getUser($id){
        $sql = "SELECT * FROM user WHERE id = ?";
        $arg = array($id);
        return DB::select($sql, $arg);
    }
    
    public function newUser($name, $password, $email, $phone){
        $sql = "INSERT INTO user (`name`, `password`, `JoinDate`, `address` , `email`, `phone) VALUES (?, ?, ?, ?)";
        return DB::insert($sql, array($name, $password, $JoinDate, $address, $email, $phone));
    }
    
    public function removeUser($name){
        $sql = "DELETE FROM user WHERE name = ?";
        return DB::delete($sql, array($name));        
    }
    
    public function updateUser($name, $password, $email, $phone){
        $sql = "UPDATE user SET password = ?, $JoinDate, $address, $email, $phoneWHERE name = ?";
        return DB::update($sql, array($name, $password, $JoinDate, $address, $email, $phone));
    }
}
?>
     



     


