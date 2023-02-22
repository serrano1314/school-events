<?php
    include 'db_connect.php';
    extract($_POST);

    $sql = "INSERT INTO `users` (username,password,email,first_name,middle_name,last_name,gender,course,year,section,user_type,is_user_active) 
    VALUES('$username','$password','$email','$first_name','$middle_name','$last_name','$gender','$course','$year','$section','$user_type',1)";

    $result = mysqli_query($con,$sql);

?>



<?php
    // include 'db_connect.php';
    // if(isset($_POST['submit'])){
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     $email = $_POST['email'];
    //     $first_name = $_POST['first_name'];
    //     $middle_name = $_POST['middle_name'];
    //     $last_name = $_POST['last_name'];
    //     $gender = $_POST['gender'];
    //     $course = $_POST['course'];
    //     $year = $_POST['year'];
    //     $section = $_POST['section'];
    //     $user_type = $_POST['user_type'];
        
    //     $sql = "INSERT INTO `users` (username,password,email,first_name,middle_name,last_name,gender,course,year,section,user_type,is_user_active) 
    //     VALUES('$username','$password','$email','$first_name','$middle_name','$last_name','$gender','$course','$year','$section','$user_type',1)";

    //     $result = mysqli_query($con,$sql);

    //     if($result){
    //         echo 'add user success';
    //         header('location:index.php');
    //     }else{
    //         die(mysqli_error($con));
    //     }
    // }


?>