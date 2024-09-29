@extends('frontend.main_master')

@section('title')
  AFT-PB | Advanced Search & Results
@endsection

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

@section('main')
<div class="container mt-5">
  <h6 class="mb-0 text-uppercase">Advanced Search</h6>
  <hr />

  <div class="card">
    <div class="card-body">
      <form id="searchForm">
        <div class="row">
          <!-- Search Orders Dropdown -->
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

          <!-- Search Judgements Dropdown -->
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

          <!-- Search Diary Dropdown -->
          <div class="col-md-4 mb-3">
            <h6 class="mb-3">Search Diary</h6>
            <div class="input-group">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuDiaryButton" data-bs-toggle="dropdown" aria-expanded="false">
                Select Search Criteria
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuDiaryButton">
                <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuDiaryButton', 'Applicant Name', 'diary_applicant', 'Diary', 'Please Enter Applicant - Diary')">Applicant Name</a></li>
                <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuDiaryButton', 'Diary No', 'diary_diaryno', 'Diary', 'Please Enter Diary No - Diary')">Diary No</a></li>
                <li><a class="dropdown-item" href="#" onclick="updateDropdown(event, 'dropdownMenuDiaryButton', 'Presentation Date', 'diary_presentation_date', 'Diary', 'Please Enter Presentation Date as dd-mm-yyyy - Diary')">Presentation Date</a></li>
              </ul>
            </div>
          </div>
        </div>

        <input type="hidden" id="search_type" name="search_type">
        <input type="text" id="keyword" name="keyword" class="form-control mb-3" placeholder="Enter keyword" required>

        <div class="text-center">
          <button type="submit" id="searchButton" class="btn btn-primary btn-lg" disabled>Search</button>
          <button type="button" id="resetButton" class="btn btn-secondary btn-lg" onclick="resetForm()" style="display: none;">Reset</button>
          <div id="errorMessage" class="text-danger mt-2" style="display: none;">Choose only one option from Orders, Judgements, or Diary.</div>
        </div>
      </form>

      <!-- Animated Loader -->
      <div id="loader" style="display:none; text-align:center;">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <!-- Search Results will be displayed here -->
      <div id="searchResults"></div>
    </div>
  </div>
</div>
<div id="paginationLinks" class="mt-3"></div> <!-- Styled Pagination Links -->

<!-- JavaScript section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
// Declare selectedCategory globally
let selectedCategory = null;

// Pass the base URL from Laravel route to JavaScript
let baseUrl = "{{ route('advanced.search.perform') }}";

document.getElementById('searchForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting the traditional way

  // Show the loader while searching
  document.getElementById('loader').style.display = 'block';

  // Get the search type and keyword values
  let searchType = document.getElementById('search_type').value;
  let keyword = document.getElementById('keyword').value;

  // Fetch the first page of results
  fetchResults(searchType, keyword, 1);
});

function fetchResults(searchType, keyword, page = 1) {
    let url = `${baseUrl}?search_type=${encodeURIComponent(searchType)}&keyword=${encodeURIComponent(keyword)}&page=${page}`;

    // Fetch the search results using AJAX
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text(); // Get the raw text response
        })
        .then(text => {
            try {
                // Try to parse the text as JSON
                let data = JSON.parse(text);

                // Hide the loader
                document.getElementById('loader').style.display = 'none';

                if (data.html) {
                    document.getElementById('searchResults').innerHTML = data.html;
                    document.getElementById('paginationLinks').innerHTML = data.pagination;
                } else if (data.error) {
                    alert(data.error); // Handle error if any
                }
            } catch (err) {
                console.error('Error parsing JSON:', err);
                console.error('Raw response:', text); // Log the raw response for debugging
            }
        })
        .catch(error => {
            console.error("Error fetching search results:", error);
            document.getElementById('loader').style.display = 'none';
        });
}

