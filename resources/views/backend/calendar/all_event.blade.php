@extends('admin.admin_dashboard')
@section('admin')
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <a href="{{ route('calendar.add') }}" class="btn btn-outline-primary px-5 radius-30"> Add Cause List</a>
          </ol>
        </nav>
      </div>

    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Cause List</h6>
    <hr />
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>S No</th>
                <th>Cateogry</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>File Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($events as $key => $item)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $item->category }}</td>
                  <td>{{ $item->title }}</td>
                  <td>{{ $item->start }}</td>
                  <td>{{ $item->end }}</td>
                  <td>{{ $item->pdfurl }}</td>
                  <td>
                    <a href="{{ route('calendar.edit',$item->id) }}" class="btn btn-warning px-3 radius-30"> Edit</a>
                    <a href="" class="btn btn-danger px-3 radius-30">Delete</a>

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
