<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];
$givenId = $_POST["id"];
$arr =  explode("_",$givenId);
$friend_id = $arr[1];
$friend_id = (int) $friend_id;

$query ="Insert into connections (user_id,friend_id,status) values (?,?,1)"; // pending request is represented by status 1 in our db. 
$stmt = $connection->prepare($query);
$stmt -> bind_param ("ii",$friend_id,$user_id);
$stmt->execute();

$message= "all good"; 

$json = json_encode($message, JSON_PRETTY_PRINT);
echo $json;  
