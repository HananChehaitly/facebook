<?php
    include("connection.php");
    session_start();
    $arr = [];
    $arr["fname"]= $_SESSION["first_name"];
    $arr["lname"] = $_SESSION["last_name"];
    $arr["id"] =  $_SESSION["user_id"];
    $json = json_encode($arr, JSON_PRETTY_PRINT);
    echo $json;  
    