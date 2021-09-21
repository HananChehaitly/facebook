<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];
$givenId = $_POST["id"];
$arr =  explode("_",$givenId);
$friend_id = $arr[1];
$friend_id = (int) $friend_id;

// Friendship is represented by status 2 in our db.
// Block is represented by status=3 in our db.
$query ="Update connections set status=3 where user_id= ? and friend_id=?";  
$stmt = $connection->prepare($query);
$stmt -> bind_param ("ii",$user_id,$friend_id);
$stmt->execute();

// Also update the other row in db.

$query ="Update connections set status=3 where user_id= ? and friend_id=?";  
$stmt = $connection->prepare($query);
$stmt -> bind_param ("ii",$friend_id,$user_id); //Notice we flipped them.
$stmt->execute();


$message= "all good"; 

$json = json_encode($message, JSON_PRETTY_PRINT);
echo $json;  
