<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mesage
 *
 * @author NhutNguyen
 */
include_once $_SERVER['DOCUMENT_ROOT'].'/shoponlinephp/Control/connect.php';
class Message {
    //put your code here
    
    public function selectAll(){
        $con = database::connectDB();
        $query = "select * from tbl_message";
        $result = mysqli_query($con, $query);
        database::close();
        return $result;
    }
    
    public function select($id){
        $con = database::connectDB();
        $query = "select * from tbl_message where MESSAGE_id = '".$id."'";
        $result = mysqli_query($con, $query);
        database::close();
        return $result;
    }
    
    public function add($sender, $content){
        $con = database::connectDB();
        $query = "insert into tbl_message values('".$sender."', '".$content."', '".  date('Y/m/d H:i:s')."')";
        $result = mysqli_query($con, $query);
        database::close();
    }
    
    public function update($id, $status){
        $con = database::connectDB();
        $query = "update tbl_message set MESSAGE_statuc = '".$status."'";
        $result = mysqli_query($con, $query);
        database::close();
    }


    public function delete($id){
        $con = database::connectDB();
        $query = "delete from tbl_message where MESSAGE_id = '".$id."'";
        $result = mysqli_query($con, $query);
        database::close();
    }
}
