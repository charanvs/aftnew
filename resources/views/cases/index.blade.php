@extends('admin.admin_dashboard')
@section('admin')
<div class="container">
    <h1>Cases</h1>
    <a href="{{ route('cases.create') }}" class="btn btn-primary">Add New Case</a>
    <a href="{{ route('daily.list.pdf') }}" class="btn btn-secondary">Generate PDF</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Case Number</th>
                <th>Petitioner</th>
                <th>Respondent</th>
                <th>Petitioner Advocate</th>
                <th>Respondent Advocate</th>
                <th>Date</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
            <tr>
                <td>{{ $case->case_number }}</td>
                <td>{{ $case->petitioner }}</td>
                <td>{{ $case->respondent }}</td>
                <td>{{ $case->petitioner_advocate }}</td>
                <td>{{ $case->respondent_advocate }}</td>
                <td>{{ $case->date }}</td>
                <td>{{ $case->type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
