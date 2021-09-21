<?php


session_start();
session_unset();

$message= "done";
$json = json_encode($message, JSON_PRETTY_PRINT);
echo $json;  

?>