// Define updateDropdown function
function updateDropdown(event, dropdownId, text, value, category, placeholder) {
  event.preventDefault(); // Prevent the default action of the link
  document.getElementById(dropdownId).textContent = text; // Update dropdown button text
  document.getElementById('search_type').value = value; // Update hidden search_type input value
  document.getElementById('keyword').placeholder = placeholder; // Update the keyword placeholder
  document.getElementById('keyword').focus(); // Set focus to the keyword input field

  // Enable the search button once the user selects a dropdown option
  document.getElementById('searchButton').disabled = false;

  // Handle error for selecting from different categories
  if (selectedCategory === null) {
    selectedCategory = category; // Save the selected category
  } else if (selectedCategory !== category) {
    document.getElementById('searchButton').disabled = true; // Disable search button if category changes
    document.getElementById('resetButton').style.display = 'inline-block'; // Show reset button
    document.getElementById('errorMessage').style.display = 'block'; // Show error message
  } else {
    document.getElementById('errorMessage').style.display = 'none'; // Hide error message if category matches
  }
}

// Function to reset the form
function resetForm() {
  document.getElementById('dropdownMenuOrdersButton').textContent = 'Select Search Criteria';
  document.getElementById('dropdownMenuJudgementsButton').textContent = 'Select Search Criteria';
  document.getElementById('dropdownMenuDiaryButton').textContent = 'Select Search Criteria';
  document.getElementById('search_type').value = '';
  document.getElementById('keyword').value = '';
  document.getElementById('keyword').placeholder = 'Enter keyword';
  document.getElementById('searchButton').disabled = true;
  document.getElementById('resetButton').style.display = 'none';
  document.getElementById('errorMessage').style.display = 'none';
  selectedCategory = null;
}

// Handle pagination click event
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('pagination-link')) {
        event.preventDefault();

        let page = event.target.getAttribute('data-page');
        let searchType = document.getElementById('search_type').value;
        let keyword = document.getElementById('keyword').value;

        // Fetch the results for the clicked page
        fetchResults(searchType, keyword, page);
    }
});

</script>
<script>
  function printModalContent(modalId) {
    var modalContent = document.getElementById(modalId).getElementsByClassName('modal-content')[0];
    var printWindow = window.open('', '', 'height=800,width=800');

    printWindow.document.write('<html><head><title>Print Modal Content</title>');
    printWindow.document.write(
      '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">'
    ); // Add Bootstrap CSS if necessary
    printWindow.document.write('</head><body>');
    printWindow.document.write(modalContent.innerHTML);
    printWindow.document.write('</body></html>');

    printWindow.document.close();

    // Wait for the new window content to be fully loaded before triggering print
    printWindow.focus(); // Ensure the new window is in focus
    printWindow.onload = function() {
      printWindow.print(); // Trigger the print dialog
      printWindow.onafterprint = function() {
        printWindow.close(); // Close the print window after printing
      };
    };
  }
</script>
<script>
 // JavaScript for handling the search
$(document).ready(function() {
  var table = $('#resultTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('advanced.search.perform') }}",
      data: function(d) {
        // Ensure both search_type and keyword are passed
        var searchType = $('#search_type').val();
        var keyword = $('#keyword').val();

        // Check if both parameters are present
        if (!searchType || !keyword) {
          alert("Please provide both search type and keyword.");
          return false;  // Abort the request
        }

        d.search_type = searchType; // Set search type
        d.keyword = keyword;        // Set keyword
      }
    },
    columns: [
      { data: 'id', name: 'id' },
      { data: 'registration_no', name: 'registration_no' },
      { data: 'applicant', name: 'applicant' },
      { data: 'radvocate', name: 'radvocate' },
      { data: 'padvocate', name: 'padvocate' },
      { data: 'dependency_dol', name: 'dependency_dol' },
      { data: 'courtno', name: 'courtno' },
      { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });

  // Handle form submission
  $('#searchForm').on('submit', function(e) {
    e.preventDefault();  // Prevent the form from being submitted the traditional way
    table.ajax.reload();  // Reload DataTable with new search criteria
  });
});


</script>

@endsection
