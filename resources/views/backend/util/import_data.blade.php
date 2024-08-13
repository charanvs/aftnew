@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">AFT PB - Import Data</h5>
            <form class="row g-3" action="{{ route('import.data.perform') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12" id="sqlFile">
                    <div class="card">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input name="sql_file" type="file" class="form-control" id="inputGroupFile02" accept=".sql">
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

@endsection
