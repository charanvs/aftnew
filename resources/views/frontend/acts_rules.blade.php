@extends('frontend.main_master')

@section('title')
  AFT-PB | Acts and Rules
@endsection

@section('main')
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="container mt-5">
  <h2 class="text-center mb-4">Acts and Rules</h2>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="vacanciesTable" class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $rule)
              <tr>
                <td>{{ $rule->title }}</td>
                <td>{{ $rule->description }}</td>
                <td>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pdfModal" data-pdf="{{ asset('upload/acts/' . $rule->file) }}">
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

    $('#vacanciesTable').DataTable();
  });
</script>
@endsection
