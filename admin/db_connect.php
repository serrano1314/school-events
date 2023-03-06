<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "event-management";

$con = new mysqli($host, $username, $password, $database);
if($con->connect_error){
    echo $con->connect_error;
}

?>