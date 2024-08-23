@extends('frontend.main_master')

@section('title')
  AFT-PB | Vacancies
@endsection

@section('main')
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
  .vacancies-title {
    font-size: 1.75rem;
    font-weight: bold;
    color: #2c3e50;
  }
  .table th {
    font-weight: bold;
    background-color: #343a40;
    color: #ffffff;
  }
  .table td {
    font-size: 1.1rem;
    font-weight: 500;
    color: #495057;
  }
  .btn-outline-primary {
    font-weight: bold;
    font-size: 0.9rem;
  }
</style>

<div class="container mt-5">
  <h2 class="text-center mb-4 vacancies-title">Current Vacancies</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table id="vacanciesTable" class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th class="text-center">View</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $vacancy)
              <tr>
                <td>{{ $vacancy->title }}</td>
                <td>{{ $vacancy->description }}</td>
                <td>{{ \Carbon\Carbon::parse($vacancy->start_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($vacancy->end_date)->format('d-m-Y') }}</td>
                <td class="text-center">
                  <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#pdfModal" data-pdf="{{ asset('upload/vacancy/' . $vacancy->file) }}">
                    View
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- PDF Modal -->
  <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe id="pdfIframe" src="" style="width:100%; height:500px;" frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#pdfModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var pdfUrl = button.data('pdf');
      var modal = $(this);
      modal.find('#pdfIframe').attr('src', pdfUrl);
    });

    $('#vacanciesTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true
    });
  });
</script>
@endsection
