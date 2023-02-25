
<?php 
    session_start();

    if($_SESSION['userdata']['user_type'] !== 'participant'){
        header("location: ../index.php");
        exit();
    }

    if(isset($_SESSION['userdata'])){ 

        echo 'Welcome '.$_SESSION['userdata']['user_type'].' ';
        echo $_SESSION['userdata']['first_name'];
        // echo 'valid';
    }else{
        header("location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant</title>
</head>
<body>
    <a href="../logout.php">logout</a>
</body>
</html>