@extends('admin.admin_dashboard')
@section('admin')
  <div class="page-content">

    <h6 class="mb-0 text-uppercase">Add Orders</h6>
    <hr />

    <!-- Filter by Date -->
    <div class="card">
      <div class="card-body">
        <form action="{{ route('filter.orders') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <label for="search_date">Select Date:</label>
              <input type="text" name="search_date" id="search_date" class="form-control" placeholder="dd-mm-yyyy">
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Filter Orders</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <hr />

    <!-- Orders Table (only show after clicking the filter button) -->
    @if(isset($all_orders) && $all_orders->isNotEmpty())
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>S No</th>
                  <th>Registration No</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($all_orders as $key => $item)
                @php
                    // Check if registration_no + dol exists in the existing orders
                    $isDisabled = $existing_orders->has($item->registration_no . '-' . $item->dol);
                @endphp
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->registration_no }}</td>
                    <td>{{ $item->dol }}</td>
                    <td>
                      <a href="{{ $isDisabled ? route('edit.order', ['regno' => preg_replace('/[^A-Za-z0-9]/', '', $item->registration_no), 'dol' => $item->dol]) : route('add.order', ['id' => $item->registration_id, 'dol' => $item->dol]) }}"
                        class="btn btn-{{ $isDisabled ? 'success' : 'warning' }} px-3 radius-30">
                        {{ $isDisabled ? 'Edit Order' : 'Add Order' }}
                     </a>
                    </td>
                </tr>
            @endforeach
            
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @elseif(isset($all_orders) && $all_orders->isEmpty())
      <div class="alert alert-warning">
        No orders found for the selected date.
      </div>
    @endif
  </div>
@endsection
