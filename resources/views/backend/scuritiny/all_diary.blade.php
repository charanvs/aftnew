@extends('admin.admin_dashboard')
@section('admin')
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <a href="{{ route('add.diary') }}" class="btn btn-outline-primary px-5 radius-30"> Add Diary</a>
          </ol>
        </nav>
      </div>

    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Diary</h6>
    <hr />
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>S No</th>
                <th>Diary No</th>
                <th>Presented Date</th>
                <th>Presented By</th>
                <th>Nature Of Doc</th>
                <th>Associated With</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allItems as $key => $item)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $item->diary_no }}</td>
                  <td>{{ $item->date_of_presentation }}</td>
                  <td>{{ $item->presented_by }}</td>
                  <td>{{ $item->nature_of_doc }}</td>
                  <td>{{ $item->associated_with }}</td>
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
