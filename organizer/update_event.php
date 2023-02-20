<?php 
    if(isset($_GET['event_id'])){
        include '../admin/db_connect.php';
        $event_id = $_GET['event_id'];

        $sql = "SELECT * FROM event WHERE id=$event_id";
        $result = mysqli_query($con, $sql);
        $event_data = mysqli_fetch_assoc($result);

        $event_title = $event_data['title'];
        $event_desc = $event_data['description'];
        $event_start = $event_data['start_datetime'];
        $event_end = $event_data['end_datetime'];
        $event_location = $event_data['location'];
        $event_type =$event_data['type'];
        
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
    <h3>Update Event</h3>
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
    </div>
</body>

</html>