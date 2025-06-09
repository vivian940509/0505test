<?php
namespace app\Controller;
use vendor\Controller;
use vendor\DB;

class Role extends Controller
{
    public function getRoles(){
        if (isset($_POST['role_id'])) {
            $role_id = $_POST['role_id'];
            $sql = "SELECT * FROM `role` WHERE `role_id`=?";
            $arg = array($role_id);
        } else {
            $sql = "SELECT * FROM `role`";
            $arg = NULL;
        }
        return DB::select($sql, $arg);
    }
    
    public function getRole(){
        // 與 getRoles 共用邏輯，只是會特別傳入 role_id
        return $this->getRoles();
    }
    
    public function newRole(){
        $role_name = $_POST['role_name'];
        
        // 檢查必填欄位
        if(empty($role_name)) {
            return $this->response(400, "角色名稱不可為空");
        }

        // 先檢查角色名稱是否已存在
        $checkSql = "SELECT COUNT(*) AS count FROM `role` WHERE `role_name` = ?";
        $checkResult = DB::select($checkSql, array($role_name));
        
        // 如果已存在同名角色，回傳錯誤訊息
        if ($checkResult['result'][0]['count'] > 0) {
            return $this->response(409, "角色名稱「" . $role_name . "」已經存在");
        }
        
        // 如果不存在同名角色，則進行新增
        $sql = "INSERT INTO `role` (`role_name`) VALUES (?)";
        return DB::insert($sql, array($role_name));
    }
    
    public function removeRole(){
        $role_id = $_POST['role_id'];

        $sql = "DELETE FROM `role` WHERE `role_id`=?";
        return DB::delete($sql, array($role_id));
    }
    
    public function updateRole(){
        $role_id = $_POST['role_id'];
        $role_name = $_POST['role_name'];
        
        // 檢查必填欄位
        if(empty($role_name)) {
            return $this->response(400, "角色名稱不可為空");
        }
            
        // 先檢查角色名稱是否已存在且不是當前角色
        $checkSql = "SELECT COUNT(*) AS count FROM `role` WHERE `role_name` = ? AND `role_id` != ?";
        $checkResult = DB::select($checkSql, array($role_name, $role_id));
        
        // 如果已存在同名角色，回傳錯誤訊息
        if ($checkResult['result'][0]['count'] > 0) {
            return $this->response(409, "角色名稱「" . $role_name . "」已經存在");
        }
        
        // 只更新 role_name，不更新 created_at
        $sql = "UPDATE `role` SET `role_name`=? WHERE role_id=?";
        return DB::update($sql, array($role_name, $role_id));
    }
}
?>