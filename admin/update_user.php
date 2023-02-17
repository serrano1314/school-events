<?php
    include 'db_connect.php';
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $sql = "SELECT * from users WHERE id = $user_id";
        $result = mysqli_query($con, $sql);
        $users_row_data = mysqli_fetch_assoc($result);

        $user_id = $users_row_data['id'];

        $user_username = $users_row_data['username'];
        $user_password = $users_row_data['password'];
        $user_email = $users_row_data['email'];
        
        $user_first_name = $users_row_data['first_name'];
        $user_middle_name = $users_row_data['middle_name'];
        $user_last_name = $users_row_data['last_name'];
        $user_gender = $users_row_data['gender'];

        $user_course = $users_row_data['course'];
        $user_year = $users_row_data['year'];
        $user_section = $users_row_data['section'];
        
        $user_usertype = $users_row_data['user_type'];
    }

    if(isset($_POST['submit'])){

        $user_id = $_GET['id'];

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
        if($result){
            header('location:index.php');
        }else{
            die(mysqli_error($con));
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <a href="../logout.php">logout</a>
        <!-- must include php here instead-->
    </nav>
    <main>
    <section id="manage-user">
        <div id="edit-user">
            <h2>Update User</h2>
            <form action="" method="POST">
            <label for="uname">Username:</label>
            <input type="text" id="uname" name="username" value="<?php echo $user_username; ?>"><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $user_password; ?>"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" value="<?php echo $user_email; ?>" name="email"><br>

            <label for="fname">First name:</label>
            <input type="text" id="fname" value="<?php echo $user_first_name; ?>" name="first_name"><br>
            <label for="mname">Middle name:</label>
            <input type="text" id="mname" value="<?php echo $user_middle_name; ?>" name="middle_name"><br>
            <label for="lname">Last name:</label>
            <input type="text" id="lname" value="<?php echo $user_last_name; ?>" name="last_name"><br>
            
            <label for="gender">gender:</label>
            <select name="gender" id="gender">
                <option value="male" <?php if($user_gender === 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if($user_gender === 'female') echo 'selected'; ?>>Female</option>
                <option value="other" <?php if($user_gender === 'other') echo 'selected'; ?>>Other</option>
            </select><br>

            <label for="course">Course:</label>
            <input type="text" id="course" value="<?php echo $user_course; ?>" name="course">

            <label for="year">Year:</label>
            <input type="number" id="year" value="<?php echo $user_year; ?>" name="year">

            <label for="section">Section:</label>
            <input type="text" id="section" value="<?php echo $user_section; ?>" name="section"><br>

            <label for="user-type">User Type:</label>
            <select name="user_type" id="user-type">
                <option value="administrator" <?php if($user_usertype === 'administrator') echo 'selected'; ?>>Admin</option>
                <option value="organizer" <?php if($user_usertype === 'organizer') echo 'selected'; ?>>Organizer</option>
                <option value="participant" <?php if($user_usertype === 'participant') echo 'selected'; ?>>Participant</option>
            </select><br>
            <button type="submit" name="submit">Update User</button>
            </form>
        </div>
    </section>

    </main>
    
    <footer>

    </footer>
</body>
</html>

