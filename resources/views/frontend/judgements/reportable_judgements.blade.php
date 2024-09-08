@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Reportable Judgements
@endsection

<div class="container mt-5">
  <h2 class="text-center mb-4" style="font-family: 'Roboto', sans-serif; font-weight: bold; color: #007bff;">Reportable Judgements</h2>

  <table class="table table-hover table-bordered table-striped" style="font-family: 'Segoe UI', sans-serif; font-size: 1.1rem;" id="sortable-table">
      <thead class="thead-dark" style="background-color: #343a40; color: white;">
          <tr>
              <th>S.NO</th>
              <th class="sortable">Applicant</th>
              <th class="sortable">Order Date</th>
              <th>Case</th>
              <th>Bench</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>1</td>
              <td>Dfr Shatrughan Singh Tomar</td>
              <td data-date="2021-04-07">07-04-2021</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 665-2020</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
          <tr>
              <td>2</td>
              <td>Ex Sep Puran</td>
              <td data-date="2023-01-06">06-01-2023</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 927/2018</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
          <tr>
              <td>3</td>
              <td>Ex Rect Keshav Dutt Oli</td>
              <td data-date="2022-09-22">22-09-2022</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 1914/2017</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
          <tr>
              <td>4</td>
              <td>Lt Col Manohar Singh Rathore</td>
              <td data-date="2022-12-01">01-12-2022</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 12/2017</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
          <tr>
              <td>5</td>
              <td>Plt Offr T H Sarma</td>
              <td data-date="2022-10-18">18-10-2022</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 1540/2017</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
          <tr>
              <td>6</td>
              <td>Maj Bhavna Verma</td>
              <td data-date="2022-09-23">23-09-2022</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 677/2021</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
          <tr>
              <td>7</td>
              <td>Ex Hav Naresh Pal Singh</td>
              <td data-date="2023-03-13">13-03-2023</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 461/2018</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
          <tr>
              <td>8</td>
              <td>Capt Anirudh Sharma</td>
              <td data-date="2022-08-03">03-08-2022</td>
              <td><a href="#" class="text-primary" style="text-decoration: none;">OA 2421/2021</a></td>
              <td>AFT(PB), New Delhi</td>
          </tr>
      </tbody>
  </table>
</div>

<!-- Include tablesort.js for sortable columns -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/tablesort.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/sorts/tablesort.date.min.js"></script>

<script>
    // Initialize tablesort
    new Tablesort(document.getElementById('sortable-table'));
</script>
@endsection
