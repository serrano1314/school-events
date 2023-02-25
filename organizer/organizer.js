
$(document).ready(function(){
    // getData();
    insert_data()
    $('#add_event').unbind().click(addEvent);
    $('#update_event').unbind().click(updateEvent);
})
// getData();
function display_calendar(data) {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 650,
      editable: true,
      headerToolbar:{
        center: 'dayGridMonth, timeGridWeek, timeGridDay'
      },
    events: data,
      // other events here
    eventClick: function(info) {
      
      getEventData(info);
      // change the border color just for fun
      info.el.style.borderColor = 'red';
    }
    });
    calendar.render();
};



// addEventBtn.on('click', getData)
// function getData(){
//     event_name = document.getElementsByClassName('eventName');
//     event_start = document.getElementsByClassName('eventStart');
//     event_end = document.getElementsByClassName('eventEnd');
    
//     data = Array();
    
//     for(i=0; i<event_name.length; i++){
//       data.push({title: event_name[i].innerText, start: event_start[i].innerText, end: event_end[i].innerText});
//     }
    
//     display_calendar(data)

// }

// insert data to calendar
function insert_data(){
  $.ajax({
    url:'display_calendar_data.php',
    method:'post', 
    success:function(data,status){
        data = JSON.parse(data)
        
        console.log(data);
        display_calendar(data);

    }
});
}

// // Add Event 
function addEvent(){
    var title_add = $('#title').val();
    var description_add = $('#event_description').val();
    var eventStart_add = $('#eventStart').val();
    var eventEnd_add = $('#eventEnd').val();
    var location_add = $('#location').val();
    var eventType_add = $('#event_type').val();
    var event_id = $('#event_id').val();
    var event_status = $('#event_status').val();

    var equipments = $('.add_equipments').map((_,el) => el.value).get();
    console.log(equipments);

    $.ajax({
      url:'add_event.php',
      method: 'post',
      data:{
          event_title: title_add,
          event_description: description_add,
          event_start: eventStart_add,
          event_end: eventEnd_add,
          event_location: location_add,
          event_type: eventType_add,
          equipments: equipments,
          event_id: event_id,
          event_status: event_status
      },
      success:function(data,status){
          console.log(status);
          alert(status);
          $('form').trigger('reset');
          $("#modalAddEvent").modal('toggle');
          insert_data();
          // // console.log(parseInt(data)+1);
          // $('#uname').val('default' + (parseInt(data)+1).toString());
          // displayUsersTable();
      }
  });
}

function getEventData(info){
  // alert('Event: ' + info.event.id);
  var event_id = info.event.id;
  $('#modalUpdateEvent').modal('toggle');

  $.ajax({
    url:'get_event_data.php',
    method:'post', 
    data:{
        event_id: event_id
    },
    success:function(data,status){
        data = JSON.parse(data)
        // console.log(data['title']);
        // console.log(data['equipments']);
        $('#update_event_id').val(data['id']);
        $('#update_title').val(data['title']);
        $('#update_event_description').val(data['description']);
        $('#update_eventStart').val(data['start_datetime']);
        $('#update_eventEnd').val(data['end_datetime']);
        $('#update_location').val(data['location']);
        $('#update_event_type').val(data['type']);
        // console.log(data['equipment_keys']);
        for(i=0; i<data['equipment_keys'].length; i++){
          // $('#update_'+data['equipment_keys'][i]);
          $('#update_'+data['equipment_keys'][i]).val(data['equipments'][i]);
        }


    }
  });
}

function updateEvent(){
  var event_titles = $('#update_title').val();
  var event_descriptions = $('#update_event_description').val();
  var event_starts = $('#update_eventStart').val();
  var event_ends = $('#update_eventEnd').val();
  var event_locations = $('#update_location').val();
  var event_types = $('#update_event_type').val();
  var event_ids = $('#update_event_id').val();
  var equipments = $('.update_equipments').map((_,el) => el.value).get();
  console.log(event_titles);
  $.ajax({
    url:'update_event.php',
    method:'post', 
    data:{
        event_id: event_ids,
        event_title: event_titles,
        event_description: event_descriptions,
        event_start: event_starts,
        event_end: event_ends,
        event_location: event_locations,
        event_type: event_types,
        equipments: equipments
    },
    success:function(data,status){
        // data = JSON.parse(data)
        // console.log(data['title']);
        // console.log(data['equipments']);
        $('form').trigger('reset');
        $("#modalUpdateEvent").modal('toggle');
        insert_data();
    }
  });
}

function delete_event(event_id){
  console.log("hello");
}