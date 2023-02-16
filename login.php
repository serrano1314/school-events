<?php
    session_start();
    include 'admin/db_connect.php';

    if(isset($_POST['uname']) && isset($_POST['password'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $uname = validate($_POST['uname']);
        $pass = validate($_POST['password']);

        if(empty($uname)){
            header("location: index.php?error=Username field require");
            exit();
        }else if(empty($pass)){
            header("location: index.php?error=Password field require");
            exit();
        }else{
            echo "valid";

            $sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if($row['username'] === $uname && $row['password'] === $pass){
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['userdata'] = $row;
                    if($_SESSION['user_type'] === "administrator"){
                        header("location: admin/index.php");
                        exit();
                    }
                    if($_SESSION['user_type'] === "organizer"){
                        header("location: organizer/index.php");
                        exit();
                    } 
                    if($_SESSION['user_type'] === "participant"){
                        header("location: participant/index.php");
                        exit();
                    } 
                    
                }else{
                    header("location: index.php?error=Incorrect username or password");
                    exit();
                }
                
            }else{
                header("location: index.php?error=Incorrect username or password");
                exit();
            }

        }
    }
    else{
        header("location: index.php?error");
        exit();
    }
?>