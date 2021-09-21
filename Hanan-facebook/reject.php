<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];
$givenId = $_POST["id"];
$arr =  explode("_",$givenId);
$friend_id = $arr[1];
$friend_id = (int) $friend_id;

$query ="Delete from connections where user_id= ? and friend_id=? and status=1"; // pending request is represented by status 1 in our db. 
$stmt = $connection->prepare($query);
$stmt -> bind_param ("ii",$user_id,$friend_id);
$stmt->execute();

$message= "all good"; 

$json = json_encode($message, JSON_PRETTY_PRINT);
echo $json;  
