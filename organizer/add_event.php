<?php
session_start();

if(isset($_SESSION['userdata'])){ 
    $user_id = $_SESSION['userdata']['id'];
}else{
    header("location: index.php");
    exit();
}   

include '../admin/db_connect.php';

extract($_POST);


$sql = "SELECT * FROM equipment_in_used;";
$result = mysqli_query($con,$sql);

$equipment_id = mysqli_num_rows( $result )+1;


$sql = "INSERT INTO `event` (id, user_id, title, description, start_datetime, end_datetime, location, type, equipments, status)
VALUES('$event_id','$user_id', '$event_title', '$event_description', '$event_start', '$event_end', '$event_location', '$event_type','$equipment_id', '$event_status')";

$result = mysqli_query($con,$sql);
if($result){
    // add equipments in used to the database
    $sql = "SELECT * from equipments";
    $result = mysqli_query($con, $sql);
    $equipment_data = mysqli_fetch_all($result);

    $equipment_keys = array();
    $temp_val = $equipments;
    for($i=0; $i < count($equipment_data); $i++){
        array_push($equipment_keys, $equipment_data[$i][1]);
    }
    
    print_r($equipment_keys);
    
    array_unshift($temp_val, $equipment_id, $event_id);
    array_unshift($equipment_keys, "id", "event_id");
    
    $sql = "INSERT INTO `equipment_in_used` (" . implode(', ',$equipment_keys) . ") 
    VALUES (" . implode(', ',$temp_val) . ")";
        echo $sql;
    $result = mysqli_query($con,$sql);
    if($result){
        for($i=0; $i<count($equipment_data); $i++){
            
            $sql = "UPDATE `equipments` SET `remaining_no` = (`remaining_no` -".$equipments[$i].") WHERE equipment='".$equipment_data[$i][1]."';";
            $result = mysqli_query($con,$sql);
            if($result){
                continue;
            }
        }  
    }
}
                    
?>