$(document).ready(function () {
    const calendarContainer = $("#calendar-container");

    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];

    const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    const currentYear = new Date().getFullYear();

    // Data structure mapping dates to PDF file names and holidays
    const eventData = {
        "2024-01-15": { type: "pdf", file: "report_january.pdf" },
        "2024-02-20": { type: "pdf", file: "report_february.pdf" },
        "2024-03-10": { type: "pdf", file: "report_march.pdf" },
        "2024-04-05": {
            type: "holiday",
            reason: "Holiday on account of Good Friday",
        },
        "2024-07-04": {
            type: "holiday",
            reason: "Holiday on account of Independence Day",
        },
        "2024-12-25": {
            type: "holiday",
            reason: "Holiday on account of Christmas",
        },
        // Add more entries as needed
    };

    function generateCalendar(year) {
        for (let month = 0; month < 12; month++) {
            let firstDay = new Date(year, month, 1).getDay();
            let daysInMonth = new Date(year, month + 1, 0).getDate();

            let monthContainer = $("<div>").addClass(
                "col mb-4 month-container"
            );
            let monthName = $("<div>")
                .addClass("month-name")
                .text(`${months[month]} ${year}`);
            let calendar = $("<div>").addClass("calendar");

            // Add day names
            daysOfWeek.forEach((day) => {
                calendar.append($("<div>").addClass("weekday").text(day));
            });

            // Add empty slots for days before the first day of the month
            for (let i = 0; i < firstDay; i++) {
                calendar.append($("<div>").addClass("empty"));
            }

            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                let dayOfWeek = new Date(year, month, day).getDay();
                let dayClass = "day";
                if (dayOfWeek === 0) {
                    dayClass += " sunday";
                } else if (dayOfWeek === 6) {
                    dayClass += " saturday";
                }

                let dateKey = `${year}-${String(month + 1).padStart(
                    2,
                    "0"
                )}-${String(day).padStart(2, "0")}`;
                let dayElement = $("<div>").addClass(dayClass).text(day);

                if (eventData[dateKey]) {
                    let event = eventData[dateKey];
                    if (event.type === "pdf") {
                        dayElement.addClass("pdf-day");
                        dayElement.on("click", function () {
                            window.open(event.file, "_blank");
                        });
                    } else if (event.type === "holiday") {
                        dayElement.addClass("holiday");
                        dayElement.attr("title", event.reason);
                        dayElement.tooltip();
                    }
                }

                calendar.append(dayElement);
            }

            monthContainer.append(monthName).append(calendar);
            calendarContainer.append(monthContainer);
        }
    }

    generateCalendar(currentYear);
});
