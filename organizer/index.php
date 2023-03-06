<?php 
    session_start();

    if($_SESSION['userdata']['user_type'] !== 'organizer'){
      header("location: ../index.php");
      exit();
    }
    
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
<?php include 'get_equipments.php'?>
<?php include 'header.php'?>
    <a href="../logout.php">logout</a>
    
    <!-- Button trigger modal -->
    <div class="modal fade" id="modalAddEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-left">
        <h4 class="modal-title w-100 font-weight-bold">Creating an Event</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- ADD EVENT MODAL -->
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
            for($i=0; $i<count($EQUIPMENTS); $i++){
                
                echo '<label for="'.$EQUIPMENTS[$i][0].'">'.$EQUIPMENTS[$i][0].': </label>';
                echo '<input type="number" class="form-control add_equipments" name="equipments_List['.$EQUIPMENTS[$i][0].']" min=0 max='.end($EQUIPMENTS[$i]).' value=0><br>';
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
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add_event">Add Event</button>
      </div>
        </form>
        
    </div>
  </div>
</div>

<div class="text-left">
  <a href="" class="btn btn-secondary btn-rounded mb-4" data-toggle="modal" data-target="#modalAddEvent">Add Event</a>
</div class="container">
   
    <div id='calendar'></div>

    <!-- update MODAL -->
    <div class="modal fade" id="modalUpdateEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Update Event</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
            <form>
            <div class="md-form mb-2">
          <i class="fas fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right" sfor="title">Event Title</label>
            <input type="text" class="form-control validate" name="title" id="update_title" required>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="event_description">Event Description:</label>
        <input type="text" name="description" class="form-control validate" id="update_event_description" required>
        </div>

        <div class="md-form mb-3">
          <i class="fas fa-lock prefix grey-text"></i>
        <label for="eventStart">Event Start:</label>
        <input data-error="wrong" data-success="right" type="datetime-local" name="start_datetime" id="update_eventStart" class="form-control" value="2023-02-07T07:33"/>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
        <label for="eventStart">Event End:</label>
        <input data-error="wrong" data-success="right" type="datetime-local" name="end_datetime" id="update_eventEnd" class="form-control" value="2023-02-07T07:33"/>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
        <label for="location">Event Location:</label>
        <input type="text" data-error="wrong" id="update_location" data-success="right" list="location" name="location" class="form-control" required/><br>
        <datalist >
            <option value="Gymnasium">
            <option value="IRTC Builing">
            <option value="Field">
        </datalist>
        </div>

        <div class="md-form mb-2">
          <i class="fas fa-lock prefix grey-text"></i>
          <label for="event_type">Event Type:</label>
            <select class="form-control" name="type" id="update_event_type">
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
          // get equipments 
          // $sql = "SELECT * FROM equipments";
          // $result = mysqli_query($con, $sql);
          // $equipments = mysqli_fetch_all($result);
          
        //   $sql = 'SELECT * FROM equipment_in_used WHERE event_id='.$event_id;
        //   $result = mysqli_query($con, $sql);
        //   $equipment_data =array_slice(mysqli_fetch_row($result), 2);

          
          for($i=0; $i<count($EQUIPMENTS); $i++){
              
              echo '<label for="'.$EQUIPMENTS[$i][0].'">'.$EQUIPMENTS[$i][0].': </label>';
            //   echo '<input type="number" id="'.$equipments[$i][1].'" name="equipments_List['.$equipments[$i][1].']" min=0 max='.end($equipments[$i])+$equipment_data[$i].' value='.$equipment_data[$i].'><br>';
                echo '<input class="form-control update_equipments" type="number" id="update_'.$EQUIPMENTS[$i][0].'"';
          }


            // $sql = 'SELECT * FROM equipments';
            // $result = mysqli_query($con, $sql);

            // while($equipment_data = mysqli_fetch_assoc($result)){
                
            //     echo '<label for="'.$equipment_data['equipment'].'">'.$equipment_data['equipment'].': </label>';
            //     echo '<input type="number" class="form-control equipments" name="equipments_List['.$equipment_data['equipment'].']" min=0 max='.$equipment_data['remaining_no'].' value=0><br>';
            // }
            
            
            $sql = "SELECT id FROM event ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($con, $sql);
            $last_event = mysqli_fetch_row($result);
            
        
        ?>
        </div>
        <input type="hidden" id="update_event_id" name="event_id">
        <input type="hidden" id="event_status" name="status" value="1">
      </div>
      <div class="modal-footer d-flex justify-content-center">
      <button type="button" class="btn btn-success" id="update_event">Update Event</button>
        <button type="button" class="btn btn-danger" id="delete_event" >Delete Event</button>
      </div>
            </form>
      </div>
    </div>
  </div>
</div>

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
<?php include 'footer.php'?>