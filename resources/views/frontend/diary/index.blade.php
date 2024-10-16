@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Diary
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

  .loader {
    position: fixed;
    left: 50%;
    top: 50%;
    z-index: 1000;
    width: 50px;
    height: 50px;
    margin: -25px 0 0 -25px;
    border: 6px solid #f3f3f3;
    border-radius: 50%;
    border-top: 6px solid #3498db;
    width: 60px;
    height: 60px;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

  .light-mode {
      background-color: #fff;
      color: #000;
  }

  .dark-mode {
      background-color: #2c2c2c;
      color: #ffffff;
  }

  /* Button styling for dark mode */
  .dark-mode .btn {
      background-color: #444;
      color: #fff;
  }

  /* Table header styling for dark mode */
  .dark-mode th {
      background-color: #333;
      color: #fff;
  }

  /* Table body cell styling for dark mode */
  .dark-mode td {
      color: #fff;
  }
    /* Custom light warning color */
    .bg-light-warning {
        background-color: #fff3cd; /* Lighter shade of Bootstrap warning color */
        color: #856404; /* Text color that contrasts with the background */
    }

     /* Custom styling for modal messages */
     .modal-message {
        font-family: 'Arial', sans-serif; /* You can change this to any other font */
        font-size: 18px;
        font-weight: bold;
        color: #2c3e50; /* Beautiful dark color for the text */
    }

    /* Styling for heading inside the modal */
    .modal-heading {
        font-family: 'Georgia', serif; /* A more elegant font for headings */
        font-size: 20px;
        font-weight: bold;
        color: #34495e; /* Darker color for headings */
    }

    /* Table styling for better readability */
    .modal-table {
        font-family: 'Verdana', sans-serif;
        font-size: 16px;
        color: #2c3e50;
    }

    /* Bold and beautiful message text */
    .important-message {
        font-weight: bold;
        color: #e74c3c; /* Highlight important messages in a reddish tone */
        font-size: 18px;
        text-align: center;
        margin-top: 15px;
    }

    /* Light background for better contrast */
    .modal-body {
        background-color: #f7f9fc; /* Light background color */
    }

    /* Button style */
    .btn-primary {
        background-color: #3498db;
        border: none;
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        padding: 10px 20px;
    }
</style>

<!-- Loader (hidden by default) -->
<div id="loader" class="loader" style="display:none;"></div>

<div class="reservation-widget-area pt-60 pb-70">
  <div class="container ml-5">
    <div class="tab reservation-tab ml-5">
      <ul class="tabs">
        @foreach (['Case No', 'Diary No', 'Applicant'] as $tab)
        <li class="bg-secondary m-1">
          <a href="#" class="default-btn btn-bg-four border-radius-5 btn-spacing">
            <span class="text-white h6">{{ $tab }}</span>
          </a>
        </li>
        @endforeach
      </ul>

      <div class="tab_content current active pt-45">
        @foreach (['Case No', 'Diary No', 'Applicant'] as $key => $searchBy)
        <div class="tabs_item {{ $key === 0 ? 'current' : '' }}">
          <div class="reservation-tab-item">
            <div class="row">
              <div class="col-lg-{{ $searchBy === 'Advocate' ? '3' : '4' }}">
                <div class="side-bar-form">
                  <h3>Search By - {{ $searchBy }}</h3>
                  <div class="bg-danger text-white text-bold" id="flash-message-container-{{ str_replace(' ', '', $searchBy) }}"></div>
                  <form method="get" action="{{ in_array($searchBy, ['File Number', 'Date', 'Subject']) ? route('judgements.page') : '#' }}">
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
                      @if ($searchBy === 'Case No')
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="h5">Case No</label>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Case No" id="caseno" required>
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bx-file-blank'></i>
                        </div>
                      </div>
                      @elseif ($searchBy === 'Date')
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label class="h5">Date</label>
                          <div class="input-group">
                            <input type="date" class="form-control" placeholder="Date" id="casedate" required>
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
                            <input type="text" class="form-control" placeholder="{{ $searchBy }}" id="{{ strtolower(str_replace(' ', '', $searchBy)) }}" required>
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx {{ $searchBy === 'Case No' ? 'bx-file-blank' : ($searchBy === 'Diary No' ? 'bx-rename' : ($searchBy === 'Advocate' ? 'bx-user-pin' : 'bx-calendar-check')) }}'></i>
                        </div>
                      </div>
                      @else
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Select Case Type</label>
                          <select class="form-control" id="casetype" required>
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
                        <a href="{{ route('judgements.search.wild') }}" type="button" class="default-btn btn-bg-three border-radius-5">
                          Search Any
                        </a>
                      </div>
                      @else
                      <div class="col-lg-12 col-md-12">
                        <button id="filterButton{{ str_replace(' ', '', $searchBy) }}" type="button" class="default-btn btn-bg-three border-radius-5">
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
                  <h2>Diary - {{ $searchBy }}</h2>
                  <hr>
                  <table id="dataTable{{ str_replace(' ', '', $searchBy) }}" class="table bg-secondary text-white">
                    <!-- Thead will be dynamically generated here -->
                    <tbody></tbody>
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

<!-- Modals -->
<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
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
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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


<script>
    var baseUrl = "{{ route('diary.search') }}";
    var showUrl = "{{ route('diary.show') }}";
</script>
<script src="{{ asset('frontend/assets/js/diary_search.js') }}"></script>

@endsection
