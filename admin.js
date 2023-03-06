var now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
const ctx = document.getElementById('myChart');
const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
// exammple data
createLineGraph()
function createLineGraph(){
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: month,
      datasets: [{
        label: 'Events Tally (2023)',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animations: {
        tension: {
          duration: 1000,
          easing: 'linear',
          from: .2,
          to: -.2,
          loop: true
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();

new gridjs.Grid({
  columns: ["Event Name", "Id", "Event Name", "Status", "Venue", "Description"],
  data: [
   
  ],
  pagination: {
    'limit': 7
  },
  sort: true,
  search: {
    enabled: true
  },
  language: {
    'search': {
      'placeholder': '🔍 Enter Event Name'
    },

  }
}).render(document.getElementById("wrapper"));