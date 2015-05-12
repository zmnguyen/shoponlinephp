<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductManager
 *
 * @author NhutNguyen
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Control/connect.php';

class Product {

    //put your code here

    public function search($input) {
        $con = database::connectDB();
        $query = "select * "
                . "from tbl_product pr "
                . "INNER JOIN tbl_categories cate on pr.CATE_id = cate.CATE_id"
                . "where "
                . "pr.PRODUCT_id LIKE '%" . $input . "%' OR pr.PRODUCT_name LIKE '%" . $input . "%'"
                . "OR cate.CATE_name LIKE '%" . $input . "%'";
        $result = mysqli_query($con, $query);
        database::close();

        return $result;
    }

    public function select($id) {
        $con = database::connectDB();
        $query = "select * from shoponlineshiver.tbl_product where PRODUCT_id = " . $id . " limit 1";

        $result = mysqli_query($con, $query);

        database::close();
        return $result;
    }

    public function selectAll() {
        $con = database::connectDB();
        $query = "select * from shoponlineshiver.tbl_product";

        $result = mysqli_query($con, $query);
        database::close();
        return $result;
    }

    public function add($name, $img, $meterial, $producer, $supplier, $import, $export, $amount, $cateID) {
        $con = database::connectDB();
        $query = "insert into shoponlineshiver.tbl_product
                (PRODUCT_id, PRODUCT_name, PRODUCT_img, PRODUCT_meterial, PRODUCT_producer, PRODUCT_supplier, PRODUCT_import, PRODUCT_export, PRODUCT_amount, CATE_id)
                values('" . $name . "', '" . $img . "', '" . $meterial . "', '" . $producer . "', '" . $supplier . "', '" . $import . "', '" . $export . "', '" . $amount . "','" . $cateID . "')";

        $result = mysqli_query($con, $query) or die("error on insert");
        database::close();

        return mysqli_insert_id();
    }

    public function update($id, $name, $img, $meterial, $producer, $supplier, $import, $export, $amount, $cateID) {
        $con = database::connectDB();
        $query = "update shoponlineshiver.tbl_product
                  set
                  PRODUCT_name = '" . $name . "', PRODUCT_img = '" . $img . "',
                  PRODUCT_meterial = '" . $meterial . "', PRODUCT_producer = '" . $producer . "',
                  PRODUCT_supplier = '" . $supplier . "', CATE_id = '" . $cateID . "',
                  PRODUCT_import = '" . $import . "', PRODUCT_export = '" . $export . "',
                  PRODUCT_amount = '" . $amount . "'
                  where PRODUCT_id = '" . $id . "'";

        $result = mysqli_query($con, $query) or die("error on update");

        database::close();
        return $result;
    }

    public function delete($id) {
        $con = database::connectDB();

        $query = "delete form shoponlineshiver.tbl_product where PRODUCT_id = " . $id;

        $result = mysqli_query($con, $query);

        database::close();

        return $result;
    }

    public function select_producer() {
        $con = database::connectDB();
        $query = "select PRODUCT_producer from shoponlineshiver.tbl_product";

        $result = mysqli_query($con, $query) or die("error onn select producer");
        database::close();

        return $result;
    }

    public function select_meterial() {
        $con = database::connectDB();
        $query = "select PRODUCT_meterial from shoponlineshiver.tbl_product";

        $result = mysqli_query($con, $query) or die("error onn select meterial");
        database::close();

        return $result;
    }

    public function select_supplier() {
        $con = database::connectDB();
        $query = "select PRODUCT_supplier from shoponlineshiver.tbl_product";

        $result = mysqli_query($con, $query) or die("error onn select supplier");
        database::close();

        return $result;
    }

    
}
