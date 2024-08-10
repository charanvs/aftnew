@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Calendar Event</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Calendar Event</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ route('calendar.update', $event->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $event->id }}">

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Category</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="category" class="form-control" id="categorySelect" onchange="togglePdfField()">
                                            <option value="Holiday" {{ $event->category == 'Holiday' ? 'selected' : '' }}>Holiday</option>
                                            <option value="Cause List" {{ $event->category == 'Cause List' ? 'selected' : '' }}>Cause List</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Title</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="title" class="form-control" value="{{ $event->title }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Start Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" name="start_date" class="form-control" value="{{ $event->start }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">End Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" name="end_date" class="form-control" value="{{ $event->end }}" />
                                    </div>
                                </div>

                                <div class="row mb-3" id="pdfUploadField" style="display:none;">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Upload PDF</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input class="form-control" name="pdfurl" type="file" id="pdfurl">
                                    </div>
                                </div>

                                @if($event->pdfurl)
                                <div class="row mb-3" id="currentPdf" style="display:none;">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <a href="{{ asset($event->pdfurl) }}" target="_blank">View Current PDF</a>
                                    </div>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function togglePdfField() {
            var category = document.getElementById('categorySelect').value;
            var pdfField = document.getElementById('pdfUploadField');
            var currentPdf = document.getElementById('currentPdf');

            if (category === 'Cause List') {
                pdfField.style.display = 'block';
                if (currentPdf) {
                    currentPdf.style.display = 'block';
                }
            } else {
                pdfField.style.display = 'none';
                if (currentPdf) {
                    currentPdf.style.display = 'none';
                }
            }
        }

        // Call the function on page load to ensure the field is displayed correctly based on the initial selection
        document.addEventListener('DOMContentLoaded', function() {
            togglePdfField();
        });
    </script>
@endsection
