
<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];


$query ="Select text from notifications where users_id=?";  
$stmt = $connection->prepare($query);
$stmt -> bind_param ("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$i=0;
$temp_array=[];
while($row = $result->fetch_assoc()){
    $temp_array[$i]=$row;
    $i++;
}

$json = json_encode($temp_array, JSON_PRETTY_PRINT);
echo $json;  
