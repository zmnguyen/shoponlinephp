<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Model/Product.php';
if (is_ajax()) {
    $product = new Product();
    switch ($_POST['action']) {
        case "load":
            loadData();
            break;
        case "add":
            $img = "";
            foreach ($file as $_FILES) {
                $img = $img . $file['name'] . ";";
                
                uploadfile($file);
            }
            $result = $product->add($_POST['name'], $_POST["file_upload"], $_POST['meterial'], $_POST['producer'], $_POST['supplier'], $_POST['import'], $_POST['export'], $_POST['amount'], $_POST['categeries']);
            echo $img;
            break;
        case "update":
            $result = $product->update($_POST['id'], $_POST['name'], "", $_POST['meterial'], $_POST['producer'], $_POST['supplier'], $_POST['import'], $_POST['export'], $_POST['amount'], $_POST['categeries']);
            break;
        case "select":
            $result = $product->select($_POST["id"]);

            $data = array(
                "id" => $result["PRODUCT_id"],
                "name" => $result["PRODUCT_name"],
                "meterial" => $result["PRODUCT_meterial"],
                "producer" => $result["PRODUCT_producer"],
                "supplier" => $result["PRODUCT_supplier"],
                "import" => $result["PRODUCT_import"],
                "export" => $result["PRODUCT_export"],
                "amount" => $result["PRODUCT_amount"],
                "categories" => $result["PRODUCT_categories"]
            );

            echo json_encode($data);
            break;
        case "delete":
            $result = $product->delete($_POST["id"]);
            break;
    }
}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function loadData() {
    $product = new Product();

    $Data = $product->selectAll();

    while ($row = mysqli_fetch_assoc($Data)) {
        echo "
            <tr>
                <td>" . $row["PRODUCT_id"] . "</td>
                <td>" . $row["PRODUCT_name"] . "</td>
                <td>" . $row["PRODUCT_kind"] . "</td>
                <td>" . $row["PRODUCT_importprice"] . "</td>
                <td>" . $row["PRODUCT_exportprice"] . "</td>
                <td>
                    <button type='button' class='btn btn-info' value='" . $row["PRODUCT_id"] . "' >Thông Tin</button>

                    <button type='button' class='btn btn-danger' value='" . $row["PRODUCT_id"] . "' >Xóa</button>
                </td>
            </tr>
            ";
    }
}

function uploadfile($file) {
    // HERE SET THE PATH TO THE FOLDER WITH IMAGES ON YOUR SERVER (RELATIVE TO THE ROOT OF YOUR WEBSITE ON SERVER)
    $upload_dir = 'shoponlinephp/upload_dir/product';

    // HERE PERMISSIONS FOR IMAGE
    $imgsets = array(
        'maxsize' => 5000, // maximum file size, in KiloBytes (2 MB)
        'type' => array('bmp', 'gif', 'jpg', 'jpe', 'png')        // allowed extensions
    );

    $re = '';
    $upload_dir = trim($upload_dir, '/') . '/';
    $img_name = basename($file['name']);

    // get protocol and host name to send the absolute image path to CKEditor
    $protocol = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $site = $protocol . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . '/';

    $uploadpath = $_SERVER['DOCUMENT_ROOT'] . '/' . $upload_dir . $img_name;       // full file path
    $sepext = explode('.', strtolower($file['name']));
    $type = end($sepext);       // gets extension
    $err = '';         // to store the errors
    // Checks if the file has allowed type, size, width and height (for images)
    if (!in_array($type, $imgsets['type']))
        $err .= 'The file: ' . $file['name'] . ' has not the allowed extension type.';
    if ($file['size'] > $imgsets['maxsize'] * 1000)
        $err .= '\\n Maximum file size must be: ' . $imgsets['maxsize'] . ' KB.';

    // If no errors, upload the image, else, output the errors
    if ($err == '') {
        if (move_uploaded_file($file['tmp_name'], $uploadpath)) {
            $url = $site . $upload_dir . $img_name;

            $re = $url;
        } else
            $re = 'alert("Unable to upload the file")';
    } else
        $re = 'alert("' . $err . '")';

    echo $re;
}
