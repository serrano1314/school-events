<?php
    include 'db_connect.php';
    extract($_POST);
    $sql = "INSERT INTO `events` (user_id,title,description,start_datetime,end_datetime,location,type,equipments,status) 
    VALUES('$user_id_event','$eventTitle','$eventDescription','$eventStart','$eventEnd','$eventLocation','$eventType','',1)";

    $result = mysqli_query($con,$sql);

    // $sql = "SELECT * from events";
    // if ($result = mysqli_query($con, $sql)) {
    //     $rowcount = mysqli_num_rows( $result );
    //     echo $rowcount;
    // }


?>