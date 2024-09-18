@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Daily Cause List
@endsection
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f9; /* Light background */
}

h1 {
    text-align: center;
    color: #2c3e50; /* Dark Blue */
    font-weight: 700;
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.tabs {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.tab {
    padding: 10px 20px;
    cursor: pointer;
    background-color: #e3eaf0;
    margin-right: 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-size: 1.2rem;
}

.tab.active {
    background-color: #3598db;
    color: white;
}

.tab:hover {
    background-color: #007bff;
    color: white;
}

.year-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 columns */
    gap: 20px;
    padding: 20px;
}

.month-container {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.month-header {
    background-color: #3598db;
    color: white;
    padding: 15px;
    font-weight: 600;
    font-size: 1.5rem;
    border-radius: 8px 8px 0 0;
}

.calendar-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.calendar-table th, .calendar-table td {
    padding: 10px;
    text-align: center;
    font-size: 1.1rem;
}

.calendar-table th {
    background-color: #007bff;
    color: white;
    font-weight: 600;
}

.calendar-table td {
    background-color: #f9f9f9;
}

/* Yellow background for holidays */
.holiday {
    background-color: #f7e98e !important; /* Softer yellow */
    color: black;
    font-weight: 600;
}

/* Light coral background for Saturdays and Sundays */
.saturday, .weekend {
    background-color: #ffb3b3 !important; /* Light coral */
    color: white;
    font-weight: 600;
}

/* Light gray background for court holidays */
.court-holiday {
    background-color: #d3d3d3 !important; /* Light gray */
    color: black;
    font-weight: 600;
}

.active-day {
    font-weight: bold;
    color: #2980b9; /* Blue color for active days */
    text-decoration: none;
}

/* Hover effect for links */
a:hover {
    text-decoration: underline;
}



    </style>

<h1>Full Year Calendar</h1>

<!-- Tabs for selecting the year -->
<div class="tabs" id="yearTabs">
    <div class="tab" data-year="2017">2017</div>
    <div class="tab" data-year="2018">2018</div>
    <div class="tab" data-year="2019">2019</div>
    <div class="tab" data-year="2020">2020</div>
    <div class="tab" data-year="2021">2021</div>
    <div class="tab" data-year="2022">2022</div>
    <div class="tab" data-year="2023">2023</div>
    <div class="tab" data-year="2024">2024</div>
    <div class="tab" data-year="2025">2025</div> <!-- New tab for 2025 -->
</div>

<!-- Container for the calendar -->
<div class="year-container" id="yearCalendar"></div>

<script>
    // Pass events data from Laravel to JavaScript
    const holidays = @json($holidays);
    const causelist = @json($causelist);
    const courtHolidays = @json($courtHolidays);

    // Convert events data to a usable format for the calendar
    const holidayData = {};
    holidays.forEach(event => {
        holidayData[event.start] = event.title;
    });

    const causelistData = {};
    causelist.forEach(event => {
        causelistData[event.start] = event.title;
    });

    const courtHolidayData = {};
    courtHolidays.forEach(event => {
        courtHolidayData[event.start] = event.title;
    });

    // Corrected day names array where Sunday is the first day of the week
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];  // Sunday to Saturday

    function generateYearCalendar(year) {
        const yearContainer = document.getElementById('yearCalendar');
        yearContainer.innerHTML = ''; // Clear the calendar

        // Get the last two digits of the year
        const shortYear = String(year).slice(-2);

        for (let month = 0; month < 12; month++) {
            const monthDiv = document.createElement('div');
            monthDiv.className = 'month-container';

            const monthHeader = `<div class="month-header">${monthNames[month]}</div>`;
            monthDiv.innerHTML = monthHeader;

            const calendarTable = document.createElement('table');
            calendarTable.className = 'calendar-table';

            // Create table header
            let headerRow = '<tr>';
            daysOfWeek.forEach(day => {
                headerRow += `<th>${day}</th>`;
            });
            headerRow += '</tr>';
            calendarTable.innerHTML = headerRow;

            // Create the days for the month
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDay = new Date(year, month, 1).getDay(); // 0 is Sunday

            let date = 1;
            for (let i = 0; i < 6; i++) { // 6 rows for the weeks
                let row = '<tr>';
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        row += '<td></td>'; // Empty cell for days from the previous month
                    } else if (date > daysInMonth) {
                        row += '<td></td>'; // Empty cell for days after the month ends
                    } else {
                        const dayString = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                        let dayClass = '';

                        // Check for holidays, court holidays, Sundays, and Saturdays
                        if (courtHolidayData[dayString]) {
                            dayClass = 'court-holiday';
                        } else if (holidayData[dayString]) {
                            dayClass = 'holiday';
                        } else if (j === 0) { // Sunday
                            dayClass = 'weekend';
                        } else if (j === 6) { // Saturday
                            dayClass = 'saturday'; // New class for Saturday
                        }

                        // Only add a link if the day is not a Saturday, Sunday, holiday, or court holiday
                        if (!dayClass) {
                            row += `<td class="">
                                        <a class="active-day" href="https://aftdelhi.nic.in/dailycauselist/${year}/${date}_${monthNames[month].substring(0, 3)}_${shortYear}.pdf" target="_blank">${date}</a>
                                    </td>`;
                        } else {
                            row += `<td class="${dayClass}">${date}</td>`;
                        }

                        date++;
                    }
                }
                row += '</tr>';
                calendarTable.innerHTML += row;

                if (date > daysInMonth) {
                    break; // Exit the loop when all days are printed
                }
            }

            monthDiv.appendChild(calendarTable);
            yearContainer.appendChild(monthDiv);
        }
    }

    // Add click event to each year tab
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            // Add active class to the clicked tab
            tab.classList.add('active');

            // Generate calendar for the selected year
            const selectedYear = tab.getAttribute('data-year');
            generateYearCalendar(selectedYear);
        });
    });

    // Automatically detect and display the current year on page load
    const currentYear = new Date().getFullYear();
    document.querySelector(`.tab[data-year="${currentYear}"]`).classList.add('active'); // Set current year tab as active
    generateYearCalendar(currentYear); // Display calendar for the current year on page load

</script>


@endsection