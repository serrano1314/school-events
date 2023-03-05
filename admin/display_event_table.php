<?php 
    include 'db_connect.php';
    if(isset($_POST['tableEventData'])){
        $table = '
        <table class="table table-striped table-hover my-3 " id="displayevent_table">
        <thead>
            <tr>
                <th>Event id</th>
                <th>Title</th>
                <th>Date Start</th>
                <th>Type</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>';

        $sql = "SELECT * from events WHERE is_event_active = '1'";
        $active_event = mysqli_query($con, $sql);

        while($event_row_data = mysqli_fetch_assoc($active_event)){
            $event_id = $event_row_data['id'];
            $event_title = $event_row_data['title'];
            $event_start = $event_row_data['start_datetime'];
            $event_type = $event_row_data['type'];
            $table.='
            <tr>
                <td>'.$event_id.'</td>
                <td>'.$event_title.'</td>
                <td>'.$event_start.'</td>
                <td>'.$event_type.'</td>
                <td>
                    <button class="btn btn-info" id="getEventDataButton" data-id='.$event_id.'><span class="fa fa-edit"></span></button>
                    <button class="btn btn-danger" onclick="deleteEvent('.$event_id.')"><span class="fa fa-trash"></span></button>
                </td>
            </tr>
            ';
        }
        
        $table.='
        </tbody>
        </table>';
        echo $table;
    }
?>