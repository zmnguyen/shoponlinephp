<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class database {
    
    static $con;

    public static function connectDB() {
        $host = "localhost";
        $port = 3306;
        $socket = "";
        $user = "root";
        $password = "123456";
        $dbname = "shoponlineshiver";

        self::$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
                or die('Could not connect to the database server' . mysqli_connect_error());
        //$con->close();
        
        return self::$con;
    }
    
    public static function close(){
        mysqli_close(self::$con);
    }

}
