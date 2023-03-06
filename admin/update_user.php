<?php
    include 'db_connect.php';

    extract($_POST);

    $user_id = $_POST['user_id'];

    $user_username = $_POST['username'];
    $user_password = $_POST['password'];
    $user_email = $_POST['email'];
    
    $user_first_name = $_POST['first_name'];
    $user_middle_name = $_POST['middle_name'];
    $user_last_name = $_POST['last_name'];
    $user_gender = $_POST['gender'];

    $user_course = $_POST['course'];
    $user_year = $_POST['year'];
    $user_section = $_POST['section'];
    
    $user_usertype = $_POST['user_type'];

    $sql = "UPDATE `users` SET username='$user_username',password='$user_password',email='$user_email',
            first_name='$user_first_name',middle_name='$user_middle_name',last_name='$user_last_name',gender='$user_gender',
            course='$user_course',year='$user_year',section='$user_section',user_type='$user_usertype'
            WHERE id=$user_id";
    $result = mysqli_query($con,$sql);

?>

