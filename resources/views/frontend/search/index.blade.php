@extends('frontend.main_master')

@section('title')
  AFT-PB | Advanced Search
@endsection

@section('main')
  <div class="container mt-5">
    <h6 class="mb-0 text-uppercase">Advanced Search</h6>
    <hr />

    <div class="card">
      <div class="card-body">
        <form action="{{ route('advanced.search.perform') }}" method="GET" id="searchForm">
          <div class="row">
            <div class="col-md-4 mb-3">
              <h6 class="mb-3">Search Orders</h6>
              <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuOrdersButton" data-bs-toggle="dropdown" aria-expanded="false">
                  Select Search Criteria
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuOrdersButton">
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuOrdersButton', 'Date Of Order', 'order_dol', 'orders', 'Please Enter Date of Order dd-mm-yyyy - Order')">Date Of Order</a></li>
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuOrdersButton', 'Registration No', 'order_registration_no', 'orders', 'Please Enter Registration No - Order')">Registration No</a></li>
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuOrdersButton', 'Applicant', 'order_applicant', 'orders', 'Please Enter Name of Applicant - Order')">Applicant</a></li>
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuOrdersButton', 'Advocate', 'order_advocate', 'orders', 'Please Enter Name of Advocate - Order')">Advocate</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <h6 class="mb-3">Search Judgements</h6>
              <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuJudgementsButton" data-bs-toggle="dropdown" aria-expanded="false">
                  Select Search Criteria
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuJudgementsButton">
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuJudgementsButton', 'Registration No', 'judgements_registration_no', 'judgements', 'Please Enter Registration No - Judgement')">Registration No</a></li>
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuJudgementsButton', 'Applicant', 'judgements_applicant', 'judgements', 'Please Enter Name of Applicant - Judgement')">Applicant</a></li>
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuJudgementsButton', 'Advocate', 'judgements_advocate', 'judgements', 'Please Enter Name of Advocate - Judgement')">Advocate</a></li>
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuJudgementsButton', 'Date Of Judgement', 'judgements_dor', 'judgements', 'Please Enter Date of Judgement dd-mm-yyyy - Judgement')">Date Of Judgement</a></li>
                  <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuJudgementsButton', 'Subject', 'judgements_subject', 'judgements', 'Please Enter Subject - Judgement')">Subject</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-4 mb-3">
                <h6 class="mb-3">Search Diary</h6>
                <div class="input-group">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuDiaryButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Search Criteria
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuDiaryButton">
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuDiaryButton', 'Applicant Name', 'diary_applicant', 'Diary', 'Please Enter Applicant - Diary')">Applicant Name</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuDiaryButton', 'Diary No', 'diary_diaryno', 'Diary', 'Please Enter Diary No - Diary')">Diary No</a></li>
                  </ul>
                </div>
              </div>
          </div>

          <input type="hidden" id="search_type" name="search_type" value="{{ request('search_type') }}">
          <input type="text" id="keyword" name="keyword" class="form-control mb-3" placeholder="Enter keyword" value="{{ request('keyword') }}">

          <div class="text-center">
            <button type="submit" id="searchButton" class="btn btn-primary btn-lg">Search</button>
            <button type="button" id="resetButton" class="btn btn-secondary btn-lg" onclick="resetForm()" style="display: none;">Reset</button>
            <div id="errorMessage" class="text-danger mt-2" style="display: none;">Choose only one option from Orders or Judgements or Diary.</div>
          </div>
        </form>
      </div>
    </div>
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
  <script>
    let selectedCategory = null;

    function updateDropdown(event, dropdownId, text, value, category, placeholder) {
      event.preventDefault(); // Prevent default action of the link
      document.getElementById(dropdownId).textContent = text;
      document.getElementById('search_type').value = value;
      document.getElementById('keyword').placeholder = placeholder; // Update the placeholder dynamically
      document.getElementById('keyword').focus(); // Set focus to the keyword input field

      if (selectedCategory === null) {
        selectedCategory = category;
      } else if (selectedCategory !== category) {
        document.getElementById('searchButton').disabled = true;
        document.getElementById('resetButton').style.display = 'inline-block';
        document.getElementById('errorMessage').style.display = 'block';
      }
    }

    function resetForm() {
      document.getElementById('dropdownMenuOrdersButton').textContent = 'Select Search Criteria';
      document.getElementById('dropdownMenuJudgementsButton').textContent = 'Select Search Criteria';
      document.getElementById('dropdownMenuDiaryButton').textContent = 'Select Search Criteria';
      document.getElementById('search_type').value = '';
      document.getElementById('keyword').value = '';
      document.getElementById('keyword').placeholder = 'Enter keyword';
      document.getElementById('searchButton').disabled = false;
      document.getElementById('resetButton').style.display = 'none';
      document.getElementById('errorMessage').style.display = 'none';
      selectedCategory = null;
    }
  </script>
@endsection
