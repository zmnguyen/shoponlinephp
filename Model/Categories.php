<?php

/**
 * Description of Categories
 *
 * @author NhutNguyen
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Control/connect.php';

class Categories {

    public function select($id) {
        $query = "select * from tbl_categories where CATE_id = " . $id;

        $con = database::connectDB();
        $result = mysqli_query($con, $query);
        mysqli_close($con);
        return $result;
    }

    public function selectAll() {
        $query = "select * from tbl_categories";

        $con = database::connectDB();
        $result = mysqli_query($con, $query);
        mysqli_close($con);
        return $result;
    }

    public function add($name, $parent) {
        $con = database::connectDB();
        $query2 = "";
        if ($parent != null) {
            $query2 = "insert into tbl_categories(CATE_name, CATE_parent) values('" . $name . "','" . $parent . "')";
        } else {
            $query2 = "insert into tbl_categories(CATE_name, CATE_parent) values('" . $name . "','-1')";
        }
        $result = mysqli_query($con, $query2);
        database::close();
        return $result;
    }

    public function update($id, $name, $parent) {
        $con = database::connectDB();
        if ($parent != null) {
            $query = "update tbl_categories set CATE_id = '" . $id . "', CATE_name = '" . $name . "', CATE_parent = '" . $parent . "' where CATE_id = '" . $id . "'";
        } else {
            $query = "update tbl_categories set CATE_id = '" . $id . "', CATE_name = '" . $name . "', CATE_parent = '-1' where CATE_id = '" . $id . "'";
        }
        $result = mysqli_query($con, $query);
        database::close();

        return $result;
    }

    public function delete($id) {
        $con = database::connectDB();
        
        $query1 = "delete from tbl_product where CATE_id = '".$id."'";
        mysqli_query($con, $query1);
        
        $query = "delete from tbl_categories where CATE_id = '" . $id . "'";
        $result = mysqli_query($con, $query);
        
        mysqli_close($con);
        return $result;
    }

    public function checkName($name) {
        $con = database::connectDB();

        $query = "select * from tbl_categories where CATE_name = '" . $name . "'";

        $result = mysqli_query($con, $query);

        $count = count(mysqli_fetch_assoc($result));

        if ($count > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkId($id) {
        $con = database::connectDB();
        $query = "select * from shoponlineshiver.tbl_categories where CATE_id = '" . $id . "'";

        $result = mysqli_query($con, $query);
        $count = count(mysqli_fetch_assoc($result));

        if ($count > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
