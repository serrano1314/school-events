<?php 
    session_start();
    include '../admin/db_connect.php';
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
    <title>Organizer</title>
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.1/main.min.css" rel="stylesheet"></link> -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.1/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <a href="../logout.php">logout</a>


    <h3>Add Event</h3>
    <form action="add_event.php" method="POST">
        <label for="title">Event Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="event_description">Event Description:</label>
        <input type="text" name="description" id="event_description" required><br>

        <label for="eventStart">Event Start:</label>
        <input type="datetime-local" name="start_datetime" id="eventStart" value="2023-02-07T07:33"/><br>

        <label for="eventStart">Event End:</label>
        <input type="datetime-local" name="end_datetime" id="eventEnd" value="2023-02-07T07:33"/><br>

        <label for="location">Event Location:</label>
        <input type="text" list="location" name="location" required/><br>
        <datalist id="location">
            <option value="Gymnasium">
            <option value="IRTC Builing">
            <option value="Field">
        </datalist>

        <label for="event_type">Event Type:</label>
        <select name="type" id="event_type"><br>
            <option value="1">Meeting</option>
            <option value="2">Organization Event</option>
            <option value="3">Semester Kickoff</option>
            <option value="4">Others</option>
        </select>

        
        <h4>Equipments</h4>
        <?php 
            $sql = 'SELECT * FROM equipments';
            $result = mysqli_query($con, $sql);

            while($equipment_data = mysqli_fetch_assoc($result)){
                
                echo '<label for="'.$equipment_data['equipment'].'">'.$equipment_data['equipment'].': </label>';
                echo '<input type="number" id="'.$equipment_data['equipment'].'" name="equipments_List['.$equipment_data['equipment'].']" min=0 max='.$equipment_data['remaining_no'].' value=0><br>';
            }
            
            
            $sql = "SELECT id FROM event ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($con, $sql);
            $last_event = mysqli_fetch_row($result);
            
        
        ?>
        <input type="hidden" name="event_id" value=<?php echo ($last_event) ?$last_event[0]+1 : 1; ?>>
        <input type="hidden" name="status" value="1">
        <br>
        <button type="submit" name="submit" id="addEvent">Add Event</button>

    </form>


    <div id='calendar'></div>

    <div class="event_content">
    <table>
                <tr>
                    <th>id</th>
                    <th>Event Title</th>
                    <th>Event Description</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM event WHERE status > 0;";
                    $events = mysqli_query($con, $sql);
                    $list = array();
                    while($events_row_data = mysqli_fetch_assoc($events)){
                        $event_id = $events_row_data['id'];
                        $event_title = $events_row_data['title'];
                        $event_description = $events_row_data['description'];
                        $event_start = $events_row_data['start_datetime'];
                        $event_end = $events_row_data['end_datetime'];
                        $event_location = $events_row_data['location'];
                        $event_type = $events_row_data['type'];
                        $event_status = $events_row_data['status'];
                        
                        $obj = new stdClass();
                        $obj->title = $event_title;
                        $obj->start = $event_start;
                        $obj->end = $event_end;

                        array_push($list, $obj);
                        
                        echo '
                            <tr>
                                <td>'.$event_id.'</td>
                                <td class="eventName">'.$event_title.'</td>
                                <td>'.$event_description.'</td>
                                <td class="eventStart">'.$event_start.'</td>
                                <td class="eventEnd">'.$event_end.'</td>
                                <td>'.$event_location.'</td>
                                <td>'.$event_type.'</td>
                                <td>'.$event_status.'</td>
                                <td>
                                    <button><a href="update_event.php?event_id='.$event_id.'">Update</a></button>
                                    <button><a href="delete_event.php?event_id='.$event_id.'">Delete</a></button>
                                </td>
                            </tr>
                        ';
                    }
                ?>
            </table>
    </div>
</body>
<script src="../script.js"></script>

</html>