<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Chart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            color: white;
            border: none;
            border-radius: 10px;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1rem;
        }
        .connector {
            width: 2px;
            height: 20px;
            background-color: #000;
            margin: auto;
        }
        .horizontal-connector {
            width: 100%;
            height: 2px;
            background-color: #000;
            position: relative;
        }
        .horizontal-connector::after {
            content: '';
            position: absolute;
            left: 50%;
            top: -10px;
            width: 2px;
            height: 10px;
            background-color: #000;
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
        }
    </style>
</head>
<body>

<div class="container">
    <div class="org-chart">
        <!-- CEO Level -->
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/rm.jpg') }}" alt="CEO">
                    <h5 class="card-title">CEO</h5>
                    <p class="card-text">John Doe</p>
                </div>
            </div>
        </div>
        <div class="connector"></div>
        <div class="horizontal-connector"></div>
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/an.jpg') }}" alt="CEO">
                    <h5 class="card-title">CEO</h5>
                    <p class="card-text">John Doe</p>
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
                    <h5 class="card-title">Manager 1</h5>
                    <p class="card-text">Jane Smith</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/cp.jpg') }}" alt="Manager 2">
                    <h5 class="card-title">Manager 2</h5>
                    <p class="card-text">Emily Johnson</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('frontend/assets/img/team/vm.jpg') }}" alt="Manager 3">
                    <h5 class="card-title">Manager 3</h5>
                    <p class="card-text">Michael Brown</p>
                </div>
            </div>
        </div>
        <div class="connector"></div>
        <div class="horizontal-connector"></div>
        <!-- Employees Level -->
        <div class="org-level">
            <div class="card">
                <div class="card-body text-center">
                    <img src="path_to_employee1_image.jpg" alt="Employee 1">
                    <h5 class="card-title">Employee 1</h5>
                    <p class="card-text">Alice Davis</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="path_to_employee2_image.jpg" alt="Employee 2">
                    <h5 class="card-title">Employee 2</h5>
                    <p class="card-text">Bob Wilson</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="path_to_employee3_image.jpg" alt="Employee 3">
                    <h5 class="card-title">Employee 3</h5>
                    <p class="card-text">Charlie Martinez</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <img src="path_to_employee4_image.jpg" alt="Employee 4">
                    <h5 class="card-title">Employee 4</h5>
                    <p class="card-text">David Garcia</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
