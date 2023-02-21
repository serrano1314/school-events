var now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
document.getElementById("eventStart").value = now.toISOString().slice(0,16);
document.getElementById("eventEnd").value = now.toISOString().slice(0,16);
document.getElementById("eventStart").min = now.toISOString().slice(0,16);
getData();
function display_calendar(data) {
    
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 650,
      editable: true,
      headerToolbar:{
        center: 'dayGridMonth, timeGridWeek, timeGridDay'
      },

    events: data
    });
    calendar.render();
};

addEventBtn = document.getElementById("addEvent")

addEventBtn.addEventListener('click', getData)
function getData(){
    event_name = document.getElementsByClassName('eventName');
    event_start = document.getElementsByClassName('eventStart');
    event_end = document.getElementsByClassName('eventEnd');
    
    data = Array();
    
    for(i=0; i<event_name.length; i++){
      data.push({title: event_name[i].innerText, start: event_start[i].innerText, end: event_end[i].innerText});
    }
    console.log(data);
    display_calendar(data)

}
