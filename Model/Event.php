<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Event
 *
 * @author NhutNguyen
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Control/connect.php';

class Event {

    //put your code here

    public function selectAll() {
        $con = database::connectDB();
        $query = "select * from tbl_event";
        $result = mysqli_query($con, $query) or die();
        database::close();

        return $result;
    }

    public function select($id) {
        $con = database::connectDB();
        $query = "select * from tbl_event where EVENT_id = '" . $id . "'";

        $result = mysqli_query($con, $query) or die();
        database::close();

        return $result;
    }

    public function selectEventDetail($id) {
        $con = database::connectDB();
        $query = "select * from tbl_eventdetail where EVENT_id = '" . $id . "'";
        $result = mysqli_query($con, $query);
        database::close();

        return $result;
    }

    public function add($name, $img, $content, $discount, $from, $to, $listCate) {
        $con = database::connectDB();
        $query = "insert into tbl_event(EVENT_name, EVENT_img, EVENT_content, EVENT_discount, EVENT_from, EVENT_to) values('" . $name . "', '".$img."','" . $content . "', '" . $discount . "', '" . $from . "', '" . $to . "')";

        $result = mysqli_query($con, $query);
        if ($result) {
            $id = mysqli_insert_id($con);
            foreach ($listCate as $row) {
                $query2 = "insert into tbl_eventdetail values('" . $id . "', '" . $row . "', '" . date('Y/m/d H:i:s') . "')";

                $result2 = mysqli_query($con, $query2);
            }
        } else {
            echo mysqli_error($con);
        }
        database::close();
    }

    public function update($id, $name, $content, $discount, $from, $to, $listCate) {
        $con = database::connectDB();
        $query = "update shoponlineshiver.tbl_event"
                . "set"
                . "EVENT_name = '" . $name . "',"
                . "EVENT_content = '" . $content . "',"
                . "EVENT_discount = '" . $discount . "',"
                . "EVENT_from = '" . $from . "',"
                . "EVENT_to = '" . $to . "'"
                . "where EVENT_id = '" . $id . "'";

        mysqli_query($con, $query) or die();

        $listCateEvent = mysqli_query($con, "select * from tbl_eventdetail where EVENT_id = '" . $id . "'");

        while ($cateEvent = mysqli_fetch_assoc($listCateEvent)) {
            $bool = FALSE;

            foreach ($listCate as $cate) {
                if($cateEvent["CATE_id"] == $cate){
                    $bool = true;
                }
            }
            
            if($bool == FALSE){
                $query = "delete from tbl_eventdetail where EVENT_id = '".$id."' AND CATE_id = '".$cateEvent["CATE_id"]."'";
                mysqli_query($con, $query);
            }
        }
        database::close();
    }

    public function delete($id) {
        $con = database::connectDB();
        
        $query2 = "delete from tbl_eventdetail where EVENT_id = '".$id."'";
        mysqli_query($con, $query2);
        
        $query = "delete from tbl_event where EVENT_id = '" . $id . "'";
        mysqli_query($con, $query) or die();
        
        
        database::close();
    }

}
