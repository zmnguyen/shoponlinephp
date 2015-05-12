<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author NhutNguyen
 */
include_once $_SERVER['DOCUMENT_ROOT'].'/shoponlinephp/Control/connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/shoponlinephp/Model/Product.php';
class Order{
    //put your code here
    public function select($id){
        $con = database::connectDB();
        $query = "select * from tbl_order where ORDER_id = '".$id."'";
        $result = mysqli_query($con, $query);
        database::close();
        
        return $result;
    }
    
    public function selectAll(){
        $con = database::connectDB();
        $query = "select * from tbl_order";
        $result = mysqli_query($con, $query);
        database::close();
        
        return $result;
    }
    
    public function add($maker, $address, $comment, $listDetail, $userId){
        
        $con = database::connectDB();
        
        //insert order
        $id = date('Ymd')."-";
        $count = mysqli_query($con, "select count(*) from tbl_order where ORDER_date = '".date('Ymd')."'");
        $count++;
        $query = "insert into tbl_order(ORDER_id, ORDER_maker, ORDER_to, ORDER_comment, ORDER_date, USER_id) "
                . "values('".$td.$count."', '".$maker."', '".$comment."', '".  date("Y/m/d")."', '".$userId."')";
        
        mysqli_query($con, $query);
        $total = 0;
        foreach($listDetail as $value){
            
            
            mysqli_query($con, $queryAddDetail);
        }
        
        $queryUpdateOrder = "update tbl_order set ORDER_total = '".$total."' where ORDER_id = '".$id.$count."'";
        
        database::close();
    }
    
    public function update(){
        
    }
    
    public function delete($id){
        $con = database::connectDB();
        $query = "delete from tbl_order where ORDER_id = '".$id."'";
        mysqli_query($con, $query);
        
        $query2 = "delete from tbl_orderdetail where ORDER_id = '".$id."'";
        mysqli_query($con, $query2);
        database::close();
    }
}
