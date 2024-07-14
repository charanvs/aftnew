<!doctype html>
<html lang="zxx">

<head>
  <!-- Required Meta Tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Data tables CSS -->
  <link href="{{ asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
  <!-- Animate Min CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
  <!-- Flaticon CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/flaticon.css') }}">
  <!-- Boxicons CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/boxicons.min.css') }}">
  <!-- Font-awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Magnific Popup CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
  <!-- Owl Carousel Min CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}">
  <!-- Nice Select Min CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.min.css') }}">
  <!-- Meanmenu CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.css') }}">
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.css') }}">
  <!-- Style CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
  <!-- Responsive CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
  <!-- Theme Dark CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme-dark.css') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}">
  <style>
    /* Preloader styles */
    .preloader {
      position: fixed;
      left: 0;
      top: 0;
      z-index: 9999;
      width: 100%;
      height: 100%;
      overflow: visible;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .spinner {
      width: 40px;
      height: 40px;
      position: relative;
    }

    .double-bounce1,
    .double-bounce2 {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background-color: #007bff;
      /* Primary color */
      opacity: 0.6;
      position: absolute;
      top: 0;
      left: 0;

      -webkit-animation: bounce 2.0s infinite ease-in-out;
      animation: bounce 2.0s infinite ease-in-out;
    }

    .double-bounce2 {
      -webkit-animation-delay: -1.0s;
      animation-delay: -1.0s;
    }

    @-webkit-keyframes bounce {

      0%,
      100% {
        -webkit-transform: scale(0);
        transform: scale(0);
      }

      50% {
        -webkit-transform: scale(1);
        transform: scale(1);
      }
    }

    @keyframes bounce {

      0%,
      100% {
        -webkit-transform: scale(0);
        transform: scale(0);
      }

      50% {
        -webkit-transform: scale(1);
        transform: scale(1);
      }
    }
  </style>

  <title>@yield('title')</title>
</head>

<body>

  <!-- PreLoader Start -->
  <div class="preloader">
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
  </div>
  <!-- PreLoader End -->

  @include('frontend.body.header') <!-- Ensure this is included only once -->

  <!-- Main Content Start -->
  <div class="content">
    @yield('main')
  </div>
  <!-- Main Content End -->

  @include('frontend.body.footer')

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery UI JS -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Owl Carousel JS -->
  <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
  <!-- MeanMenu JS -->
  <script src="{{ asset('frontend/assets/js/meanmenu.js') }}"></script>
  <!-- Magnific Popup JS -->
  <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
  <!-- WOW JS -->
  <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
  <!-- Nice Select JS -->
  <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
  <!-- Validator JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
  <!-- AjaxChimp JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxchimp/1.3.0/jquery.ajaxchimp.min.js"></script>
  <!-- Custom JS -->
  <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
      var table = $('#example2').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print']
      });

      table.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>
