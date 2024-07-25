@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Case Management
@endsection

<link rel="stylesheet" href="{{ asset('frontend/assets/css/home.css') }}" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .btn-spacing {
    margin-right: 10px;
  }

  .index-cell,
  .regno-cell,
  .padvocate-cell,
  .radvocate-cell {
    padding: 8px;
    text-align: center;
  }

  .index-cell {
    font-weight: bold;
  }

  .header-cell {
    font-weight: bold;
    font-size: 20px;
  }

  .regno-cell,
  .padvocate-cell,
  .radvocate-cell {
    font-size: 18px;
  }

  /* Custom CSS for pagination responsiveness */
  @media (max-width: 576px) {
    .pagination {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .pagination li {
      flex: 1 1 auto;
      text-align: center;
      margin-bottom: 10px;
    }

    .pagination li a, .pagination li span {
      display: block;
      width: 100%;
      text-align: center;
    }
  }

  /* Print Styles */
  @media print {
    body * {
      visibility: hidden;
    }
    .printableArea, .printableArea * {
      visibility: visible;
    }
    .printableArea {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }
    .print-header {
      text-align: center;
      margin-bottom: 20px;
    }
  }
</style>

<div class="reservation-widget-area pt-60 pb-70">
  <div class="container ml-5">
    <div class="tab reservation-tab ml-5">
      <ul class="tabs">
        @foreach (['File Number', 'Party Name', 'Advocate Name', 'Case Type', 'Date', 'Subject'] as $index => $tab)
          <li class="bg-secondary  m-1">
            <a href="#" class="default-btn btn-bg-four border-radius-5 btn-spacing tab-link" data-tab-index="{{ $index }}">
              <span class="text-white h6">{{ $tab }}</span>
            </a>
          </li>
        @endforeach
      </ul>

      <div class="tab_content current active pt-45">
        @foreach (['File Number', 'Party Name', 'Advocate', 'Case Type', 'Date', 'Subject'] as $key => $searchBy)
          <div class="tabs_item {{ $key === 0 ? 'current' : '' }}" data-tab-index="{{ $key }}">
            <div class="reservation-tab-item printableArea">
              <div class="row">
                <div class="col-lg-{{ $searchBy === 'Advocate' ? '3' : '4' }}">
                  <div class="side-bar-form">
                    <h3>Search By - {{ $searchBy }}</h3>
                    <form method="get"
                      action="{{ in_array($searchBy, ['File Number', 'Date', 'Subject']) ? route('judgements.page') : '#' }}">
                      <div class="row align-items-center">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label>
                              <h5>Select Bench</h5>
                            </label>
                            <select class="form-control">
                              <option>Principal Bench</option>
                              <option>Chandigarh</option>
                              <option>Chennai</option>
                              <option>Guwhati</option>
                              <option>Kolkata</option>
                            </select>
                          </div>
                        </div>
                        @if ($searchBy === 'File Number')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">Registration No</label>
                              <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="Registration No" id="fileno">
                                <span class="input-group-addon"></span>
                              </div>
                              <i class='bx bx-file-blank'></i>
                            </div>
                          </div>
                        @elseif ($searchBy === 'Date')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">Next Date</label>
                              <div class="input-group">
                                <input type="date" class="form-control search-input" placeholder="Date" id="casedate">
                                <span class="input-group-addon"></span>
                              </div>
                              <i class='bx bx-calendar'></i>
                            </div>
                          </div>
                        @elseif ($searchBy !== 'Case Type')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">{{ $searchBy }}</label>
                              <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="{{ $searchBy }}"
                                  id="{{ strtolower(str_replace(' ', '', $searchBy)) }}">
                                <span class="input-group-addon"></span>
                              </div>
                              <i
                                class='bx {{ $searchBy === 'File Number' ? 'bx-file-blank' : ($searchBy === 'Party Name' ? 'bx-rename' : ($searchBy === 'Advocate' ? 'bx-user-pin' : 'bx-calendar-check')) }}'></i>
                            </div>
                          </div>
                        @else
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label>Select Case Type</label>
                              <select class="form-control search-input" id="casetype">
                                <option value="1">OA</option>
                                <option value="2">TA</option>
                                <option value="4">CA</option>
                                <option value="3">AT</option>
                                <option value="7">MA</option>
                                <option value="5">RA</option>
                              </select>
                              <i class='bx bx-search-alt'></i>
                            </div>
                          </div>
                        @endif
                        <div class="col-lg-12 col-md-12">
                          <button id="filterButton{{ str_replace(' ', '', $searchBy) }}" type="button"
                            class="default-btn btn-bg-three border-radius-5">
                            Search {{ str_replace(' ', '', $searchBy) }}
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="col-lg-{{ $searchBy === 'Advocate' ? '9' : '8' }}">
                  <div class="reservation-widget-content">
                    <h2 class="print-header">Details of Cases - {{ $searchBy }}</h2>
                    <hr>
                    <button id="printButton" class="btn btn-primary">Print</button>
                    <table id="dataTable{{ str_replace(' ', '', $searchBy) }}" class="table bg-secondary text-white">
                      <thead></thead>
                      <tbody></tbody>
                      <tfoot>
                        <div class="d-flex justify-content-center">
                          <nav aria-label="Page navigation example">
                            <ul class="pagination" id="paginationLinks{{ str_replace(' ', '', $searchBy) }}"></ul>
                          </nav>
                        </div>
                      </tfoot>
                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Help Section -->
<div class="help-section mt-5">
  <div class="container">
    <h3>Help - Tab Navigation</h3>
    <ul>
      <li>Key 1 - Registration No Search</li>
      <li>Key 2 - Party Name Search</li>
      <li>Key 3 - Advocate Search</li>
      <li>Key 4 - Case Type Search</li>
      <li>Key 5 - Next Date Search</li>
      <li>Key 6 - Subject Search</li>
    </ul>
  </div>
</div>

<!-- Modals -->
<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Details of Case</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body printableArea">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h5>Basic Information</h5>
              <p><strong>Reg No:</strong> <span id="regNo"></span></p>
              <p><strong>Year:</strong> <span id="year"></span></p>
              <p><strong>Department:</strong> <span id="department"></span></p>
              <p><strong>Associated:</strong> <span id="associated"></span></p>
              <p><strong>DOR:</strong> <span id="dor"></span></p>
            </div>
            <div class="col-md-6">
              <h5>Advocates</h5>
              <p><strong>Petitioner Advocate:</strong> <span id="padvocate"></span></p>
              <p><strong>Respondent Advocate:</strong> <span id="radvocate"></span></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p><strong>Subject:</strong> <span id="subject"></span></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <h5>Case Information</h5>
              <p><strong>Petitioner:</strong> <span id="petitioner"></span></p>
              <p><strong>Respondent:</strong> <span id="respondent"></span></p>
            </div>
            <div class="col-md-6">
              <h5>PDF Documents</h5>
              <div id="pdfDocuments"></div>
              <p><strong>Status:</strong> <span id="status"></span></p>
              <p><strong>Remarks:</strong> <span id="remarks"></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="printButton" class="btn btn-primary">Print</button>
        <!-- <a href="#" id="pdfButton" class="btn btn-secondary">Download PDF</a> -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script>
  // You can pass the route name and base URL to JavaScript
  var generatePdfRoute = "{{ route('generate.pdf', ':id') }}";
</script>
<script>
        var baseUrl = "{{ route('cases.search.all') }}";
        var showUrl = "{{ route('case.show') }}";
</script>
<script src="{{ asset('frontend/assets/js/search_cases.js') }}"></script>

<script>
  $(document).ready(function() {
    // Trigger search on Enter key press
    $('.search-input').keypress(function(e) {
      if (e.which == 13) { // Enter key pressed
        e.preventDefault();
        $(this).closest('form').find('button[type="button"]').click();
      }
    });

    // Shortcut keys for tabs
    $(document).keydown(function(e) {
      switch (e.which) {
        case 49: // Key 1
          $('.tab-link[data-tab-index="0"]').click();
          break;
        case 50: // Key 2
          $('.tab-link[data-tab-index="1"]').click();
          break;
        case 51: // Key 3
          $('.tab-link[data-tab-index="2"]').click();
          break;
        case 52: // Key 4
          $('.tab-link[data-tab-index="3"]').click();
          break;
        case 53: // Key 5
          $('.tab-link[data-tab-index="4"]').click();
          break;
        case 54: // Key 6
          $('.tab-link[data-tab-index="5"]').click();
          break;
        default:
          return;
      }
      e.preventDefault();
    });

    // Tab switching functionality
    $('.tab-link').click(function(e) {
      e.preventDefault();
      var tabIndex = $(this).data('tab-index');

      $('.tabs_item').removeClass('current');
      $('.tabs_item[data-tab-index="' + tabIndex + '"]').addClass('current');

      $('.tab-link').parent().removeClass('current');
      $(this).parent().addClass('current');
    });

    // Print functionality
    $(document).on('click', '#printButton', function() {
      const printContents = document.querySelector("#myModal .modal-body").innerHTML;
      const modalTitle = $("#myModalLabel").text();
      const printWindow = window.open("", "_blank");
      printWindow.document.write(`
        <html>
        <head>
            <title>${modalTitle}</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                .container {
                    margin: 0 auto;
                    width: 80%;
                }
                .row {
                    display: flex;
                    flex-wrap: wrap;
                    margin-bottom: 20px;
                }
                .col-md-6 {
                    flex: 0 0 50%;
                    max-width: 50%;
                }
                .col-md-12 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }
                h5 {
                    font-size: 18px;
                    margin-bottom: 10px;
                }
                p {
                    margin: 5px 0;
                }
                .btn {
                    display: none;
                }
            </style>
        </head>
        <body>
            <h1>${modalTitle}</h1>
            <div class="container">
                ${printContents}
            </div>
        </body>
        </html>
      `);
      printWindow.document.close();
      printWindow.print();
    });
  });
</script>

@endsection
