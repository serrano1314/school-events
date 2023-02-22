
<?php 
    session_start();

    if(isset($_SESSION['userdata'])){ 
        include 'db_connect.php';

        $sql = "SELECT * from users";
        if ($result = mysqli_query($con, $sql)) {
            $rowcount = mysqli_num_rows( $result );
        }
        
    }else{
        header("location: index.php");
        exit();
    }
?>
<?php include 'header.php' ?>
<?php include 'navbar.php' ?>
    <main id="main-content">
        <h1>
            <?php  
                
            ?>
        </h1>
        <section class="welcome-section" id='dashboard-section'>
            <?php
                echo 'logged in <br/>';
                echo 'Welcome '.$_SESSION['userdata']['user_type'].' ';
                echo $_SESSION['userdata']['first_name']; 
            
            ?>
        </section>
        <section class="manage-user" id='manage-user'>
         <h2>Manage User</h2>

            <div class="container" id="add-user">
                <!-- Button trigger add user modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                Add User
                </button>

                <!-- add user Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUserModalLabel">Add User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- add user form -->
                        <div class="form-group">
                            <label for="uname">Username:</label>
                            <input class="form-control" type="text" id="uname" name="username" value="default<?php echo $rowcount+1; ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input class="form-control" type="password" id="password" name="password" value="default123">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" type="email" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="fname">First name:</label>
                            <input class="form-control" type="text" id="fname" name="first_name">
                            <label for="mname">Middle name:</label>
                            <input class="form-control" type="text" id="mname" name="middle_name">
                            <label for="lname">Last name:</label>
                            <input class="form-control" type="text" id="lname" name="last_name">
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <input class="form-control" type="text" id="course" name="course">

                            <label for="year">Year:</label>
                            <input class="form-control" type="number" id="year" name="year">

                            <label for="section">Section:</label>
                            <input class="form-control" type="text" id="section" name="section">
                        </div>

                        <div class="form-group">
                            <label for="user-type">User Type:</label>
                            <select class="form-control" name="user_type" id="user-type">
                                <option value="administrator">Admin</option>
                                <option value="organizer">Organizer</option>
                                <option value="participant">Participant</option>
                            </select>
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" onclick="addUser()" class="btn btn-primary">Add User</button>
                    </div>
                    </div>
                </div>
                </div>
                
            </div>

            <div class="container">
                <!-- Update user Modal -->
                <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="updateUserModalLabel">Update User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- update user form -->
                            <div class="form-group">
                                <label for="uname">Username:</label>
                                <input class="form-control" type="text" id="update_uname" name="username">
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input class="form-control" type="password" id="update_password" name="password">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input class="form-control" type="email" id="update_email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="fname">First name:</label>
                                <input class="form-control" type="text" id="update_fname" name="first_name">
                                <label for="mname">Middle name:</label>
                                <input class="form-control" type="text" id="update_mname" name="middle_name">
                                <label for="lname">Last name:</label>
                                <input class="form-control" type="text" id="update_lname" name="last_name">
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <select class="form-control" name="gender" id="update_gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="course">Course:</label>
                                <input class="form-control" type="text" id="update_course" name="course">

                                <label for="year">Year:</label>
                                <input class="form-control" type="number" id="update_year" name="year">

                                <label for="section">Section:</label>
                                <input class="form-control" type="text" id="update_section" name="section">
                            </div>

                            <div class="form-group">
                                <label for="user-type">User Type:</label>
                                <select class="form-control" name="user_type" id="update_user-type">
                                    <option value="administrator">Admin</option>
                                    <option value="organizer">Organizer</option>
                                    <option value="participant">Participant</option>
                                </select>
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- display user table  -->
            <div class="container" id="display-user"></div>
            
        </section>


        <section class="test-section" id="testsection">
            <h2>test section</h2>

        </section>
        

        <section class="test-section2" id="testsection2">
            <h2>test section 2</h2>

        </section>

        <section class="test-section3" id="testsection3">
            <h2>test section 3</h2>

        </section>
    </main>
    <?php include 'footer.php'; ?>