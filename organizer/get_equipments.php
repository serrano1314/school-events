<?php 
include '../admin/db_connect.php';
$sql = "SELECT equipment, equipment_no, remaining_no FROM equipments";
$result = mysqli_query($con, $sql);
if($result){
    $EQUIPMENTS = mysqli_fetch_all($result);
}

?>