@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Judgements
@endsection

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
</style>

<div class="reservation-widget-area pt-60 pb-70">
  <div class="container ml-5">
    <div class="tab reservation-tab ml-5">
      <ul class="tabs">
        @foreach (['File Number', 'Party Name', 'Advocate Name', 'Case Type', 'Date', 'Subject', 'Any'] as $tab)
          <li class="bg-secondary  m-1">
            <a href="#" class="default-btn btn-bg-four border-radius-5 btn-spacing">
              <span class="text-white h6">{{ $tab }}</span>
            </a>
          </li>
        @endforeach
      </ul>

      <div class="tab_content current active pt-45">
        @foreach (['File Number', 'Party Name', 'Advocate', 'Case Type', 'Date', 'Subject', 'Any'] as $key => $searchBy)
          <div class="tabs_item {{ $key === 0 ? 'current' : '' }}">
            <div class="reservation-tab-item">
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
                                <input type="text" class="form-control" placeholder="Registration No" id="fileno">
                                <span class="input-group-addon"></span>
                              </div>
                              <i class='bx bx-file-blank'></i>
                            </div>
                          </div>
                        @elseif ($searchBy === 'Date')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">Judgement Date</label>
                              <div class="input-group">
                                <input type="date" class="form-control" placeholder="Date" id="casedate">
                                <span class="input-group-addon"></span>
                              </div>
                              <i class='bx bx-calendar'></i>
                            </div>
                          </div>
                        @elseif ($searchBy === 'Any')
                          <div class="col-lg-12">

                          </div>
                        @elseif ($searchBy !== 'Case Type')
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label class="h5">{{ $searchBy }}</label>
                              <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ $searchBy }}"
                                  id="{{ strtolower(str_replace(' ', '', $searchBy)) }}">
                                <span class="input-group-addon"></span>
                              </div>
                              @if ($searchBy !== 'Date')
                                <i
                                  class='bx
        {{ $searchBy === 'File Number'
            ? 'bx-file-blank'
            : ($searchBy === 'Party Name'
                ? 'bx-rename'
                : ($searchBy === 'Advocate'
                    ? 'bx-user-pin'
                    : 'bx-calendar-check')) }}'>
                                </i>
                              @endif
                            </div>
                          </div>
                        @else
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label>Select Case Type</label>
                              <select class="form-control" id="casetype">
                                <option value="OA">OA</option>
                                <option value="TA">TA</option>
                                <option value="CA">CA</option>
                                <option value="AT">AT</option>
                                <option value="MA">MA</option>
                                <option value="RA">RA</option>
                              </select>
                              <i class='bx bx-search-alt'></i>
                            </div>
                          </div>
                        @endif
                        @if ($searchBy === 'Any')
                          <div class="col-lg-12 col-md-12">
                            <a href="{{ route('judgements.search.wild') }}" type="button"
                              class="default-btn btn-bg-three border-radius-5">
                              Search Any
                            </a>
                          </div>
                        @else
                          <div class="col-lg-12 col-md-12">
                            <button id="filterButton{{ str_replace(' ', '', $searchBy) }}" type="button"
                              class="default-btn btn-bg-three border-radius-5">
                              Search {{ str_replace(' ', '', $searchBy) }}
                            </button>
                          </div>
                        @endif
                      </div>
                    </form>
                  </div>
                </div>

                <div class="col-lg-{{ $searchBy === 'Advocate' ? '9' : '8' }}">
                  <div class="reservation-widget-content">
                    <h2>Details of Judgements - {{ $searchBy }}</h2>
                    <hr>
                    <table id="dataTable{{ str_replace(' ', '', $searchBy) }}" class="table bg-secondary text-white">
                      <thead></thead>
                      <tbody></tbody>
                      <tfoot>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination" id="paginationLinks{{ str_replace(' ', '', $searchBy) }}"></ul>
                        </nav>
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
        <h5 class="modal-title">Details of Judgements</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body content goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalPDF" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body content goes here.</p>
      </div>
      <div class="modal-footer" id="modal_footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  var baseUrl = "{{ route('judgements.search.all') }}";
  var showUrl = "{{ route('judgements.show') }}";
  var pdfUrl = "{{ route('judgements.pdf') }}";
</script>
<script src="{{ asset('frontend/assets/js/mytabs.js') }}"></script>

<script>
    $(document).ready(function() {
        // Shortcut keys for tabs
        $(document).keydown(function(e) {
            switch (e.which) {
                case 49: // Key 1
                    $('.tabs li:nth-child(1) a').click();
                    break;
                case 50: // Key 2
                    $('.tabs li:nth-child(2) a').click();
                    break;
                case 51: // Key 3
                    $('.tabs li:nth-child(3) a').click();
                    break;
                case 52: // Key 4
                    $('.tabs li:nth-child(4) a').click();
                    break;
                case 53: // Key 5
                    $('.tabs li:nth-child(5) a').click();
                    break;
                case 54: // Key 6
                    $('.tabs li:nth-child(6) a').click();
                    break;
                case 55: // Key 7
                    $('.tabs li:nth-child(7) a').click();
                    break;
                default:
                    return;
            }
            e.preventDefault();
        });

        // Tab switching functionality
        $('.tabs li a').click(function(e) {
            e.preventDefault();
            var tabIndex = $(this).parent().index();

            $('.tabs_item').removeClass('current');
            $('.tabs_item').eq(tabIndex).addClass('current');

            $('.tabs li').removeClass('current');
            $(this).parent().addClass('current');
        });
    });
    $(document).ready(function() {

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
