<?php
session_start();

if(isset($_SESSION['userdata'])){ 
    $user_id = $_SESSION['userdata']['id'];
}else{
    header("location: index.php");
    exit();
}
    include '../admin/db_connect.php';
    if(isset($_POST['submit'])){
        $event_title = $_POST['title'];
        $event_description = $_POST['description'];
        $event_start = convertDateTime($_POST['start_datetime']);
        $event_end = convertDateTime($_POST['end_datetime']);
        $event_location = $_POST['location'];
        $event_type = $_POST['type'];
        $event_Status = $_POST['status'];

        $equipment_chairs = $_POST['chairs'];
        $equipment_table = $_POST['table'];
        $equipment_speakers = $_POST['speaker'];

        
        
        $sql = "SELECT * FROM equipment_in_used;";
        $result = mysqli_query($con,$sql);

        $equipment_id = mysqli_num_rows( $result );
        
        $sql = "INSERT INTO `event` (user_id, title, description, start_datetime, end_datetime, location, type, equipments, status)
        VALUES('$user_id', '$event_title', '$event_description', '$event_start', '$event_end', '$event_location', '$event_type','$equipment_id', '$event_Status')";
        
        $result = mysqli_query($con,$sql);
        if($result){
            // $sql = "INSERT INTO `equipment_in_used` (user_id, title, description, start_datetime, end_datetime, location, type, equipments, status)
            // VALUES('$user_id', '$event_title', '$event_description', '$event_start', '$event_end', '$event_location', '$event_type','$equipment_id', '$event_Status')";
            echo 'add event succes';
            header('location:index.php');
        }else{
            die(mysqli_error($con));
        }
    };

    function convertDateTime($dateTime){
        return date("Y-d-m H:i", strtotime($dateTime)).":00";
    }
?>