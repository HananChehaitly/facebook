<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];
$fname = $_POST["first_name"];
$lname = $_POST["last_name"];
$email = $_POST["email"];
$password = $_POST["password"];
$conf_pass = $_POST["conf_password"];
if($password!=$conf_pass){
    $json = json_encode("Not okay", JSON_PRETTY_PRINT);
}
else{
    $hash = hash('sha256', $password);

    $query ="Update users set email=?, password=? ,first_name=? , last_name=? where id=?"; 
    $stmt = $connection->prepare($query);
    $stmt -> bind_param ("ssssi",$email,$hash,$fname,$lname,$user_id);
    $stmt->execute();

    $message= "all good"; 

    $json = json_encode($message, JSON_PRETTY_PRINT);
}

echo $json;  
