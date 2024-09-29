@extends('frontend.main_master')

@section('main')

@section('title')
  AFT-PB | Advanced Search & Results
@endsection

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center rounded-top">
                <h2 class="mb-0">Export Database Table to Excel</h2>
            </div>
            <div class="card-body p-5">
                <form id="exportForm" action="{{ route('export') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="table" class="form-label h5">Select Table:</label>
                        <select name="table" id="table" class="form-control form-control-lg">
                            <option value="">-- Select Table --</option>
                            @foreach($tables as $table)
                                <option value="{{ $table }}">{{ $table }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary px-5">Export to Excel</button>
                    </div>
                </form>
                
                <!-- Loader -->
                <div id="loader" class="d-flex justify-content-center align-items-center mt-5" style="display: none;">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div class="text-center mt-2">
                    <p id="loadingText" style="display: none;">Exporting, please wait...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('exportForm').addEventListener('submit', function(event) {
        // Show the loader and loading text
        document.getElementById('loader').style.display = 'flex';
        document.getElementById('loadingText').style.display = 'block';
    });
</script>

@endsection
