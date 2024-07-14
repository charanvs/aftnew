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
</style>

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

<!-- Modals -->
<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body content goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        var baseUrl = "{{ route('diary.search') }}";
        var showUrl = "{{ route('diary.show') }}";
</script>
<script src="{{ asset('frontend/assets/js/diary_search.js') }}"></script>
@endsection
