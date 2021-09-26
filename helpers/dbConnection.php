<?php 
session_start();
$con = mysqli_connect("localhost","root","","egytourdb");
if(!$con){
    
    die("Error : ".mysqli_connect_error());
}

?>