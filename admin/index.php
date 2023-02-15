
<?php 
    session_start();

            }else{
    if(isset($_SESSION['userdata'])){ 
        
        echo 'logged in';
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
    <title>Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <a href="../logout.php">logout</a>
        <!-- must include php here instead-->
    </nav>
    <main id="main-content">
        <h1>
            <?php  
                include_once('db_connect.php');
                echo 'Welcome '.$_SESSION['userdata']['user_type'].' ';
                echo $_SESSION['userdata']['first_name']; 

                $sql = "SELECT * from users";
                if ($result = mysqli_query($con, $sql)) {
                    $rowcount = mysqli_num_rows( $result );
                }
            ?>
        </h1>
        <section id='manage-user'>
            <div id="add-user">
                <h2>Add User</h2>
                <form action="add_user.php">
                <label for="uname">Username:</label>
                <input type="text" id="uname" name="username" value="default<?php echo $rowcount+1; ?>"><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="default123"><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br>

                <label for="fname">First name:</label>
                <input type="text" id="fname" name="first_name"><br>
                <label for="mname">Middle name:</label>
                <input type="text" id="mname" name="middle_name"><br>
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="last_name"><br>
                
                <label for="gender">gender:</label>
                    <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br>

                <label for="course">Course:</label>
                <input type="text" id="course" name="course">

                <label for="year">Year:</label>
                <input type="number" id="year" name="year">

                <label for="section">Section:</label>
                <input type="text" id="section" name="section"><br>

                <label for="user-type">User Type:</label>
                    <select name="user_type" id="user-type">
                    <option value="administrator">Admin</option>
                    <option value="orgaznizer">Orgaznizer</option>
                    <option value="participant">Participant</option>
                </select><br>

                

                </form>
            </div>
        </section>
    </main>
    <footer>
        <!-- must include php here instead-->
    </footer>
</body>
</html>