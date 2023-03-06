<!-- <?php 
    include '../admin/db_connect.php';
    if(isset($_GET['event_id'])){
        
        $event_id = $_GET['event_id'];

        $sql = "SELECT * FROM event WHERE id=$event_id";
        $result = mysqli_query($con, $sql);
        $event_data = mysqli_fetch_assoc($result);

        $event_title = $event_data['title'];
        $event_description = $event_data['description'];
        $event_start = $event_data['start_datetime'];
        $event_end = $event_data['end_datetime'];
        $event_location = $event_data['location'];
        $event_type =$event_data['type'];
        $event_id = $event_data['id'];

    }
?> -->
<?php 
    include 'get_equipments.php';
    include '../admin/db_connect.php';
    // if(isset($_POST['submit'])){
        
        // $event_title = $_POST['title'];
        // $event_description = $_POST['description'];
        // $event_start = $_POST['start_datetime'];
        // $event_end = $_POST['end_datetime'];
        // $event_location = $_POST['location'];
        // $event_type = $_POST['type'];
        // $event_Status = $_POST['status'];
        // $event_id = $_POST['event_id'];

        // $equipments_values = array_values($_POST['equipments_List']);
        // $equipments_keys = array_keys($_POST['equipments_List']);

        extract($_POST);

        
        $sql = "SELECT * FROM equipment_in_used WHERE id=$event_id";
        $result = mysqli_query($con,$sql);
        $old_equipment_no = array_slice(mysqli_fetch_row($result),2);
        
        
        $sql = "UPDATE `event` SET title='$event_title', description='$event_description', start_datetime='$event_start', end_datetime='$event_end', location='$event_location', type='$event_type'
        WHERE id=$event_id";
        
        $result = mysqli_query($con,$sql);
       
        if($result){
            $query = "";
            // add equipments in used to the database
            for($i=0; $i<count($EQUIPMENTS); $i++){
                $query .= $EQUIPMENTS[$i][0].'=\''.$equipments[$i].'\'';
                if($i+1< count($EQUIPMENTS)){
                    $query .= ', ';
                }
            }
        
            
            $sql = "UPDATE `equipment_in_used` SET $query
            WHERE event_id=$event_id";
            $result = mysqli_query($con,$sql);
        }
            if($result){
                for($i=0; $i<count($EQUIPMENTS); $i++){
                    $sql = "UPDATE `equipments` SET `remaining_no` = (`remaining_no` -".$equipments[$i]-$old_equipment_no[$i].") WHERE equipment='".$EQUIPMENTS[$i][0]."';";
                    $result = mysqli_query($con,$sql);
                    if($result){
                        continue;
                    }
            
                    
                header('location:index.php');
                }
                
                
                
            }

        // }else{
        //     die(mysqli_error($con));
        // }
        // header('location:index.php');
    // }
?>
<!-- <!DOCTYPE html>
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
    <form action="update_event.php" method="POSt">
        <label for="title">Event Title:</label>
        <input type="text" name="title" id="title" required value="<?php echo $event_title; ?>"><br>

        <label for="event_description">Event Description:</label>
        <input type="text" name="description" id="event_description" required value="<?php echo $event_description; ?>"><br>

        <label for="eventStart">Event Start:</label>
        <input type="datetime-local" name="start_datetime" id="eventStart" value="<?php echo date('Y-m-d\TH:i', strtotime($event_start));   ?>"/><br>

        <label for="eventStart">Event End:</label>
        <input type="datetime-local" name="end_datetime" id="eventEnd" value="<?php echo date('Y-m-d\TH:i', strtotime($event_start));   ?>"/><br>

        <label for="location">Event Location:</label>
        <input type="text" list="location" name="location" required value=<?php echo $event_location; ?>><br>
        <datalist id="location">
            <option value="Gymnasium">
            <option value="IRTC Builing">
            <option value="Field">
        </datalist>

        <label for="event_type">Event Type:</label>
        <select name="type" id="event_type"><br>
            <option value="1" <?php echo ($event_type == 1)? 'selected' : "";?>>Meeting</option>
            <option value="2" <?php echo ($event_type == 2) ? 'selected': "hello";?>>Organization Event</option>
            <option value="3" <?php echo ($event_type == 3) ? 'selected': "";?>>Semester Kickoff</option>
            <option value="4" <?php echo ($event_type == 4) ? 'selected': "";?>>Others</option>
        </select>

        <h4>Equipments</h4>
        <?php 
            // get equipments 
            $sql = "SELECT * FROM equipments";
            $result = mysqli_query($con, $sql);
            $equipments = mysqli_fetch_all($result);
            
            $sql = 'SELECT * FROM equipment_in_used WHERE event_id='.$event_id;
            $result = mysqli_query($con, $sql);
            $equipment_data =array_slice(mysqli_fetch_row($result), 2);

            
            for($i=0; $i<count($equipments); $i++){
                
                echo '<label for="'.$equipments[$i][1].'">'.$equipments[$i][1].': </label>';
                echo '<input type="number" id="'.$equipments[$i][1].'" name="equipments_List['.$equipments[$i][1].']" min=0 max='.end($equipments[$i])+$equipment_data[$i].' value='.$equipment_data[$i].'><br>';
            }
            
        
        ?>
        <input type="hidden" name="event_id" value=<?php echo $event_id; ?>>
        <input type="hidden" name="status" value="1">
        <br>
        <button type="submit" name="submit">Update Event</button>

    </form>
    </div>
</body>

</html> -->