
<?php 
    session_start();

    if($_SESSION['userdata']['user_type'] !== 'administrator'){
        header("location: ../index.php");
        exit();
    }
    
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
                            <form id="addUserForm">
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
                            </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="addUserButton" class="btn btn-primary">Add User</button>
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
                                <input type="hidden" id="update_user_id">
                                <label for="update_uname">Username:</label>
                                <input class="form-control" type="text" id="update_uname" name="update_uname">
                            </div>

                            <div class="form-group">
                                <label for="update_password">Password:</label>
                                <input class="form-control" type="password" id="update_password" name="update_password">
                            </div>

                            <div class="form-group">
                                <label for="update_email">Email:</label>
                                <input class="form-control" type="email" id="update_email" name="update_email">
                            </div>
                            <div class="form-group">
                                <label for="update_fname">First name:</label>
                                <input class="form-control" type="text" id="update_fname" name="update_fname">
                                <label for="update_mname">Middle name:</label>
                                <input class="form-control" type="text" id="update_mname" name="update_mname">
                                <label for="update_lname">Last name:</label>
                                <input class="form-control" type="text" id="update_lname" name="update_lname">
                            </div>

                            <div class="form-group">
                                <label for="update_gender">Gender:</label>
                                <select class="form-control" name="update_gender" id="update_gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="update_course">Course:</label>
                                <input class="form-control" type="text" id="update_course" name="update_course">

                                <label for="update_year">Year:</label>
                                <input class="form-control" type="number" id="update_year" name="update_year">

                                <label for="update_section">Section:</label>
                                <input class="form-control" type="text" id="update_section" name="update_section">
                            </div>

                            <div class="form-group">
                                <label for="update_user-type">User Type:</label>
                                <select class="form-control" name="update_user-type" id="update_user-type">
                                    <option value="administrator">Admin</option>
                                    <option value="organizer">Organizer</option>
                                    <option value="participant">Participant</option>
                                </select>
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="updateUserButton" class="btn btn-primary">Update</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- display user table  -->
            <div class="container" id="display-user"></div>
            
        </section>


        <section class="manage-event" id="manage-event">
            <h2>Manage Event</h2>
            <div class="container">
                <div class="row">

                    <div class="col" id="event-table">
                        <h3>Event Table</h3> 
                        <div id="add-event">
                            <!-- Button trigger add event modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
                            Add Event
                            </button>

                            <!-- add event Modal -->
                            <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="addEventModalLabel">Add Event</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add Event form -->
                                            <form id="addEventForm">
                                                <div class="form-group">
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <label for="eventStartDate">Start</label>
                                                            <input class="form-control" type="datetime-local" id="eventStartDate" name="eventStartDate">
                                                        </div>
                                                        <div class="col">
                                                            <label for="eventEndDate">End</label>
                                                            <input class="form-control" type="datetime-local" id="eventEndDate" name="eventEndDate">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" id="user_id_event" value="<?php echo $_SESSION['userdata']['id']; ?>">
                                                            <input class="form-control mb-2" type="text" id="eventTitle" name="eventTitle"  placeholder="Event Title..." require>
                                                            <textarea class="form-control mb-2" id="eventDescription" name="eventDescription" rows="4" cols="50" placeholder="Event Description..."></textarea>
                                                            <input class="form-control mb-2" type="text" id="eventLocation" name="eventLocation"  placeholder="Location...">
                                                            <input class="form-control mb-2" type="number" id="eventType" name="eventType"  placeholder="Type of Event...">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" id="addEventButton" class="btn btn-primary">Add Event</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <!-- display user table  -->
                        <div id="display-event"></div>
                    </div>


                    <div class="col" id="event-calendar">
                        <h3>Calendar</h3> 
                    </div>
                    
                </div>
            </div>
        </section>
        

        <section class="test-section2" id="testsection2">
            <h2>test section 2</h2>

        </section>

        <section class="test-section3" id="testsection3">
            <h2>test section 3</h2>

        </section>
    </main>
    <?php include 'footer.php'; ?>