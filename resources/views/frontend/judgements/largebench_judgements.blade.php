@extends('frontend.main_master')
@section('main')
@section('title')
    AFT-PB | Large Bench Orders
@endsection
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <!-- Matters Pending before Large Bench of AFT (PB) and RB's -->
    <h2 class="text-center mb-4" style="font-family: 'Roboto', sans-serif; font-weight: bold; color: #007bff;">Matters Pending before Large Bench of AFT (PB) and RB's</h2>

    <table class="table table-bordered table-striped table-hover" style="font-family: 'Segoe UI', sans-serif; font-size: 1.1rem;">
        <thead class="thead-dark" style="background-color: #343a40; color: white;">
            <tr>
                <th>Sr. No.</th>
                <th>Case</th>
                <th>Petitioner</th>
                <th>Reference Order</th>
                <th>Corum</th>
                <th>NDOH</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>MA (Dy No. 3380/2015) in OA No. 155/2011</td>
                <td>Air Cmde TM Rao</td>
                <td>15.12.2015 (Order)</td>
                <td>
                    <span class="corum-short">Hon'ble Chairperson, Hon'ble Justice Anu Malhotra...</span>
                    <span class="corum-full d-none">Hon'ble Chairperson, Hon'ble Justice Anu Malhotra, Hon'ble Lt. Gen. CP Mohanty</span>
                    <button class="btn btn-link btn-sm read-more">Read More</button>
                </td>
                <td>08.10.2024</td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>OA 1487/2018</td>
                <td>JWO S K Sahay</td>
                <td>26.02.2020 (Order)</td>
                <td>
                    <span class="corum-short">Hon'ble Chairperson, Hon'ble Justice Anu Malhotra...</span>
                    <span class="corum-full d-none">Hon'ble Chairperson, Hon'ble Justice Anu Malhotra, Hon'ble Lt. Gen. P.M. Hariz</span>
                    <button class="btn btn-link btn-sm read-more">Read More</button>
                </td>
                <td>16.10.2024</td>
                <td>Notice issued to parties on 24.05.2023 for submission of comments.</td>
            </tr>
            <tr>
                <td>3</td>
                <td>OA 589/2019</td>
                <td>Ex. Hony Nb Sub Ram Kishan</td>
                <td>28.01.2020 (Order)</td>
                <td>
                    <span class="corum-short">Hon'ble Chairperson, Hon'ble Justice Anu Malhotra...</span>
                    <span class="corum-full d-none">Hon'ble Chairperson, Hon'ble Justice Anu Malhotra, Hon'ble Lt. Gen. P.M. Hariz</span>
                    <button class="btn btn-link btn-sm read-more">Read More</button>
                </td>
                <td>12.07.2023</td>
                <td></td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>

    <!-- Judgements Delivered by the Large Bench of AFT (PB) and RB's -->
    <h2 class="text-center mt-5 mb-4" style="font-family: 'Roboto', sans-serif; font-weight: bold; color: #007bff;">Judgements Delivered by the Large Bench of AFT (PB) and RB's</h2>

    <table class="table table-bordered table-striped table-hover" style="font-family: 'Segoe UI', sans-serif; font-size: 1.1rem;">
        <thead class="thead-dark" style="background-color: #343a40; color: white;">
            <tr>
                <th>Sr. No.</th>
                <th>Case</th>
                <th>Petitioner</th>
                <th>Reference Order</th>
                <th>Corum</th>
                <th>Date of Judgement</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>OA 471/2010</td>
                <td>Hav Parmeshwar Ram Vs. UOI & Ors.</td>
                <td>19.10.2020 (Order)</td>
                <td>
                    <span class="corum-short">Hon'ble Mr Justice A. K. Mathur, Hon'ble Mr. Justice S. S. Kulshreshtha...</span>
                    <span class="corum-full d-none">Hon'ble Mr Justice A. K. Mathur, Hon'ble Mr. Justice S. S. Kulshreshtha, Hon'ble Lt. Gen. M. L. Naidu</span>
                    <button class="btn btn-link btn-sm read-more">Read More</button>
                </td>
                <td>19.10.2020</td>
                <td>Transferred to RB, Jaipur, vide order dt 19.10.2010</td>
            </tr>
            <tr>
                <td>2</td>
                <td>OA 279/2011, etc.</td>
                <td>Nb Sub Roshan Lal Vs. UOI & Ors.</td>
                <td>03.01.2013 (Order)</td>
                <td>
                    <span class="corum-short">Hon'ble Mr Justice A. K. Mathur, Hon'ble Mr. Justice N. P. Gupta...</span>
                    <span class="corum-full d-none">Hon'ble Mr Justice A. K. Mathur, Hon'ble Mr. Justice N. P. Gupta, Hon'ble Lt. Gen. S.S. Dhillon</span>
                    <button class="btn btn-link btn-sm read-more">Read More</button>
                </td>
                <td>03.01.2013</td>
                <td></td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
     <!-- Additional Orders for AFT (RB) Chandigarh and AFT (RB) Jaipur -->
     <h3 class="text-center mt-5" style="font-family: 'Roboto', sans-serif; font-weight: bold; color: #007bff;">AFT (RB) Chandigarh & Jaipur Larger Bench Orders</h3>
     <ul class="list-unstyled text-center mt-4" style="font-family: 'Segoe UI', sans-serif; font-size: 1.2rem;">
      <li class="badge badge-pill badge-primary">
          <a href="#" class="text-white" style="text-decoration: none;">RA 265/2017 in OA 586/2015 Larger Bench Order in respect of RB Chandigarh - 29-03-2019</a>
      </li>
      <li class="badge badge-pill badge-primary">
          <a href="#" class="text-white" style="text-decoration: none;">RA 265/2017 in OA 586/2015 Larger Bench Order in respect of RB Chandigarh - 08-03-2019</a>
      </li>
      <li class="badge badge-pill badge-secondary">
          <a href="#" class="text-white" style="text-decoration: none;">OA 17/2015 Larger Bench Order in respect of RB Jaipur - 28-05-2021</a>
      </li>
      <li class="badge badge-pill badge-secondary">
          <a href="#" class="text-white" style="text-decoration: none;">OA 17/2015 Larger Bench Order in respect of RB Jaipur - 21-08-2020</a>
      </li>
      <li class="badge badge-pill badge-secondary">
          <a href="#" class="text-white" style="text-decoration: none;">OA 17/2015 Larger Bench Order in respect of RB Jaipur - 29-11-2019</a>
      </li>
      <li class="badge badge-pill badge-secondary">
          <a href="#" class="text-white" style="text-decoration: none;">OA 17/2015 Larger Bench Order in respect of RB Jaipur - 22-02-2019</a>
      </li>
      <li class="badge badge-pill badge-secondary">
          <a href="#" class="text-white" style="text-decoration: none;">OA 17/2015 Larger Bench Order in respect of RB Jaipur - 31-01-2019</a>
      </li>
      <li class="badge badge-pill badge-secondary">
          <a href="#" class="text-white" style="text-decoration: none;">OA 17/2015 Larger Bench Order in respect of RB Jaipur - 12-12-2018</a>
      </li>
      <li class="badge badge-pill badge-secondary">
          <a href="#" class="text-white" style="text-decoration: none;">OA 17/2015 Larger Bench Order in respect of RB Jaipur - 15-11-2018</a>
      </li>
  </ul>
  
</div>
@endsection

<script>
    document.querySelectorAll('.read-more').forEach(function(button) {
        button.addEventListener('click', function() {
            const corumShort = this.previousElementSibling.previousElementSibling;
            const corumFull = this.previousElementSibling;

            if (corumFull.classList.contains('d-none')) {
                corumFull.classList.remove('d-none');
                corumShort.classList.add('d-none');
                this.textContent = 'Read Less';
            } else {
                corumFull.classList.add('d-none');
                corumShort.classList.remove('d-none');
                this.textContent = 'Read More';
            }
        });
    });
</script>

