
<?php 
    session_start();

    if(isset($_SESSION['userdata'])){ 
        include 'db_connect.php';
        echo 'Welcome '.$_SESSION['userdata']['user_type'].' ';
        echo $_SESSION['userdata']['first_name']; 

        $sql = "SELECT * from users";
        if ($result = mysqli_query($con, $sql)) {
            $rowcount = mysqli_num_rows( $result );
        }
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
                
            ?>
        </h1>
        <section id='manage-user'>
            <div id="add-user">
                <h2>Add User</h2>
                <form action="add_user.php" method="POST">
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
                    <option value="organizer">Organizer</option>
                    <option value="participant">Participant</option>
                </select><br>
                <button type="submit" name="submit">Add User</button>
                </form>
            </div>
        </section>


        <section id="display-user">
            <h2>User List</h2>
            <style>
                table, th, td {
                    border:1px solid black;
                    border-collapse: collapse;
                }
            </style>

            <table>
                <tr>
                    <th>id</th>
                    <th>username</th>
                    <th>user type</th>
                    <th>full name</th>
                    <th>gender</th>
                    <th>course/yr/sec</th>
                    <th>email</th>
                    <th>actions</th>
                </tr>

                <?php

                    $sql = "SELECT * from users WHERE is_user_active = '1'";
                    $active_users = mysqli_query($con, $sql);
                    while($users_row_data = mysqli_fetch_assoc($active_users)){
                        $user_id = $users_row_data['id'];
                        $user_username = $users_row_data['username'];
                        $user_usertype = $users_row_data['user_type'];
                        $user_fullname = $users_row_data['first_name'].' '.$users_row_data['last_name'];
                        $user_gender = $users_row_data['gender'];
                        $user_course_yr_sec = $users_row_data['course'].' '.$users_row_data['year'].' '.$users_row_data['section'];
                        $user_email = $users_row_data['email'];

                        echo '
                            <tr>
                                <td>'.$user_id.'</td>
                                <td>'.$user_username.'</td>
                                <td>'.$user_usertype.'</td>
                                <td>'.$user_fullname.'</td>
                                <td>'.$user_gender.'</td>
                                <td>'.$user_course_yr_sec.'</td>
                                <td>'.$user_email.'</td>
                                <td>
                                    <button><a href="update_user.php?id='.$user_id.'">Update</a></button>
                                    <button><a href="delete_user.php?id='.$user_id.'">Delete</a></button>
                                </td>
                            </tr>
                        ';
                    }
                ?>
                <tr>
                    <td>testid</td>
                    <td>testusername</td>
                    <td>testusertype</td>
                    <td>testfullname</td>
                    <td>testgender</td>
                    <td>testcorYrSec</td>
                    <td>testemail</td>
                </tr>
            </table>
        </section>

        </section>
    </main>
    <footer>
        <!-- must include php here instead-->
    </footer>
</body>
</html>