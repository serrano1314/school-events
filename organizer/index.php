
<?php 
    session_start();

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
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <a href="../logout.php">logout</a>


    <h3>Add Event</h3>
    <form action="add_event.php" method="POSt">
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
        <input type="checkbox" data-target="1">Chairs
        <div style="display: none;" data-id="1">
        <label for="chairs">Chairs</label>
        <input type="number" id="chairs" name="chairs" min=0 value=0>
        </div>
        
        <input type="checkbox" data-target="2">Table
        <div style="display: none;" data-id="2">
        <label for="table">Table</label>
        <input type="number" id="table" name="table" min=0 value=0>
        </div>
    
        <input type="checkbox" data-target="3">Speakers
        <div style="display: none;" data-id="3">
        <label for="table">Spearker</label>
        <input type="number" id="table" name="speaker" min=0 value=0>
        </div>
        
        <input type="hidden" name="status" value="1">
        <br>
        <button type="submit" name="submit">Add Event</button>

    </form>



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
                </tr>
                <?php
                    include '../admin/db_connect.php';
                    $sql = "SELECT * from event WHERE status > 0;";
                    $events = mysqli_query($con, $sql);
                    
                    while($events_row_data = mysqli_fetch_assoc($events)){
                        $event_id = $events_row_data['id'];
                        $event_title = $events_row_data['title'];
                        $event_description = $events_row_data['description'];
                        $event_start = $events_row_data['start_datetime'];
                        $event_end = $events_row_data['end_datetime'];
                        $event_location = $events_row_data['location'];
                        $event_type = $events_row_data['type'];
                        $event_status = $events_row_data['status'];

                        echo '
                            <tr>
                                <td>'.$event_id.'</td>
                                <td>'.$event_title.'</td>
                                <td>'.$event_description.'</td>
                                <td>'.$event_start.'</td>
                                <td>'.$event_end.'</td>
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
<script>
    $('input[type=checkbox]').change(function(){
  $('div[data-id='+$(this).data('target')+']').toggle()
})
</script>
</html>