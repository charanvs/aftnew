@extends('frontend.main_master')

@section('title')
  AFT-PB | Advanced Search
@endsection

@section('main')
  <div class="container mt-5">
    <h2 class="text-center mb-4">Advanced Search</h2>
    {{-- start of new code --}}

    <h6 class="mb-0 text-uppercase">Buttons with dropdowns</h6>
    <hr />

    <div class="card">
      <div class="card-body">
        <form action="{{ route('advanced.search.perform') }}" method="GET">
          <div class="input-group mb-3">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Search By
            </button>
            <ul class="dropdown-menu">
              <li><span class="dropdown-item" href="#"
                  onclick="document.getElementById('search_type').value='dol'">Date Of Order</span></li>
              <li><span class="dropdown-item" href="#"
                  onclick="document.getElementById('search_type').value='registration_no'">Registration No</span></li>
              <li><span class="dropdown-item" href="#"
                  onclick="document.getElementById('search_type').value='applicant'">Applicant</>
              </li>
              <li><a class="dropdown-item" href="#"
                  onclick="document.getElementById('search_type').value='radvocate'">Respondent Advocate</a></li>
              <li><a class="dropdown-item" href="#"
                  onclick="document.getElementById('search_type').value='padvocate'">Petitioner Advocate</a></li>
              <!-- Add more options as needed -->
            </ul>
            <input type="hidden" id="search_type" name="search_type" value="{{ request('search_type') }}">
            <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Enter keyword"
              value="{{ request('keyword') }}">
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Search</button>
          </div>
        </form>
      </div>
    </div>

    {{-- end of new code --}}

  </div>

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
  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
