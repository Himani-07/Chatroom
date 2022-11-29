<?php
session_start();
$host = "localhost:3307"; 
$user = "root";
$password = "mysql@1234";
$db = "chatroom";

$conn = mysqli_connect($host, $user, $password,$db) ;

if(!$conn)
    die("Failed to connect".mysqli_connect_error());
?>