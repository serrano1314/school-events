<?php
    include 'db_connect.php';
    // extract($_POST);
    if(isset($_POST['del_user_id'])){
        $user_id = $_POST['del_user_id'];
        $sql = "UPDATE `users` SET is_user_active = '0' WHERE id = $user_id;";
        $result = mysqli_query($con,$sql);
    }
?>