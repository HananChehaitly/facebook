
<?php
include "connection.php";
session_start();
$user_id =$_SESSION["user_id"];
$str = $_POST["search"];
$search = $str."%" ;

$query ="Select * from users as u where u.id Not In( Select u.id from users as u, connections as c where u.id=c.friend_id and c.user_id = ? ) and u.id<>? and (u.first_name LIKE ?  or u.last_name LIKE ?)";  //bind to $user_id
$stmt = $connection->prepare($query);
$stmt -> bind_param ("ssss", $user_id, $user_id, $search, $search);
$stmt->execute();
$result = $stmt->get_result();

$i=0;
$temp_array=[];
while($row = $result->fetch_assoc()){
    $row["status"] = 0;    
    $temp_array[$i]=$row;
    $i++;
}

$json = json_encode($temp_array, JSON_PRETTY_PRINT);
echo $json;  
