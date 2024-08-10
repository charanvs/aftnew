@extends('frontend.main_master')

@section('title')
  AFT-PB | Daily Cause List
@endsection

@section('main')
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/home.css') }}" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Noto+Sans:wght@400;700&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Include necessary stylesheets and scripts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    #calendar-container {
      width: 80%;
      margin: 0 auto;
      /* Center the div */
      margin-bottom: 20px;
    }

    #calendar {
      min-height: 70vh;
      /* Adjust this value as needed */
    }

    .modal-body iframe {
      width: 100%;
      height: calc(100vh - 200px);
      /* Adjust based on the modal header and footer height */
    }

    @media (max-width: 768px) {
      .modal-body iframe {
        height: calc(100vh - 150px);
        /* Adjust for smaller screens */
      }
    }
  </style>

  <div class="container text-center">
    <h4>Daily Cause List - AFT PB</h4>
    <hr class="bg-danger">
    <div id="calendar-container" class="p-3">
      <div id='calendar'></div>
    </div>
  </div>


  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '{{ route('events.get') }}',
        eventContent: function(arg) {
          let content = document.createElement('div');
          content.classList.add('fc-event-content');

          let title = document.createElement('div');
          title.innerHTML = arg.event.title;
          content.appendChild(title);

          if (arg.event.extendedProps.category == 'Cause List') {
            title.style.backgroundColor = 'green';
            let pdfLink = document.createElement('a');
            pdfLink.href = arg.event.extendedProps.pdfUrl;
            pdfLink.target = '_blank';
            pdfLink.classList.add('show-pdf');
            pdfLink.textContent = 'View PDF';
            content.appendChild(pdfLink);
          } else if (arg.event.extendedProps.category == 'Holidays') {
            title.style.backgroundColor = 'blue';
          } else {
            title.style.backgroundColor = 'gray';
          }

          return {
            domNodes: [content]
          };
        },
        eventDidMount: function(info) {
          if (info.event.extendedProps.category == 'Holidays') {
            let eventEl = info.el;
            eventEl.style.whiteSpace = 'normal';
            eventEl.style.overflow = 'hidden';
            eventEl.style.textOverflow = 'ellipsis';
          }
        },
        dayCellDidMount: function(info) {
          if (info.date.getDay() === 0 || info.date.getDay() === 6) { // 0 = Sunday, 6 = Saturday
            info.el.classList.add('fc-day-sat');
            info.el.classList.add('fc-day-sun');
          }
        }
      });

      calendar.render();
    });
  </script>
@endsection
