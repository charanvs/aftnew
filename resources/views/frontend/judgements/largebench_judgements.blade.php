@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Rportable Judgements
@endsection
@include('frontend.body.header')
<h6 class="mb-0 text-uppercase">Reportable Judgements</h6>
<hr />
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>S. No.</th>
            <th>Case</th>
            <th>Applicant</th>
            <th>Order</th>
            <th>Corum</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @foreach($data as $key => $item)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $item->regno }}</td>
              <td>{{ $item->petitioner }}</td>
              <td>{{ $item->association }}</td>
              <td>{{ $item->corum }}</td>
              <td>{{ $item->remarks }}</td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

