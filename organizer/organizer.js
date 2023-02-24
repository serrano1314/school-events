
$(document).ready(function(){
    // getData();
    insert_data()
    $('#add_event').unbind().click(addEvent);
    // $('#updateUserButton').unbind().click(updateUser);
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
      alert('Event: ' + info.event.id);
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

    var equipments = $('.equipments').map((_,el) => el.value).get();
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
          $("#modalLoginForm").modal('toggle');
          insert_data();
          // // console.log(parseInt(data)+1);
          // $('#uname').val('default' + (parseInt(data)+1).toString());
          // displayUsersTable();
      }
  });
}
