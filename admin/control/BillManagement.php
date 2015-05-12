<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Model/Order.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Model/OrderDetail.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Model/Product.php';
$order = new Order();
$detail = new Order();
$product = new Product();
if (isset($_POST["action"]) && !empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "select":
            switch ($_POST['kind']) {
                case "order":
                    $data = mysqli_fetch_assoc($order->select($_POST["id"]));
                    if ($data) {
                        $result = array(
                            "id" => $data["ORDER_id"],
                            "maker" => $data["ORDER_maker"],
                            "address" => $data["ORDER_to"],
                            "comment" => $data["ORDER_comment"],
                            "date" => $data["ORDER_date"],
                            "total" => $data["ORDER_total"],
                            "status" => $data["ORDER_status"],
                            "userId" => $data["USER_id"]
                        );
                        echo json_encode($result);
                    }
                    break;
                case "detail":
                    $data = mysqli_fetch_assoc($detail->select($_POST["id"]));
                    if ($data) {
                        $result = array(
                            "id" => $data["DETAIL_id"],
                            "quantity" => $data["DETAIL_quantity"],
                            "total" => $data["DETAIL_total"],
                            "orderId" => $data["ORDER_id"],
                            "productId" => $data["PRODUCT_id"]
                        );

                        echo json_encode($result);
                    }
                    break;
            }
            break;
        case "load":
            switch ($_POST["kind"]) {
                case "order":
                    $data = $order->selectAll();
                    if ($data) {
                        while ($row = mysqli_fetch_assoc($data)) {
                            $status = "";
                            if ($row["ORDER_status"] == 0) {
                                $status = "<label class='label label-danger'>Chưa Thanh Toán</>";
                            } else {
                                $status = "<label class='label label-success'>Đã Thanh Toán</>";
                            }
                            echo "<tr>
                            <td>" . $row["ORDER_id"] . "</td>
                            <td>" . $row["ORDER_maker"] . "<label/td>label
                            <td>" . $row["ORDER_to"] . "</td>
                            <td>" . $row["ORDER_date"] . "</td>
                            <td>" . $row["ORDER_total"] . "</td>
                            <td>
                                " . $status . "
                            </td>
                            <td>
                                <button type='button' class='btn btn-info' value='" . $row["ORDER_id"] . "'>Chi Tiết</button>
                                <button type='button' class='btn btn-danger' value='" . $row["ORDER_id"] . ">Huỷ</button>
                            </td>
                        </tr>";
                        }
                    }
                    break;
                case "detail":
                    $data = $detail->selectAll();
                    if ($data) {
                        while ($row = mysqli_fetch_assoc($data)) {
                            $ProductData = mysqli_fetch_assoc($product->select($row[""]));
                            echo "<tr>
                                    <td>" . $row["DETAIL_id"] . "</td>
                                    <td>" . $ProductData["PRODUCT_name"] . "</td>
                                    <td>" . $ProductData["PRODUCT_export"] . "</td>
                                    <td>" . $row["DETAIL_amount"] . "</td>
                                    <td>" . $row["DETAIL_amount"] * $ProductData["PRODUCT_export"] . "</td>
                                    <td>
                                        <button type='button' class='btn btn-danger' value='" . $row["DETAIL_id"] . "'>Huỷ</button>
                                    </td>
                                </tr>";
                        }
                    }
                    break;
            }

            break;
        case "delete":
            switch ($_POST["kind"]){
                case "order":
                    $order->delete($_POST["id"]);
                    break;
                case "detail":
                    $detail->delete($_POST["id"]);
                    break;
            }
            break;
    }
}
