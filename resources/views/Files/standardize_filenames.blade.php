<!DOCTYPE html>
<html>
<head>
    <title>Standardize Filenames</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Standardize Filenames</h1>
        <button id="standardizeButton" class="btn btn-primary">Standardize Filenames</button>
        <div id="result"></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#standardizeButton').click(function () {
                $.ajax({
                    url: "{{ url('/standardize-filenames') }}",
                    type: "GET",
                    success: function (response) {
                        $('#result').html(response);
                    },
                    error: function (xhr, status, error) {
                        $('#result').html('An error occurred: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
