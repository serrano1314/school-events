<?php
    include '../admin/db_connect.php';
    if(isset($_GET['event_id'])){
        $event_id = $_GET['event_id'];
        $sql = "UPDATE `event` SET status=0 where id = $event_id;";
        $result = mysqli_query($con,$sql);
        if($result){
            header('location:index.php');
        }else{
            die(mysqli_error($con));
        }
    }
?>