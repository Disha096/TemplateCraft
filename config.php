<?php

$host="localhost";
$username ="root";
$password="";
$db_name="templatecraft";

$conn = mysqli_connect($host,$username,$password,$db_name);

if(!$conn){
echo("Database Connection Error");
}

?>