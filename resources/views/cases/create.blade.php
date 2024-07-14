@extends('admin.admin_dashboard')
@section('admin')
  <div class="container">
    <h1>Add New Case</h1>
    <form action="{{ route('cases.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="case_number">Case Number</label>
        <input type="text" class="form-control" id="case_number" name="case_number" required>
        <div id="caseList" class="list-group" style="position: absolute; z-index: 1000; width: 100%;"></div>
      </div>
      <div class="form-group">
        <label for="petitioner">Petitioner</label>
        <input type="text" class="form-control" id="petitioner" name="petitioner" required>
      </div>
      <div class="form-group">
        <label for="respondent">Respondent</label>
        <input type="text" class="form-control" id="respondent" name="respondent" required>
      </div>
      <div class="form-group">
        <label for="petitioner_advocate">Petitioner Advocate</label>
        <input type="text" class="form-control" id="petitioner_advocate" name="petitioner_advocate" required>
      </div>
      <div class="form-group">
        <label for="respondent_advocate">Respondent Advocate</label>
        <input type="text" class="form-control" id="respondent_advocate" name="respondent_advocate" required>
      </div>
      <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <select class="form-control" id="type" name="type" required>
          <option value="Judgement">Judgement</option>
          <option value="Admission">Admission</option>
          <option value="Execution">Execution</option>
          <option value="Others">Others</option>
          <option value="Pleadings Not Complete">Pleadings Not Complete</option>
          <option value="Part Heard">Part Heard</option>
        </select>
      </div>
      <div class="form-group">
        <label for="corum_id">Corum</label>
        <select class="form-control" id="corum_id" name="corum_id[]" multiple required>
          @foreach ($corums as $corum)
            <option value="{{ $corum->id }}">{{ $corum->name }} ({{ $corum->designation }})</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="published">Published</label>
        <select class="form-control" id="published" name="published" required>
          <option value="0">Not Published</option>
          <option value="1">Published</option>
          <option value="2">Final Published</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#case_number').on('keyup', function() {
        var query = $(this).val();
        if (query.length > 2) {
          $.ajax({
            url: "{{ route('case.search') }}",
            type: "GET",
            data: {
              query: query
            },
            success: function(data) {
              $('#caseList').fadeIn();
              $('#caseList').html(data.map(function(caseReg) {
                return `<a href="#" class="list-group-item list-group-item-action" data-id="${caseReg.id}" data-registration-no="${caseReg.registration_no}" data-applicant="${caseReg.applicant}" data-respondent="${caseReg.respondent}" data-padvocate="${caseReg.padvocate}" data-radvocate="${caseReg.radvocate}">${caseReg.registration_no} - ${caseReg.applicant} vs ${caseReg.respondent}</a>`;
              }).join(''));
            }
          });
        } else {
          $('#caseList').fadeOut();
        }
      });

      $(document).on('click', '.list-group-item', function() {
        var caseReg = $(this);
        $('#case_number').val(caseReg.data('registration-no'));
        $('#petitioner').val(caseReg.data('applicant'));
        $('#respondent').val(caseReg.data('respondent'));
        $('#petitioner_advocate').val(caseReg.data('padvocate'));
        $('#respondent_advocate').val(caseReg.data('radvocate'));
        $('#caseList').fadeOut();
      });
    });
  </script>
@endsection
