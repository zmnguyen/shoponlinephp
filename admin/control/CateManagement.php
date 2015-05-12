<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Model/Categories.php';
if (isset($_POST["action"]) && !empty($_POST["action"])) {
    $categories = new Categories();
    switch ($_POST["action"]) {
        case "delete":
            if ($categories->checkId($_POST['id'])) {
                $result = $categories->delete($_POST["cateID"]);
                
                if ($result === false) {
                    echo "denied";
                }else{
                    echo json_encode("success");
                }
            } else {
                echo json_encode("denied");
            }
            break;
        case "add":
            if ($categories->checkName($_POST['name'])) {
                $name = $_POST["name"];
                $parent = $_POST["parent"];
                if (isset($_POST['parent'])) {
                    $result = $categories->add($name, $parent);
                } else {
                    $result = $categories->add($name, null);
                }

                if ($result === false) {
                    echo "denied";
                }else{
                    echo json_encode("success");
                }
            } else {
                echo json_encode("denied");
            }
            break;
        case "update":
            if ($categories->checkName($_POST['name'])) {
                $id = $_POST["id"];
                $name = $_POST["name"];
                $parent = $_POST["parent"];
                if (isset($_POST['parent'])) {
                    $result = $categories->update($id, $name, $parent);
                } else {
                    $result = $categories->update($id, $name, null);
                }

                if ($result === false) {
                    echo "denied";
                }else{
                    echo json_encode("success");
                }
            } else {
                echo json_encode("denied");
            }

            break;
        case "load":
            $result = $categories->selectAll();
            while ($row = mysqli_fetch_assoc($result)) {
                $parent = "";
                $listCate = $categories->selectAll();
                while ($cate = mysqli_fetch_array($listCate)) {
                    if ($row["CATE_parent"] == $cate["CATE_id"]) {
                        $parent = $cate["CATE_name"];
                    }
                }
                echo "
                <tr>
                    <td>" . $row['CATE_id'] . "</td>
                    <td>" . $row['CATE_name'] . "</td>
                    <td>" . $parent . "
                    </td>
                    <td>
                        <a href='" . $_SERVER['REQUEST_URI'] . "?cateID=" . $row['CATE_id'] . "' class='btn btn-primary'>Chỉnh Sửa</a>
                        <button type='button' class='btn btn-danger' value='" . $row["CATE_id"] . "'>Xóa</button>
                    </td>
                </tr>
                ";
            }
            break;
        case "select":
            $result = mysqli_fetch_assoc($categories->select($_POST["CateId"]));
            
            $data = array(
                "id" => $result["CATE_id"],
                "name" => $result["CATE_name"],
                "parent" => $result["CATE_parent"]
            );
            
            echo json_encode($data);
            break;
    }
}
