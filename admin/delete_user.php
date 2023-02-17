<?php
    include 'db_connect.php';
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $sql = "UPDATE `users` SET is_user_active = '0' WHERE id = $user_id;";
        $result = mysqli_query($con,$sql);
        if($result){
            header('location:index.php');
        }else{
            die(mysqli_error($con));
        }
    }
?>