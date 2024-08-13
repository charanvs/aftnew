@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <h2>Copy Data from One Table to Another</h2>

    <!-- Form to initiate the data copy process -->
    <form id="copyDataForm" action="{{ route('copy.data.perform') }}" method="POST">
        @csrf

        <!-- Dropdown for Source Table -->
        <div class="form-group">
            <label for="source_table">Source Table:</label>
            <select id="source_table" class="form-control" name="source_table" onchange="updateDestinationTable(this.value)">
                <option value="">Select a Source Table</option>
                <option value="aft_judgement">aft_judgement</option>
                <option value="aft_dol_dependency">aft_dol_dependency</option>
                <option value="aft_notifications">aft_notifications</option>
                <option value="aft_registration">aft_registration</option>
                <!-- more options can be added here -->
            </select>
        </div>

        <!-- Input field for Destination Table -->
        <div class="form-group">
            <label for="destination_table">Destination Table:</label>
            <input type="text" name="destination_table" id="destination_table" class="form-control" required readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Copy Data</button>
    </form>
</div>

<script>
    function updateDestinationTable(selectedValue) {
        let destinationValue = '';

        switch(selectedValue) {
            case 'aft_judgement':
                destinationValue = 'judgements';
                break;
            case 'aft_dol_dependency':
                destinationValue = 'case_dependencies';
                break;
            case 'aft_notifications':
                destinationValue = 'notifications';
                break;
            case 'aft_registration':
                destinationValue = 'case_registrations';
                break;
            // Add more cases as needed
            default:
                destinationValue = ''; // Default value if no match found
        }

        document.getElementById('destination_table').value = destinationValue;
    }

    // Example function for handling form submission
    $('#copyDataForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert('Success: ' + response.message);
            },
            error: function(error) {
                alert('Error: An error occurred while copying the data.');
            }
        });
    });
</script>
@endsection
