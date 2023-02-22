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
        $event_start = $_POST['start_datetime'];
        $event_end = $_POST['end_datetime'];
        $event_location = $_POST['location'];
        $event_type = $_POST['type'];
        $event_Status = $_POST['status'];
        $event_id = $_POST['event_id'];

        $equipments_values = array_values($_POST['equipments_List']);
        $equipments_keys = array_keys($_POST['equipments_List']);
        

        $sql = "SELECT * FROM equipment_in_used;";
        $result = mysqli_query($con,$sql);

        $equipment_id = mysqli_num_rows( $result )+1;
        
        
        $sql = "INSERT INTO `event` (id, user_id, title, description, start_datetime, end_datetime, location, type, equipments, status)
        VALUES('$event_id','$user_id', '$event_title', '$event_description', '$event_start', '$event_end', '$event_location', '$event_type','$equipment_id', '$event_Status')";
        
        $result = mysqli_query($con,$sql);
        if($result){
            // add equipments in used to the database
            $temp_keys = $equipments_keys;
            $temp_values = $equipments_values;
            array_unshift($temp_values, $equipment_id, $event_id);
            array_unshift($temp_keys, "id", "event_id");
            
            $sql = "INSERT INTO `equipment_in_used` (" . implode(', ',$temp_keys) . ") 
            VALUES (" . implode(', ',$temp_values) . ")";
            $result = mysqli_query($con,$sql);
            if($result){
                $sql = "SELECT remaining_no FROM equipments";
                $result = mysqli_query($con,$sql);
                if($result){
                    $remain = mysqli_fetch_all($result);
                    for($i=0; $i<count($equipments_keys); $i++){
                        $sql = "UPDATE `equipments` SET `remaining_no` = (`remaining_no` -".$equipments_values[$i].") WHERE equipment='".$equipments_keys[$i]."';";
                        $result = mysqli_query($con,$sql);
                        if($result){
                            continue;
                        }
                    }
                    
                header('location:index.php');
                }
                
                
                
            }

        }else{
            die(mysqli_error($con));
        }
    };
?>