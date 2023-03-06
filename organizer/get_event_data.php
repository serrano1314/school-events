<?php 
    include '../admin/db_connect.php';
    include 'get_equipments.php';
    if(isset($_POST['event_id'])){
        $event_id = $_POST['event_id'];
        $sql = "SELECT * FROM event WHERE id=$event_id";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_row($result);

        $sql = "SELECT * FROM equipment_in_used WHERE event_id=$event_id";
        $result = mysqli_query($con, $sql);
        $equipment_Data = array_slice(mysqli_fetch_row($result), 2);
        $keys = array();

        foreach($EQUIPMENTS as $equipment){
            array_push($keys, $equipment[0]);
        }
        if($data){
            $event_data = array();

            $event_data['id'] = $data[0];
            $event_data['user_id'] = $data[1];
            $event_data['title'] = $data[2];
            $event_data['description'] = $data[3];
            $event_data['start_datetime'] = $data[4];
            $event_data['end_datetime'] = $data[5];
            $event_data['location'] = $data[6];
            $event_data['type'] = $data[7];
            $event_data['equipments'] = $data[8];
            $event_data['status'] = $data[9];
            $event_data['equipments'] = $equipment_Data;
            $event_data['equipment_keys'] = $keys;
        }
        echo json_encode($event_data);

    }
?>