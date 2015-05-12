<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/shoponlinephp/Model/Event.php';
$Event = new Event();
if (isset($_POST["action"]) && !empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case "select":
            $result = mysqli_fetch_assoc($Event->select($_POST["id"]));

            $data = array(
                "id" => $result["EVENT_id"],
                "name" => $result["EVENT_name"],
                "content" => $result["EVENT_content"],
                "discount" => $result["EVENT_discount"],
                "from" => $result["EVENT_from"],
                "to" => $result["EVENT_to"]
            );

            echo json_encode($data);
            break;
        case "load":
            $result = $Event->selectAll();

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>"
                . "<td>" . $row["EVENT_id"] . "</td>"
                . "<td>" . $row["EVENT_name"] . "</td>"
                . "<td>" . $row["EVENT_discount"] . "%</td>"
                . "<td>" . $row['EVENT_from'] . "-" . $row['EVENT_to'] . "</td>"
                . "<td></td>"
                . "<button type='button' class='btn btn-info' value='" . $row["EVENT_id"] . "' >Thông Tin</button>"
                . "<button type='button' class='btn btn-danger' value='" . $row["PRODUCT_id"] . "' >Xóa</button>"
                . "<td></td>"
                . "</tr>";
            }
            break;
        case "add":
            uploadfile($_FILES['banner']);
            $Event->add($_POST["name"], $_FILES['banner']['name'], $_POST["content"], $_POST["discount"], $_POST["from"], $_POST["to"], $_POST["categories"]);
            break;
        case "update":
            $Event->update($_POST["id"], $_POST["name"], $_POST["content"],$_POST["discount"], $_POST["from"],$_POST["to"], $_POST["categories"]);
            break;
        case "delete":
            $Event->delete($_POST["id"]);
            break;
    }
}

function uploadfile($file) {
    // HERE SET THE PATH TO THE FOLDER WITH IMAGES ON YOUR SERVER (RELATIVE TO THE ROOT OF YOUR WEBSITE ON SERVER)
    $upload_dir = 'shoponlinephp/upload_dir/event';

    // HERE PERMISSIONS FOR IMAGE
    $imgsets = array(
        'maxsize' => 20000, // maximum file size, in KiloBytes (2 MB)
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