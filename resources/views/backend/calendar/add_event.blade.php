@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">AFT PB - Add Daily Cause List</h5>
            <form class="row g-3" action="{{ route('calendar.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <label for="input7" class="form-label">Category</label>
                    <select id="input7" name="category" class="form-select" onchange="togglePdfField()">
                        <option selected>Choose...</option>
                        <option value="Holiday">Holiday</option>
                        <option value="Cause List">Cause List</option>
                        <option value="Court Holiday">Court Holiday</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="input3" class="form-label">Title</label>
                    <input name="title" type="text" class="form-control" id="input3" placeholder="Title">
                </div>

                <div class="col-md-12">
                    <label for="input6" class="form-label">Start Date</label>
                    <input name="start_date" type="date" class="form-control" id="input6" placeholder="Start Date">
                </div>
                <div class="col-md-12">
                    <label for="input6" class="form-label">End Date</label>
                    <input name="end_date" type="date" class="form-control" id="input6" placeholder="End Date">
                </div>
                <div class="col-md-12" id="pdfField" style="display:none;">
                    <div class="card">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input name="pdfurl" type="file" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                        <button type="reset" class="btn btn-light px-4">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePdfField() {
        var category = document.getElementById('input7').value;
        var pdfField = document.getElementById('pdfField');

        if (category === 'Cause List') {
            pdfField.style.display = 'block';
        } else {
            pdfField.style.display = 'none';
        }
    }

    // Call the function on page load to ensure the field is displayed correctly based on the initial selection
    document.addEventListener('DOMContentLoaded', function() {
        togglePdfField();
    });
</script>
@endsection
