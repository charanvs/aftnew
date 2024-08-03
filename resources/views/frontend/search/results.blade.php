@extends('frontend.main_master')

@section('title')
  AFT-PB | Search Result
@endsection

@section('main')
  <div class="container mt-5">
    <h2 class="text-center mb-4">Search Results</h2>

    @if ($cases->isEmpty())
      <p>No cases found matching your criteria.</p>
    @else
      <div class="table-responsive">
        <table id="resultTable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Reg. No</th>
              <th>Applicant</th>
              <th>Respondent Advocate</th>
              <th>Petitioner Advocate</th>
              @if ($searchType === 'dol')
                <th>Date of Order</th>
                <th>Court No</th>
                <th></th>
              @endif
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cases as $index => $case)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $case->registration_no }}</td>
                <td>{{ $case->applicant }}</td>
                <td>{{ $case->radvocate }}</td>
                <td>{{ $case->padvocate }}</td>
                @if ($searchType === 'dol')
                  <td>{{ $case->dol }}</td>
                  <td>{{ $case->courtno }}</td>
                  @php
                    $casetype = substr($case->registration_no, 0, 2); // Extract first two characters of registration_no
                    $year = $case->year; // Assuming 'year' is a field in your case
                    $pdfUrl = "https://aftdelhi.nic.in/assets/pending_cases/{$year}/{$casetype}/{$case->pdfname}";
                  @endphp

                  <td>
                    @if ($case->pdfname)
                      <a href="{{ $pdfUrl }}" target="_blank">View PDF</a>
                    @else
                      N/A
                    @endif
                  </td>
                @endif
                <td>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#caseModal{{ $case->id }}">
                    View
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="caseModal{{ $case->id }}" tabindex="-1"
                    aria-labelledby="caseModalLabel{{ $case->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="caseModalLabel{{ $case->id }}">Case Details</h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12 col-md-6">
                              <p><strong>Registration No:</strong> {{ $case->registration_no }}</p>
                              <p><strong>Applicant:</strong> {{ $case->applicant }}</p>
                              <p><strong>Respondent Advocate:</strong> {{ $case->radvocate }}</p>
                              <p><strong>Petitioner Advocate:</strong> {{ $case->padvocate }}</p>
                            </div>
                            <div class="col-12 col-md-6">
                              <!-- Add more case details here -->
                              <p><strong>Date of Registration:</strong> {{ $case->date_of_registration }}</p>
                              <p><strong>Case Type:</strong> {{ $case->case_type }}</p>
                              <p><strong>Case Status:</strong> {{ $case->case_status }}</p>
                              @if ($searchType === 'dol')
                                <p><strong>Date of Order:</strong> {{ $case->dol }}</p>
                              @endif
                              <!-- Add more fields as necessary -->
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal -->
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
  <script>
    $(document).ready(function() {
      $('#resultTable').DataTable();
    });
  </script>

  <!-- Custom CSS -->
  <style>
    body {
      background-color: #e3f2fd;
    }

    .form-control {
      border: 1px solid #0275d8;
    }

    .form-label {
      color: #0275d8;
    }

    .btn-primary {
      background-color: #0275d8;
      border-color: #0275d8;
    }

    .btn-primary:hover {
      background-color: #025aa5;
      border-color: #025aa5;
    }

    .container h2 {
      color: #0275d8;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }

      .modal-lg {
        max-width: 100%;
      }

      .modal-body .row {
        flex-direction: column;
      }
    }
  </style>
@endsection
