<!DOCTYPE html>
<html>
<head>
    <title>Case Details</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Basic Information</h5>
                <p><strong>Reg No:</strong> {{ $data['registration_no'] }}</p>
                <p><strong>Year:</strong> {{ $data['year'] }}</p>
                <p><strong>Department:</strong> {{ $data['diaryno'] }}</p>
                <p><strong>Associated:</strong> {{ $data['case_type'] }}</p>
                <p><strong>DOR:</strong> {{ $data['dor'] }}</p>
            </div>
            <div class="col-md-6">
                <h5>Advocates</h5>
                <p><strong>Petitioner Advocate:</strong> {{ $data['padvocate'] }}</p>
                <p><strong>Respondent Advocate:</strong> {{ $data['radvocate'] }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Subject:</strong> {{ $data['location'] }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5>Case Information</h5>
                <p><strong>Petitioner:</strong> {{ $data['applicant'] }}</p>
                <p><strong>Respondent:</strong> {{ $data['respondent'] }}</p>
            </div>
            <div class="col-md-6">
                <h5>Court Information</h5>
                @foreach ($data['case_dependencies'] as $dependency)
                    <p><strong>Date Hearing:</strong> {{ \Carbon\Carbon::parse($dependency['dol'])->format('d-m-Y') }}</p>
                @endforeach
                <p><strong>Status:</strong> {{ $data['status'] == 1 ? 'Pending' : 'Disposed' }}</p>
                <p><strong>Remarks:</strong> {{ $data['reopened'] }}</p>
            </div>
        </div>
    </div>
</body>
</html>
