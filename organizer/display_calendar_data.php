<?php 
include '../admin/db_connect.php';
 $sql = "SELECT * from event WHERE status = '1'";
 $active_users = mysqli_query($con, $sql);
$datas = array();
$eventData = mysqli_fetch_all($active_users);


foreach($eventData as $data){
    $temp['id'] = $data[0];
    $temp['title'] = $data[2];
    $temp['start'] = $data[4];
    $temp['end'] = $data[5];
    array_push($datas, $temp);
}

echo json_encode($datas);
?>