<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
  <!-- loader-->
  <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
  <!-- Bootstrap CSS -->
  <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">

  <title>Wild Search</title>
</head>

<body>
  <h6 class="mb-0 text-uppercase">Judgements Information</h6>
  <button class="btn btn-danger" onclick="goBack()">
    <i class='bx bx-arrow-back'></i>
    Back
  </button>
  <p>Please wait information is loading....</p>
  <hr />
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example2" class="table table-striped table-bordered table-responsive">
          <thead>
            <tr>
              <th>Registration No</th>
              <th>Applicant</th>
              <th>P Advocate</th>
              <th>R Advocate</th>
              <th>Subject</th>
              <th>Corum</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
              <tr>
                <td>{{ $item->regno }}</td>
                <td>{{ $item->petitioner }}</td>
                <td>{{ $item->padvocate }}</td>
                <td>{{ $item->radvocate }}</td>
                <td>{{ $item->subject }}</td>
                <td>{{ $item->corum_descriptions }}</td>
                <td>{{ $item->mod }}</td>

              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Registration No</th>
              <th>Applicant</th>
              <th>P Advocate</th>
              <th>R Advocate</th>
              <th>Subject</th>
              <th>Status</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
      var table = $('#example2').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print']
      });

      table.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
  </script>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
  <!--app JS-->
  <script src="{{ asset('backend/assets/js/app.js') }}"></script>
</body>

</html>
