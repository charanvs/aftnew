$(document).ready(function() {
    // Initialize Select2 on the source_table dropdown
    $('#source_table').select2({
        placeholder: 'Select a Source Table',
        width: '100%'
    });

    // Map source tables to destination tables
    const tableMapping = {
        'aft_judgement': 'judgements',
        'aft_dol_dependency': 'case_dependencies',
        'aft_registration': 'case_registrations',
        'aft_interim_judgements': 'interim_judgements',
        'aft_notifications': 'notifications',
        'aft_scrutiny': 'scrutinies'
    };

    // Update destination_table value when source_table changes
    $('#source_table').on('change', function() {
        const selectedSource = $(this).val();
        $('#destination_table').val(tableMapping[selectedSource] || '');
    });

    // Handle form submission
    $('#copyDataForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.message);
            },
            error: function(error) {
                alert('An error occurred while copying the data.');
            }
        });
    });
});