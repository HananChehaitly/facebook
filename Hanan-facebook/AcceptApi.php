<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];
$givenId = $_POST["id"];
$arr =  explode("_",$givenId);
$id = $arr[1];
$friend_id = (int) $id;

//First we add a row 
//Status=2 represents friends in our db.

$query ="Insert into connections (user_id,friend_id,status) values (?,?,2)";  
$stmt = $connection->prepare($query);
$stmt -> bind_param ("ii",$friend_id,$user_id);
$stmt->execute();

//Now we need to update the row we added to connections when we sent to request.
//status should change from 1 to 2.
$query ="Update connections Set status=2 where user_id=? and friend_id=?"; 
$stmt = $connection->prepare($query);
$stmt -> bind_param ("ii",$user_id,$friend_id);   //Notice we reverse them.
$stmt->execute();

//Now we add a notification text to the friend.
$user_name =  $_SESSION["first_name"];
$user_lname = $_SESSION["last_name"];
$notification = $user_name." accepted your friend request";

$query ="Insert into notifications (text,users_id) values (?,?)"; 
$stmt = $connection->prepare($query);
$stmt -> bind_param ("si",$notification,$friend_id);
$stmt->execute();



$message= "all good"; 

$json = json_encode($message, JSON_PRETTY_PRINT);
echo $json;  
