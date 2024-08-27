@extends('frontend.main_master')

@section('title')
  AFT-PB | Daily Cause List
@endsection

@section('main')
    <style>
        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }
        .org-level {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .org-level .card {
            margin: 10px;
            width: 250px;
            background: linear-gradient(135deg, #3b82f6 0%, #0ea5e9 100%);
            color: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        .org-level .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 1px 1px 2px #000000;
        }
        .card-text {
            font-size: 1.1rem;
            color: #e0f7ff;
        }
        .connector {
            width: 2px;
            height: 20px;
            background-color: #0ea5e9;
            margin: auto;
        }
        .horizontal-connector {
            width: 100%;
            height: 2px;
            background-color: #0ea5e9;
            position: relative;
        }
        .horizontal-connector::after {
            content: '';
            position: absolute;
            left: 50%;
            top: -10px;
            width: 2px;
            height: 10px;
            background-color: #0ea5e9;
        }
        @media (max-width: 768px) {
            .org-level {
                flex-direction: column;
            }
            .horizontal-connector {
                display: none;
            }
        }
        .card img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #0ea5e9;
        }
        h2 {
            color: #3b82f6;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px #000000;
        }
    </style>

<div class="container">
    <h2>Organization Chart - AFT PB</h2>
    <div class="org-chart">
        <!-- CEO Level -->
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/rm.jpg') }}" alt="CEO">
                    <h5 class="card-title">Chairperson</h5>
                    <p class="card-text">Hon'ble Mr. Justice Rajendra Menon 
                    </p>
                </div>
            </div>
        </div>
        <div class="connector"></div>
        <div class="horizontal-connector"></div>
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/an.jpg') }}" alt="CEO">
                    <h5 class="card-title">Member</h5>
                    <p class="card-text">Hon'ble Ms. Justice Anu Malhotra
                    </p>
                </div>
            </div>
        </div>
        <div class="connector"></div>
        <div class="horizontal-connector"></div>
        <!-- Managers Level -->
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/hr.jpg') }}" alt="Manager 1">
                    <h5 class="card-title">Member</h5>
                    <p class="card-text">Hon'ble Lt Gen PM Hariz</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/cp.jpg') }}" alt="Manager 2">
                    <h5 class="card-title">Member</h5>
                    <p class="card-text">Hon'ble Lt Gen CP Mohanty</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/vm.jpg') }}" alt="Manager 3">
                    <h5 class="card-title">Member</h5>
                    <p class="card-text">Hon'ble Rear Admiral Dhiren Vig
                    </p>
                </div>
            </div>
        </div>
        <div class="connector"></div>
        <div class="horizontal-connector"></div>
        <!-- PR Level -->
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="path_to_PR_image.jpg" alt="PR">
                    <h5 class="card-title">Principal Registrar</h5>
                    <p class="card-text">	
Ld. Dharmender Rana (DHJS)</p>
                </div>
            </div>
        </div>
        <div class="connector"></div>
        <div class="horizontal-connector"></div>
        <!-- JR and PPS Level -->
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="path_to_JR_image.jpg" alt="JR">
                    <h5 class="card-title">Joint Registrar</h5>
                    <p class="card-text">Joint Registrar</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="path_to_PPS_image.jpg" alt="PPS">
                    <h5 class="card-title">Sh. Arun Khera</h5>
                    <p class="card-text">Sr. PPS to Hon'ble Chairperson</p>
                </div>
            </div>
        </div>
        <div class="connector"></div>
        <div class="horizontal-connector"></div>
        <!-- Sections Level -->
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Admin - I, II & III</h5>
                    <p class="card-text">Administration Sections</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Judicial</h5>
                    <p class="card-text">Judicial Section</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Library</h5>
                    <p class="card-text">Library Section</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Accounts & Budgeting</h5>
                    <p class="card-text">Finance Section</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
