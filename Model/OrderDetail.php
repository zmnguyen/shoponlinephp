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
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Control/connect.php';
include_once $_SERVER['DOCUMENT_ROOT'] .'/shoponlinephp/Model/Product.php';

class OrderDetail {

    //put your code here

    public function select($id) {
        $con = database::connectDB();
        $query = "select * from tbl_orderdetail where DETAIL_id";
        $result = mysqli_query($con, $query);
        database::close();
        return $result;
    }

    public function selectAll() {
        $con = database::connectDB();
        $query = "select * from tbl_orderdetail";
        $result = mysqli_query($con, $query);
        database::close();
        return $result;
    }

    public function add($id, $amount, $Product_id, $Order_id) {
        $con = database::connectDB();
        $product = new Product();
        $data = mysqli_fetch_assoc($product->select($Product_id));
        $queryAddDetail = "insert into tbl_orderdetail(DETAIL_id, DETAIL_amount, DETAIL_total, ORDER_id, PRODUCT_id) "
                . "values('" . date("Ymd") . $count . "-" . $value["product_id"] . "', '" . $amount . "', '" . $data["PRODUCT_export"] * $amount . "', '" . $id . "', '" . $Product_id . "')";
        $total = $amount*$data["PRODUCT_export"];
        mysqli_query($con, $queryAddDetail);
        
        database::close();
        return $total;
    }

    public function update($id, $amount, $Product_id) {
        $con = database::connectDB();
        $query = "update tbl_orderdetail set DETAIL_amount = '".$amount."', PRODUCT_id = '".$Product_id."' where DETAIL_id = '".$id."'";
        mysqli_query($con, $query);
        
        database::close();
    }

    public function delete($id) {
        $con = database::connectDB();
        $query = "delete from tbl_orderdetail where DETAIL_id = '" . $id . "'";
        mysqli_query($con, $query);
        database::close();
    }

}
