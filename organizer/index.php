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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <a href="../logout.php">logout</a>
    
    <!-- Button trigger modal -->
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-left">
        <h4 class="modal-title w-100 font-weight-bold">Creating an Event</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form>
        <div class="md-form mb-2">
          <i class="fas fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right" sfor="title">Event Title</label>
            <input type="text" class="form-control validate" name="title" id="title" required>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="event_description">Event Description:</label>
        <input type="text" name="description" class="form-control validate" id="event_description" required>
        </div>

        <div class="md-form mb-3">
          <i class="fas fa-lock prefix grey-text"></i>
        <label for="eventStart">Event Start:</label>
        <input data-error="wrong" data-success="right" type="datetime-local" name="start_datetime" id="eventStart" class="form-control" value="2023-02-07T07:33"/>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
        <label for="eventStart">Event End:</label>
        <input data-error="wrong" data-success="right" type="datetime-local" name="end_datetime" id="eventEnd" class="form-control" value="2023-02-07T07:33"/>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
        <label for="location">Event Location:</label>
        <input type="text" data-error="wrong" id="location" data-success="right" list="location" name="location" class="form-control" required/><br>
        <datalist >
            <option value="Gymnasium">
            <option value="IRTC Builing">
            <option value="Field">
        </datalist>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
          <label for="event_type">Event Type:</label>
            <select class="form-control" name="type" id="event_type">
                <option value="1">Meeting</option>
                <option value="2">Organization Event</option>
                <option value="3">Semester Kickoff</option>
                <option value="4">Others</option>
            </select>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
          <h4>Equipments</h4>
          <?php 
            $sql = 'SELECT * FROM equipments';
            $result = mysqli_query($con, $sql);

            while($equipment_data = mysqli_fetch_assoc($result)){
                
                echo '<label for="'.$equipment_data['equipment'].'">'.$equipment_data['equipment'].': </label>';
                echo '<input type="number" class="form-control equipments" name="equipments_List['.$equipment_data['equipment'].']" min=0 max='.$equipment_data['remaining_no'].' value=0><br>';
            }
            
            
            $sql = "SELECT id FROM event ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($con, $sql);
            $last_event = mysqli_fetch_row($result);
            
        
        ?>
        </div>
        <input type="hidden" id="event_id" name="event_id" value=<?php echo ($last_event) ?$last_event[0]+1 : 1; ?>>
        <input type="hidden" id="event_status" name="status" value="1">
      </div>
      <div class="modal-footer d-flex justify-content-center">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add_event">Add Event</button>
      </div>
        </form>
        
    </div>
  </div>
</div>

<div class="text-left">
  <a href="" class="btn btn-secondary btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Add Event</a>
</div class="container">
   
    <div id='calendar'></div>
<!-- 
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
    </div> -->
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="organizer.js"></script>
</html>