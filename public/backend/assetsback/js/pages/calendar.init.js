!(function (g) {
    "use strict";
    function e() {}
    (e.prototype.init = function () {
        var l = g("#event-modal"),
            t = g("#modal-title"),
            a = g("#form-event"),
            i = null,
            r = null,
            s = document.getElementsByClassName("needs-validation"),
            i = null,
            r = null;

        new FullCalendarInteraction.Draggable(
            document.getElementById("external-events"),
            {
                itemSelector: ".external-event",
                eventData: function (e) {
                    return {
                        title: e.innerText,
                        className: g(e).data("class"),
                    };
                },
            }
        );

        // Function to fetch events from the backend
        function fetchEvents(callback) {
            $.ajax({
                url: "/api/events", // URL to your route that returns events
                method: "GET",
                success: function (data) {
                    callback(data);
                },
                error: function (error) {
                    console.error("Error fetching events", error);
                    callback([]); // In case of error, return an empty array to avoid breaking FullCalendar
                },
            });
        }

        fetchEvents(function (events) {
            // Adding events for Saturdays and Sundays
            let date = new Date();
            let year = date.getFullYear();
            let month = date.getMonth();
            let weekends = [];

            for (let i = 1; i <= 31; i++) {
                let day = new Date(year, month, i);
                if (day.getDay() === 0 || day.getDay() === 6) {
                    weekends.push({
                        title: "Weekend",
                        start: day,
                        className: "bg-danger",
                        allDay: true,
                    });
                }
            }

            events = events.concat(weekends);

            var v = document.getElementById("calendar");
            var m = new FullCalendar.Calendar(v, {
                plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
                editable: !0,
                droppable: !0,
                selectable: !0,
                initialView: "dayGridMonth",
                themeSystem: "bootstrap",
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
                },
                events: events, // Use the events fetched from the backend
                eventClick: function (e) {
                    l.modal("show"),
                        a[0].reset(),
                        (i = e.event),
                        g("#event-title").val(i.title),
                        g("#event-category").val(i.classNames[0]),
                        (r = null),
                        t.text("Edit Event"),
                        (r = null);
                },
                dateClick: function (e) {
                    u(e);
                },
                eventDidMount: function (info) {
                    $(info.el).tooltip({
                        title: info.event.title,
                        placement: "top",
                        trigger: "hover",
                        container: "body",
                    });
                },
            });

            m.render();
        });

        function u(e) {
            l.modal("show"),
                a.removeClass("was-validated"),
                a[0].reset(),
                g("#event-title").val(),
                g("#event-category").val(),
                t.text("Add Event"),
                (r = e);
        }

        g(a).on("submit", function (e) {
            e.preventDefault();
            g("#form-event :input");
            var t,
                a = g("#event-title").val(),
                n = g("#event-category").val();
            !1 === s[0].checkValidity()
                ? (event.preventDefault(),
                  event.stopPropagation(),
                  s[0].classList.add("was-validated"))
                : (i
                      ? (i.setProp("title", a), i.setProp("classNames", [n]))
                      : ((t = {
                            title: a,
                            start: r.date,
                            allDay: r.allDay,
                            className: n,
                        }),
                        m.addEvent(t)),
                  l.modal("hide"));
        });

        g("#btn-delete-event").on("click", function (e) {
            i && (i.remove(), (i = null), l.modal("hide"));
        });

        g("#btn-new-event").on("click", function (e) {
            u({ date: new Date(), allDay: !0 });
        });
    }),
        (g.CalendarPage = new e()),
        (g.CalendarPage.Constructor = e);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.CalendarPage.init();
    })();
