<!DOCTYPE html>
<html>
<head>
    <title>Case Details PDF</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
            width: 100%;
        }
        .header {
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 30px;
        }
        .content {
            margin: 20px 0;
        }
        .case-details {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .corum {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>ARMED FORCES TRIBUNAL, PRINCIPAL BENCH, NEW DELHI</h2>
        <h3>LIST OF BUSINESS</h3>
        <p>Date: {{ $date }}</p>
        <p>Timing: 10:30 AM to 01.00 PM & 02.00 PM to 04.30 PM</p>
        <p>COURT No. 1 (Ground Floor)</p>
        <p>THIS BENCH WILL NOT ASSEMBLE TODAY</p>
    </div>

    <div class="content">
        <div class="corum">
            <strong>CORAM:</strong> HON'BLE THE CHAIRPERSON<br>
            HON'BLE REAR ADMIRAL DHIREN VIG
        </div>

        <h3>ADMISSION MATTERS</h3>
        <table>
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Case No.</th>
                    <th>Parties Name</th>
                    <th>Advocate for Petitioner / Respondents</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cases as $index => $case)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $case->case_number }}</td>
                        <td>{{ $case->petitioner }}<br>V/s<br>{{ $case->respondent }}</td>
                        <td>{{ $case->petitioner_advocate }}<br>{{ $case->respondent_advocate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
    </div>
</body>
</html>
