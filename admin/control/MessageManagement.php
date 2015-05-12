<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Model/Message.php';
$Message = new Message();
if (isset($_POST["action"]) && !empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "select":
            $result = mysqli_fetch_assoc($Message->select($_POST["id"]));
            $data = array(
                "id" => $result["MESSAGE_id"],
                "sender" => $result["MESSAGE_sender"],
                "content" => $result["MESSAGE_content"],
                "date" => $result["MESSAGE_date"],
                "status" => $result["MESSAGE_status"]
            );
            echo json_encode($data);
            break;
        case "load":
            $result = $Message->selectAll();
            while ($row = mysqli_fetch_assoc($result)) {
                $status = "";
                if ($row["MESSAGE_status"] == false) {
                    $status = "<span class='danger'>Chưa Đọc</span>";
                } else {
                    $status = "<span class='success'>Đã Đọc</span>";
                }
                echo "<tr>
                        <td>" . $row["MESSAGE_id"] . "</td>
                        <td>" . $row["MESSAGE_sender"] . "</td>
                        <td></td>
                        <td>" . $status . "</td>
                        <td>
                            <button type='button' class='btn btn-info' value='" . $row["MESSAGE_id"] . "'>Nội Dung</button>
                            <button type='button' class='btn btn-danger' value='" . $row["MESSAGE_id"] . "'>Xóa</button>
                        </td>
                    </tr>";
            }
            break;
        case "delete":
            $Message->delete($_POST["id"]);
            break;
        case "update":
            $Message->update($_POST["id"], $_POST["status"]);
            break;
    }
}
