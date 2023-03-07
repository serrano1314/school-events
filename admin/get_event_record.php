<?php
    include 'db_connect.php';
    
    if(isset($_POST['event_id'])){
        $event_id = $_POST['event_id'];

        $sql = "SELECT * from events WHERE id = $event_id";
        $result = mysqli_query($con, $sql);

        while($row=mysqli_fetch_assoc($result)){
            $event_data = [];
            $event_data[0] = $row['id'];
            $event_data[1] = $row['user_id'];
            $event_data[2] = $row['title'];
            $event_data[3] = $row['description'];
            $event_data[4] = $row['start_datetime'];
            $event_data[5] = $row['end_datetime'];
            $event_data[6] = $row['location'];
            $event_data[7] = $row['type'];
            $event_data[8] = $row['equipments'];
            $event_data[9] = $row['status'];
        }
        echo json_encode($event_data);
    }
?>