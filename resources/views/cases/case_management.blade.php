@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Case Management
@endsection

<link rel="stylesheet" href="{{ asset('frontend/assets/css/home.css') }}" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">

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

  /* Loader Styles */
  #loader {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
  }

  .loader-icon {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Responsive Table Styling */
  .table {
    margin-bottom: 0;
  }

  .table th, .table td {
    vertical-align: middle;
    white-space: nowrap;
  }

  .table-responsive {
    overflow-x: auto;
    margin-top: 20px;
  }

  /* Beautify Table */
  .table-striped > tbody > tr:nth-of-type(odd) {
    background-color: #f2f2f2;
  }

  .table thead th {
    background-color: #343a40;
    color: white;
  }

  .table-hover tbody tr:hover {
    background-color: #d3d3d3;
  }
</style>

<!-- Loader -->
<div id="loader" class="loader-icon"></div>

<!-- Case Management Area -->
<div class="reservation-widget-area pt-60 pb-70">
  <div class="container">
    <div class="tab reservation-tab">
      <ul class="tabs">
        @foreach (['File Number', 'Party Name', 'Advocate Name', 'Case Type', 'Date', 'By Date'] as $index => $tab)
          <li class="bg-secondary m-1">
            <a href="#" class="default-btn btn-bg-four border-radius-5 btn-spacing tab-link" data-tab-index="{{ $index }}">
              <span class="text-white h6">{{ $tab }}</span>
            </a>
          </li>
        @endforeach
      </ul>

      <div class="tab_content current active pt-45">
        @foreach (['File Number', 'Party Name', 'Advocate', 'Case Type', 'Date', 'By Date'] as $key => $searchBy)
          <div class="tabs_item {{ $key === 0 ? 'current' : '' }}" data-tab-index="{{ $key }}">
            <div class="reservation-tab-item printableArea">
              <div class="row">
                <div class="col-lg-4">
                  <div class="side-bar-form">
                    <h3>Search By - {{ $searchBy }}</h3>
                    <form method="get" action="#">
                      <div class="row align-items-center">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label><h5>Select Bench</h5></label>
                            <select class="form-control">
                              <option>Principal Bench</option>
                              <option>Chandigarh</option>
                              <option>Chennai</option>
                              <option>Guwahati</option>
                              <option>Kolkata</option>
                            </select>
                          </div>
                        </div>

                        <!-- Dynamic Input Fields for Different Search Criteria -->
                        @if ($searchBy === 'File Number')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">Registration No</label>
                              <input type="text" class="form-control search-input" id="fileno" placeholder="Registration No">
                            </div>
                          </div>
                        @elseif ($searchBy === 'By Date' || $searchBy === 'Date')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">{{ $searchBy === 'By Date' ? 'Search By Date' : 'Next Date' }}</label>
                              <input type="date" class="form-control search-input" id="{{ $searchBy === 'By Date' ? 'searchdate' : 'casedate' }}" placeholder="Date">
                            </div>
                          </div>
                        @elseif ($searchBy !== 'Case Type')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">{{ $searchBy }}</label>
                              <input type="text" class="form-control search-input" id="{{ strtolower(str_replace(' ', '', $searchBy)) }}" placeholder="{{ $searchBy }}">
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
                            </div>
                          </div>
                        @endif

                        <div class="col-lg-12">
                          <button id="filterButton{{ str_replace(' ', '', $searchBy) }}" type="button" class="default-btn btn-bg-three border-radius-5">
                            Search {{ str_replace(' ', '', $searchBy) }}
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- Table Display -->
                <div class="col-lg-8">
                  <div class="reservation-widget-content">
                    <h5 class="print-header text-danger">Please refresh the page for another search from the same tab</h5>
                  
                    <h2 class="print-header">Details of Cases - {{ $searchBy }}</h2>
                    <hr>

                    <!-- Table -->
                    <div class="table-responsive">
                      <table id="dataTable{{ str_replace(' ', '', $searchBy) }}" class="table table-striped table-hover table-bordered">
                        <thead></thead>
                        <tbody></tbody>
                        <tfoot>
                          <tr>
                            <td colspan="5">
                              <div class="d-flex justify-content-center">
                                <nav aria-label="Page navigation example">
                                  <ul class="pagination" id="paginationLinks{{ str_replace(' ', '', $searchBy) }}"></ul>
                                </nav>
                              </div>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- End of Table -->
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
