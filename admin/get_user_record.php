<?php
    include 'db_connect.php';
    
    if(isset($_POST['user_id'])){
        $user_id = $_POST['user_id'];

        $sql = "SELECT * from users WHERE id = $user_id";
        $result = mysqli_query($con, $sql);

        while($row=mysqli_fetch_assoc($result)){
            $user_data = [];
            $user_data[0] = $row['id'];
            $user_data[1] = $row['username'];
            $user_data[2] = $row['password'];
            $user_data[3] = $row['email'];
            $user_data[4] = $row['first_name'];
            $user_data[5] = $row['middle_name'];
            $user_data[6] = $row['last_name'];
            $user_data[7] = $row['gender'];
            $user_data[8] = $row['course'];
            $user_data[9] = $row['year'];
            $user_data[10] = $row['section'];
            $user_data[11] = $row['user_type'];
        }
        echo json_encode($user_data);
    }
?>