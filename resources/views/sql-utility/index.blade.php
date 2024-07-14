<!DOCTYPE html>
<html>

<head>
  <title>SQL Utility</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Include Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">SQL Utility</h2>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ url('/sql-utility/validate') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="sql_file">SQL File:</label>
        <select id="sql_file" name="sql_file" class="form-control">
          @foreach ($fileNames as $fileName)
            <option value="{{ $fileName }}">{{ $fileName }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="table_name">Table Name:</label>
        <select id="table_name" name="table_name" class="form-control"></select>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <!-- Include Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetch('/sql-utility/tables')
        .then(response => response.json())
        .then(data => {
          let tableSelect = document.getElementById('table_name');
          data.forEach(table => {
            let option = document.createElement('option');
            option.value = table;
            option.text = table;
            tableSelect.appendChild(option);
          });
        });
    });
  </script>
</body>

</html>
