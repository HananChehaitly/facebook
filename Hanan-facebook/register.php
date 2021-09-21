
<?php
include "connection.php";
if(isset($_POST["first_name"]) && $_POST["first_name"] != "" && strlen($_POST["first_name"]) >= 3 ) {
    $first_name = $_POST["first_name"];
}else{
    header('location: register13.html');
}
if(isset($_POST["last_name"]) && $_POST["last_name"] != "" && strlen($_POST["last_name"]) >= 3) {
    $last_name = $_POST["last_name"];
}else{
    header('location: register13.html');
}

if(isset($_POST["email"]) && $_POST["email"] != "") {
    $email = $_POST["email"];
}else{
    header('location: register13.html');
}

if(isset($_POST["password"]) && $_POST["password"] != "" && strlen($_POST["password"]) >=7 ) {
    $password = $_POST["password"];
}else{
    header('location: register13.html');
}
if(strlen($_POST["password"]) <7 ) {
    header('location: register13.html');
}

if($_POST["password"] != $_POST["confirmPassword"]){ //checking if they are different
    header('location: register13.html');
}
else{
$sql1="Select * from users where email=?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("s",$email);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();
if(empty($row)){
$sql2 = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`) VALUES (?, ?, ?, ?)"; #add the new user to the database
$hash = hash('sha256', $password);
$stmt2 = $connection->prepare($sql2);
$stmt2->bind_param("ssss",$first_name,$last_name,$email,$hash);
$stmt2->execute();
$result2 = $stmt2->get_result();

header('location: login13.html');
}
else{
    header('location: register13.html');
}
}
?>