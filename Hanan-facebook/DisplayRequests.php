
<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];

//Keep in mind, status=1 represents a pending request.
$query ="Select u.id, u.first_name, u.last_name from users as u, connections as c where c.user_id=? and c.status=1 and c.friend_id = u.id";  
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
