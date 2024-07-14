<!DOCTYPE html>
<html>

<head>
  <title>AFT PB | Daily Cause List</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

  <!-- Include Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    #calendar-container {
      margin-bottom: 20px;
    }

    #calendar {
      height: 70vh; /* Adjust this value as needed */
    }

    .modal-body iframe {
      width: 100%;
      height: calc(100vh - 200px); /* Adjust based on the modal header and footer height */
    }

    @media (max-width: 768px) {
      .modal-body iframe {
        height: calc(100vh - 150px); /* Adjust for smaller screens */
      }
    }
  </style>
</head>

<body>

  <div class="container text-center">
    <h5>Daily Cause List - User</h5>
    <hr class="bg-danger">

    <div id="calendar-container" class="col-md-8 offset-md-2 col-sm-10 offset-sm-1 p-3">
      <div id='calendar'></div>
    </div>
  </div>

  <!-- Modal for Event Form -->
  <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Add/Edit Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="eventForm">
            <div class="form-group">
              <label for="title">Event Title</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
              <label for="start">Start Date</label>
              <input type="date" class="form-control" id="start" name="start" required>
            </div>
            <div class="form-group">
              <label for="end">End Date</label>
              <input type="date" class="form-control" id="end" name="end" required>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control" id="category" name="category" required>
                <option value="Cause List">Cause List</option>
                <option value="Holidays">Holidays</option>
              </select>
            </div>
            <div class="form-group" id="pdfUrlGroup" style="display:none;">
              <label for="pdfUrl">PDF URL</label>
              <input type="url" class="form-control" id="pdfUrl" name="pdfUrl">
            </div>
            <input type="hidden" id="eventId" name="eventId">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveEvent">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for PDF Display -->
  <div class="modal fade" id="pdfDisplay" tabindex="-1" role="dialog" aria-labelledby="pdfDisplayLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfDisplayLabel">PDF Document</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <iframe id="pdfFrame" src="" width="100%" height="100%"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      var SITEURL = "{{ url('/') }}";

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      function addWeekendEvents(view) {
        var start = moment(view.start);
        var end = moment(view.end);
        var weekends = [];

        while (start.isBefore(end)) {
          if (start.day() === 6 || start.day() === 0) {
            weekends.push({
              start: start.clone().format('YYYY-MM-DD'),
              end: start.clone().add(1, 'days').format('YYYY-MM-DD'),
              rendering: 'background',
              color: '#FF6347' // Danger background color
            });
          }
          start.add(1, 'days');
        }

        $('#calendar').fullCalendar('addEventSource', weekends);
      }

      var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/fullcalender",
        displayEventTime: false,
        viewRender: function (view, element) {
          $('#calendar').fullCalendar('removeEvents', function (event) {
            return event.rendering === 'background';
          });
          addWeekendEvents(view);
        },
        eventRender: function (event, element, view) {
          if (event.category == 'Cause List') {
            element.css('background-color', 'green');
            element.append('<a href="#" class="show-pdf" data-url="' + event.pdfUrl + '">View PDF</a>');
          } else if (event.category == 'Holidays') {
            element.css('background-color', 'blue');
          }

          // Event click for PDF link
          element.find('.show-pdf').on('click', function (e) {
            e.preventDefault();
            $('#pdfFrame').attr('src', $(this).data('url'));
            $('#pdfDisplay').modal('show');
          });
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
          $('#eventForm')[0].reset();
          $('#eventId').val('');
          $('#start').val(moment(start).format('YYYY-MM-DD'));
          $('#end').val(moment(end).format('YYYY-MM-DD'));
          $('#pdfUrlGroup').hide();
          $('#eventModal').modal('show');

          $('#saveEvent').data('allDay', allDay);  // Save allDay state
        },
        eventDrop: function (event, delta) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

          $.ajax({
            url: SITEURL + '/fullcalenderAjax',
            method: 'POST',
            data: {
              title: event.title,
              start: start,
              end: end,
              id: event.id,
              category: event.category,
              pdfUrl: event.pdfUrl,
              type: 'update'
            },
            success: function (response) {
              displayMessage("Event Updated Successfully");
            }
          });
        },
        eventClick: function (event) {
          if (!event.rendering) { // Don't allow editing of background events
            $('#eventForm')[0].reset();
            $('#eventId').val(event.id);
            $('#title').val(event.title);
            $('#start').val(moment(event.start).format('YYYY-MM-DD'));
            $('#end').val(moment(event.end).format('YYYY-MM-DD'));
            $('#category').val(event.category);
            if (event.category == 'Cause List') {
              $('#pdfUrlGroup').show();
              $('#pdfUrl').val(event.pdfUrl);
            } else {
              $('#pdfUrlGroup').hide();
            }
            $('#eventModal').modal('show');
          }
        }
      });

      $('#category').on('change', function () {
        if ($(this).val() == 'Cause List') {
          $('#pdfUrlGroup').show();
        } else {
          $('#pdfUrlGroup').hide();
        }
      });

      $('#saveEvent').on('click', function () {
        var title = $('#title').val();
        var start = $('#start').val();
        var end = $('#end').val();
        var category = $('#category').val();
        var pdfUrl = $('#pdfUrl').val();
        var id = $('#eventId').val();
        var allDay = $('#saveEvent').data('allDay');  // Retrieve allDay state

        if (title && start && end && category && (category != 'Cause List' || pdfUrl)) {
          $.ajax({
            url: SITEURL + "/fullcalenderAjax",
            method: 'POST',
            data: {
              title: title,
              start: start,
              end: end,
              category: category,
              pdfUrl: pdfUrl,
              id: id,
              type: id ? 'update' : 'add'
            },
            success: function (data) {
              $('#eventModal').modal('hide');
              if (id) {
                calendar.fullCalendar('updateEvent', {
                  id: id,
                  title: title,
                  start: start,
                  end: end,
                  category: category,
                  pdfUrl: pdfUrl
                });
              } else {
                calendar.fullCalendar('renderEvent', {
                  id: data.id,
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay,
                  category: category,
                  pdfUrl: pdfUrl
                }, true);
              }
              calendar.fullCalendar('unselect');
              displayMessage("Event Saved Successfully");
            },
            error: function (xhr, status, error) {
              console.log(xhr.responseText);
              alert('Error: ' + error);
            }
          });
        } else {
          alert('Please fill all the required fields.');
        }
      });

      function displayMessage(message) {
        toastr.success(message, 'Event');
      }

      // Add passive event listeners for scroll-blocking events
      function addPassiveEventListener(target, eventName, listener) {
        target.addEventListener(eventName, listener, {
          passive: true
        });
      }

      addPassiveEventListener(document, 'touchstart', function () { });
      addPassiveEventListener(document, 'touchmove', function () { });
      addPassiveEventListener(document, 'wheel', function () { });
    });
  </script>

</body>

</html>
