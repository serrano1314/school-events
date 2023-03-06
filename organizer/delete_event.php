<?php
    include '../admin/db_connect.php';
    include 'get_equipments.php';
    if(isset($_POST['del_event_id'])){
        $event_id = $_POST['del_event_id'];
        $equipments = $_POST['event_equipments'];

        $sql = "UPDATE `event` SET status=0 where id = $event_id;";
        $result = mysqli_query($con,$sql);
        if($result){
            for($i=0; $i<count($EQUIPMENTS); $i++){
                $sql = "UPDATE `equipments` SET `remaining_no` = (`remaining_no` +".$equipments[$i].") WHERE equipment='".$EQUIPMENTS[$i][0]."';";
                $result = mysqli_query($con,$sql);
                if($result){
                    continue;
                }
            header('location:index.php');
        }
    }
    }
?>