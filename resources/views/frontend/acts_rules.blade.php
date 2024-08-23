@extends('frontend.main_master')

@section('title')
  AFT-PB | Acts and Rules
@endsection

@section('main')
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
  .acts-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #2c3e50;
  }
  .list-group-item {
    font-size: 1.15rem;
    font-weight: bold;
    background-color: #f8f9fa;
    color: #343a40;
    transition: background-color 0.3s ease;
  }
  .list-group-item:hover {
    background-color: #e9ecef;
    color: #007bff;
  }
  .badge-primary {
    font-size: 0.9rem;
    font-weight: bold;
  }
  .section-heading {
    font-size: 1.25rem;
    font-weight: bold;
    color: #495057;
    margin-top: 1.5rem;
  }
</style>

<div class="container mt-5">
  <h2 class="text-center mb-4 acts-title">Acts and Rules</h2>
  <div class="row">

    <!-- First Column: Tribunal Acts -->
    <div class="col-md-6">
      <h3 class="section-heading">Tribunal Acts</h3>
      <div class="list-group">
        @php
          $tribunalActs = [
            ['title' => 'The Armed Forces Tribunal Act - RR', 'file' => 'The-Armed-Forces-Tribunal-Act-RR.pdf'],
            ['title' => 'The Armed Forces Tribunal Act - RR GP A & B', 'file' => 'The-Armed-Forces-Tribunal-Act-RR-GP-A-B.pdf'],
            ['title' => 'The Armed Forces Tribunal Act - RR GP C', 'file' => 'The-Armed-Forces-Tribunal-Act-RR-GP-C.pdf'],
            ['title' => 'The Armed Forces Tribunal Act - 2007', 'file' => 'The-Armed-Forces-Tribunal-Act-2007.pdf'],
            ['title' => 'The Armed Forces Tribunal (Practice) Rules - 2009', 'file' => 'The-Armed-Forces-Tribunal-Practice-Rules-2009.pdf'],
            ['title' => 'The Armed Forces Tribunal (Procedure) Rules - 2008', 'file' => 'The-Armed-Forces-Tribunal-Procedure-Rules-2008.pdf'],
            ['title' => 'The Armed Forces Tribunal (Procedure) Amendment Rules - 2011', 'file' => 'The-Armed-Forces-Tribunal-Procedure-Amendment-Rules-2011.pdf']
          ];
        @endphp

        @foreach ($tribunalActs as $act)
          <a href="{{ asset('pdf/acts/' . $act['file']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
            <span>{{ $act['title'] }}</span>
            <span class="badge badge-primary badge-pill">View</span>
          </a>
        @endforeach
      </div>
    </div>

    <!-- Second Column: Army, Air Force, and Navy Acts and Rules -->
    <div class="col-md-6">
      <h3 class="section-heading">Army Acts and Rules</h3>
      <div class="list-group">
        <a href="{{ asset('pdf/acts/Army-Act-1950.pdf') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
          <span>Army Act 1950</span>
          <span class="badge badge-primary badge-pill">View</span>
        </a>
        <a href="{{ asset('pdf/acts/Army-Rules-1954.pdf') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
          <span>Army Rules 1954</span>
          <span class="badge badge-primary badge-pill">View</span>
        </a>
      </div>

      <h3 class="section-heading mt-4">Air Force Acts and Rules</h3>
      <div class="list-group">
        <a href="{{ asset('pdf/acts/Air-Force-Act-1950.pdf') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
          <span>Air Force Act 1950</span>
          <span class="badge badge-primary badge-pill">View</span>
        </a>
        <a href="{{ asset('pdf/acts/Air-Force-Rules-1954.pdf') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
          <span>Air Force Rules 1954</span>
          <span class="badge badge-primary badge-pill">View</span>
        </a>
      </div>

      <h3 class="section-heading mt-4">Navy Acts and Rules</h3>
      <div class="list-group">
        <a href="{{ asset('pdf/acts/Navy-Act-1957.pdf') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
          <span>Navy Act 1957</span>
          <span class="badge badge-primary badge-pill">View</span>
        </a>
        <a href="{{ asset('pdf/acts/Navy-Rules-1960.pdf') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" target="_blank">
          <span>Navy Rules 1960</span>
          <span class="badge badge-primary badge-pill">View</span>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
