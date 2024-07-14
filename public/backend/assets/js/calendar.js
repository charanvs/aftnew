$(document).ready(function () {
    console.log("Document is ready");
    var calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        console.log("Initializing FullCalendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [
                "bootstrap",
                "interaction",
                "dayGrid",
                "timeGrid",
                "list",
            ],
            editable: true,
            droppable: true,
            selectable: true,
            defaultView: "dayGridMonth",
            themeSystem: "bootstrap",
            header: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
            },
            events: "/api/events", // Fetch events from your backend
            eventClick: function (info) {
                // Event click handler
            },
            dateClick: function (info) {
                // Date click handler
            },
        });

        calendar.render();
        console.log("FullCalendar has been initialized");
    } else {
        console.log("Calendar element not found");
    }
});
