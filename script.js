var now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
document.getElementById("eventStart").value = now.toISOString().slice(0,16);
document.getElementById("eventEnd").value = now.toISOString().slice(0,16);
document.getElementById("eventStart").min = now.toISOString().slice(0,16);

display_calendar();
function display_calendar(data) {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 650,
      editable: true,
    //   headerToolbar:{
    //     center: 'dayGridMonth, timeGridWeek, timeGridDay'
    //   },

      events:data
    });
    calendar.render();
};

addEventBtn = document.getElementById("addEvent")

addEventBtn.addEventListener('click', getData)
function getData(){
    event_name = document.getElementById("eventName").value
    event_start = document.getElementById("eventStart").value
    event_end = document.getElementById("eventEnd").value
    data = [
        {
            title:event_name,
            start:event_start,
            end: event_end
        }
    ]
    display_calendar(data)
}
