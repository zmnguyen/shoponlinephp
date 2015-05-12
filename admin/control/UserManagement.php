<?php

session_start();
include_once '../../Control/connect.php';

if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
        $action = $_POST["action"];
        switch ($action) { //Switch case for value of action
            case "login":
                Login($_POST['userName'], $_POST['password']);
                break;
            case "logout":
                session_destroy();
                break;
            case "add":
                break;
            case "update":
                break;
            case "delete":
                break;
        }
    }
}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function Login($userName, $password) {
    if ($userName == "admin" && $password == "admin") {
        $_SESSION['userName'] = $userName;
        echo 'success';
    } else {
        $query = "SELECT * FROM shoponlineshiver.tbl_user where USER_name = '" . $userName . "' and USER_password = '" . $password . "'";
        $con = database::connectDB();
        $result = mysqli_query($con, $query);

        $count = count(mysqli_fetch_array($result));

        if ($count > 0) {
            $_SESSION['userName'] = $userName;
            mysqli_close($con);
            echo 'success';
        } else {
            mysqli_close($con);
            echo 'none';
        }
    }
}

function add() {
    
}

?>