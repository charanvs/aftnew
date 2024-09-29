@if (isset($results) && $results->isNotEmpty())
<div class="table-responsive">
  <table id="resultTable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>S.No</th>
        @if ($resultType !== 'Diary')
          <th>Reg. No</th>
          <th>Applicant</th>
          <th>Respondent Advocate</th>
          <th>Petitioner Advocate</th>
          @if ($searchType === 'order_dol')
            <th>Date of Order</th>
            <th>Court No</th>
          @endif
        @else
          <th>Diary No</th>
          <th>Applicant</th>
          <th>Presentation Date</th>
        @endif
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($results as $index => $item)
        @php
          $case = null;
          $interimJudgements = collect(); // Initialize as an empty collection
          $notifications = collect(); // Initialize as an empty collection
          // Check the result type and set the $case variable accordingly
          if ($resultType === 'Order') {
              $case = \App\Models\CaseRegistration::find($item->id);
              $interimJudgements = $case ? $case->interimJudgements : collect();
          } elseif ($resultType === 'Judgement') {
              $case = \App\Models\Judgement::find($item->id);
              $interimJudgements = $case ? $case->getInterimJudgements() : collect();
          } elseif ($resultType === 'Diary') {
              $case = \App\Models\Scrutiny::find($item->id);
              $notifications = $case ? $case->notifications : collect();
          }
           // Split the date by the hyphen and format it if necessary
           if ($resultType !== 'Diary' && isset($item['dod'])) {
                    $dateParts = explode('-', $item['dod']);
                    $year_judgement = $dateParts[2];
                    $month = $dateParts[1];
                    $monthNames = [
                        1 => 'January',
                        2 => 'February',
                        3 => 'March',
                        4 => 'April',
                        5 => 'May',
                        6 => 'June',
                        7 => 'July',
                        8 => 'August',
                        9 => 'September',
                        10 => 'October',
                        11 => 'November',
                        12 => 'December',
                    ];
                    $monthName = $monthNames[(int) $month];
                    $year_judgement = $year_judgement . '/' . $monthName;
                }
              @endphp
        <tr>
          <td>{{ $index + 1 }}</td>
          @if ($resultType !== 'Diary')
            <td>{{ $resultType === 'Order' ? $item->registration_no : $item->regno }}</td>
            <td>{{ $resultType === 'Order' ? $item->applicant : $item->petitioner }}</td>
            <td>{{ $item->radvocate }}</td>
            <td>{{ $item->padvocate }}</td>
            @if ($searchType === 'order_dol')
              <td>{{ $item->dependency_dol }}</td>
              <td>{{ $item->courtno }}</td>
            @endif
          @else
            <td>{{ $item->diary_no }}</td>
            <td>{{ $item->applicant_name }}</td>
            <td>{{ $item->date_of_presentation }}</td>
          @endif

          <td>
            <button type="button" class="btn btn-warning btn-md" data-toggle="modal"
              data-target="#caseModal{{ $item->id }}">
              View
            </button>

            <!-- First Modal -->
            @if ($resultType === 'Order' or $resultType === 'Judgement')
              <div class="modal fade" id="caseModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="caseModalLabel{{ $item->id }}" aria-hidden="true">
                @php
                  $regno = $resultType === 'Order' ? $item->registration_no : $item->regno;
                  $applicant = $resultType === 'Order' ? $item->applicant : $item->petitioner;
                  $folder_path = $resultType === 'Order' ? 'pending_cases' : 'disposed_cases';
                  $case_type = substr($regno, 0, 2);
                @endphp
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-secondary">
                      <h5 class="modal-title" id="caseModalLabel{{ $item->id }}">Case Details</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <p><strong>Registration No:</strong> {{ $regno }}</p>
                          <p><strong>Applicant:</strong> {{ $applicant }}</p>
                          <p><strong>Respondent Advocate:</strong> {{ $item->radvocate }}</p>
                          <p><strong>Petitioner Advocate:</strong> {{ $item->padvocate }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                          <p><strong>Date of Registration:</strong> {{ $item->date_of_registration }}</p>
                          <p><strong>Case Type:</strong> {{ $item->case_type }}</p>
                          <p><strong>Case Status:</strong> {{ $item->case_status }}</p>
                          @if ($searchType === 'order_dol')
                            <p><strong>Date of Order:</strong> {{ $item->dol }}</p>
                          @endif
                        </div>
                      </div>

                      <!-- Display related PDFs from interimJudgements -->
                      @if ($interimJudgements->isNotEmpty())
                        <div class="list-group">
                          @foreach ($interimJudgements as $judgement)
                            @php
                              $year = $resultType === 'Order' ? substr($judgement->dol, -4) : $year_judgement;
                              $pdfUrl =
                                  'https://aftdelhi.nic.in/assets/' .
                                  $folder_path .
                                  '/' .
                                  $year .
                                  '/' .
                                  $case_type .
                                  '/' .
                                  $judgement->pdfname;
                            @endphp
                            <a href="{{ $pdfUrl }}" target="_blank"
                              class="list-group-item list-group-item-action btn btn-success my-2">{{ $judgement->pdfname }}</a>
                          @endforeach
                        </div>
                      @else
                        <p class="text-muted">No related documents available.</p>
                      @endif
                      <!-- End of PDFs display -->

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      @if ($resultType === 'Judgement')
                        <a href="{{ 'https://aftdelhi.nic.in/assets/judgement/' . substr($item->dod, -4) . '/' . $item->case_type . '/' . $item->dpdf }}"
                          target="_blank" class="btn btn-info btn-md">
                          Pdf of Judgement
                        </a>
                      @endif
                      <button type="button" class="btn btn-primary"
                        onclick="printModalContent('caseModal{{ $item->id }}')">Print</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End First Modal -->
            @elseif ($resultType === 'Diary')
              <!-- Second Modal -->
              <div class="modal fade" id="caseModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="caseModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title" id="caseModalLabel{{ $item->id }}">Diary Details</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <p><strong>Diary No:</strong> {{ $item->diary_no }}</p>
                          <p><strong>Applicant:</strong> {{ $item->applicant_name }}</p>
                          <p><strong>Presented By:</strong> {{ $item->presented_by }}</p>
                          <p><strong>Nature of Document:</strong> {{ $item->nature_of_doc }}</p>
                          <p><strong>Respondent Advocate:</strong> {{ $item->radvocate }}</p>
                          <p><strong>Petitioner Advocate:</strong> {{ $item->padvocate }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                          <p><strong>Date of Registration:</strong> {{ $item->date_of_registration }}</p>
                          <p><strong>Date of Presentation:</strong> {{ $item->date_of_presentation }}</p>
                          <p><strong>Case Type:</strong> {{ $item->casetype }}</p>
                          <p><strong>Associated With:</strong> {{ $item->associated_with }}</p>
                          <p><strong>Case Status:</strong> {{ $item->case_status }}</p>
                          @if ($searchType === 'order_dol')
                            <p><strong>Date of Order:</strong> {{ $item->dol }}</p>
                          @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <p><strong>Nature of Grievance:</strong> {{ $item->nature_of_grievance }}</p>
                          <p><strong>Subject:</strong> {{ $item->subject }}</p>
                          <p><strong>Result:</strong> {{ $item->result }}</p>
                          <p><strong>Section Officer's Remark:</strong> {{ $item->section_officer_remark }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                          <p><strong>Deputy Registrar's Remark:</strong> {{ $item->deputy_registrar_remark }}</p>
                          <p><strong>Registrar's Remark:</strong> {{ $item->registrar_remark }}</p>
                          <p><strong>Not Completed Observations:</strong> {{ $item->not_completed_observations }}</p>
                          <p><strong>No. of Applicants:</strong> {{ $item->no_of_applicants }}</p>
                          <p><strong>No. of Respondents:</strong> {{ $item->no_of_respondents }}</p>
                        </div>
                      </div>

                      <!-- Display related notifications -->
                      @if ($notifications->isNotEmpty())
                        <div class="list-group">
                          @foreach ($notifications as $notification)
                            <div class="list-group-item">
                              <p><strong>Defect:</strong> {{ $notification->defect }}</p>
                              <p><strong>Rectified By:</strong> {{ $notification->rectified_by }}</p>
                              <p><strong>Nature:</strong> {{ $notification->nature }}</p>
                              <p><strong>Time Granted:</strong> {{ $notification->time_granted }}</p>
                              <p><strong>Rectified:</strong> {{ $notification->rectified }}</p>
                            </div>
                          @endforeach
                        </div>
                      @else
                        <p>No notifications found.</p>
                      @endif
                      <!-- End of notifications display -->

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary"
                      onClick="printModalContent('caseModal{{ $item->id }}')">Print</button>

                    </div>
                  </div>
                </div>
              </div>
              <!-- End Second Modal -->
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div>
@else
<p>No cases found matching your criteria.</p>
@endif

<script src="{{asset('script.js')}}"></script>