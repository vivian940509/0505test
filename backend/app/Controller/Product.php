<?php
namespace app\Controller;
use vendor\Controller;
use vendor\DB;
class Product extends Controller
{
    public function getProducts(){
        if (isset($_POST['pid'])) {
            $pid = $_POST['pid'];
            $sql = "SELECT * FROM `product` WHERE `pid`=?";
            $arg = array($pid);
        } else {
            $sql = "SELECT * FROM `product`";
            $arg = NULL;
        }
        return DB::select($sql, $arg);
    }
    
    public function newProduct(){
        $p_name = $_POST['p_name'];
        $cost = $_POST['cost'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $sql = "INSERT INTO `product` (`p_name`, `cost`, `price`, `stock`) VALUES (?, ?, ?, ?)";
        return DB::insert($sql, array($p_name, $cost, $price, $stock));
    }
    
    public function removeProduct(){
        $pid = $_POST['pid'];

        $sql = "DELETE FROM `product` WHERE pid=?";
        return DB::delete($sql, array($pid));
    }
    
    public function updateProduct(){
        $pid = $_POST['pid'];
        $p_name = $_POST['p_name'];
        $cost = $_POST['cost'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $sql = "UPDATE `product` SET `p_name`=?, `cost`=?, `price`=?, `stock`=? WHERE `pid`=?";
        return DB::update($sql, array($p_name, $cost, $price, $stock, $pid));
    }
    
}
?>