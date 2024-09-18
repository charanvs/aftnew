@extends('admin.admin_dashboard')
@section('admin')
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <a href="{{ route('add.judgement') }}" class="btn btn-outline-primary px-5 radius-30"> Add Judgement</a>
          </ol>
        </nav>
      </div>

    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Banner</h6>
    <hr />
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>S No</th>
                <th>File No</th>
                <th>Year</th>
                <th>Case Type</th>
                <th>Associated With</th>
                <th>Date of Decision</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($judgements as $key => $item)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $item->file_no }}</td>
                  <td>{{ $item->year }}</td>
                  <td>{{ $item->case_type }}</td>
                  <td>{{ $item->associated }}</td>
                  <td>{{ $item->dod }}</td>
                  <td>
                    <a href="{{ route('edit.team',$item->id) }}" class="btn btn-warning px-3 radius-30"> Edit</a>

                  </td>

                </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>

    <hr />

  </div>
@endsection
