<style>
    .inner-title {
        background: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        color: #fff;
      }

      .inner-title h3 {
        font-size: 36px;
        margin: 10px 0;
        color: #ffd700; /* Golden color */
        font-weight: bold;
        text-transform: uppercase;
      }

      .breadcrumb {
        padding: 0;
        margin: 0 0 10px;
        list-style: none;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
      }

      .breadcrumb li {
        font-size: 16px;
        margin-right: 10px;
      }

      .breadcrumb li + li:before {
        padding: 0 5px;
        color: #fff;
        content: "/\00a0";
      }

      .breadcrumb li a {
        color: #ffd700; /* Golden color */
        text-decoration: none;
      }

      .breadcrumb li a:hover {
        color: #ff8c00; /* Dark orange */
        text-decoration: underline;
      }

      .carousel-caption {
        bottom: 30%;
      }

</style>
<header class="top-header top-header-bg py-3">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 mb-2 mb-md-0">
          <div id="google_translate_element" class="text-md-left text-center"></div>
          <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,hi,ta,pa',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
              }, 'google_translate_element');
            }
          </script>
          <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        </div>
        <div class="col-lg-9 col-md-8">
          <div class="header-right d-flex flex-column flex-md-row justify-content-md-end text-center text-md-left">
            <ul class="list-unstyled mb-0 d-flex flex-column flex-md-row">
              <li class="mb-2 mb-md-0 mr-md-3">
                <i class='bx bx-home-alt mr-1'></i>
                <a href="#" class="text-decoration-none">West Block-VIII, R.K.Puram, New Delhi</a>
              </li>
              <li class="mb-2 mb-md-0 mr-md-3">
                <i class='bx bx-phone-call mr-1'></i>
                <a href="tel:+91-(123)-456-7890" class="text-decoration-none">+1 (123) 456 7890</a>
              </li>
              <li>
                <i class='bx bx-envelope mr-1'></i>
                <a href="mailto:pbnewdelhi@mail.com" class="text-decoration-none">pbnewdelhi@mail.com</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Slider for Main Header Images -->
<div id="headerCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('frontend/assets/img/inner-banner/inner-banner3.jpg') }}" class="d-block w-100" alt="Image 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('frontend/assets/img/inner-banner/inner-banner2.jpg') }}" class="d-block w-100" alt="Image 2">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('frontend/assets/img/inner-banner/home.jpg') }}" class="d-block w-100" alt="Image 3">
      </div>
    </div>
    <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

    <!-- Inner Title -->
    <div class="carousel-caption d-none d-md-block">
      <div class="inner-title">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="#">AFT PB</a></li>
          <li id="selected-menu-value"></li>
        </ul>
        <h3>AFT PB</h3>
      </div>
    </div>
  </div>

  <!-- Start Navbar Area -->
  <div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
      <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('frontend/assets/img/inner-banner/logo.png') }}" class="logo-one" alt="Logo">
        <img src="{{ asset('frontend/assets/img/inner-banner/logo.png') }}" class="logo-two" alt="Logo">
      </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav nav-three">
      <div class="container">
        <nav class="navbar navbar-expand-md nav-danger">
          <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('frontend/assets/img/inner-banner/logo.png') }}" class="logo-two" alt="Logo">
          </a>

          <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto custom-nav">
              <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ isActiveRoute('home') }}" data-text="Home">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('members.page') }}" class="nav-link {{ isActiveRoute('members.page') }}" data-text="Members">
                  Members
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{ areActiveRoutes(['daily_cause_list.page', 'cases.page']) }}" data-text="Case Management">
                  Case Management
                </a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <a href="{{ route('daily_cause_list.page') }}" class="nav-link" data-text="Daily Cause List">
                      Daily Cause List
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('cases.page') }}" class="nav-link" data-text="Search Orders">
                      Search Orders
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{ areActiveRoutes(['judgements', 'judgements.page', 'judgements.reportable', 'judgements.largebench']) }}" data-text="Judgements">
                  Judgements
                </a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <a href="{{ route('judgements.page') }}" class="nav-link" data-text="Judgements in AFT PB">
                      Judgements in AFT PB
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('judgements.reportable') }}" class="nav-link" data-text="Reportable Judgements">
                      Reportable Judgements
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('judgements.largebench') }}" class="nav-link" data-text="Large Bench Orders">
                      Large Bench Orders
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="restaurant.html" class="nav-link" data-text="Review Cases Of Regional Branches">
                      Review Cases Of Regional Branches
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="reservation.html" class="nav-link" data-text="Large Bench Circulars">
                      Large Bench Circulars
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-text="Regional Benches">
                  Regional Benches
                </a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <a href="book.html" class="nav-link" data-text="Chandigarh">
                      Chandigarh
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="team.html" class="nav-link" data-text="Chennai">
                      Chennai
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Guwhati">
                      Guwhati
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Jabalpur">
                      Jabalpur
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Jaipur">
                      Jaipur
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Kochi">
                      Kochi
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Kolkata">
                      Kolkata
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Lucknow">
                      Lucknow
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Mumbai">
                      Mumbai
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Srinagar">
                      Srinagar
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-text="Act & Rules">
                  Act & Rules
                </a>
                <ul class="dropdown-menu">
                  <li class="nav-item">
                    <a href="book.html" class="nav-link" data-text="AFT Act & Rules">
                      AFT Act & Rules
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="team.html" class="nav-link" data-text="Army Act & Rules">
                      Army Act & Rules
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="faq.html" class="nav-link" data-text="Air Force Act & Rules">
                      Air Force Act & Rules
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="restaurant.html" class="nav-link" data-text="Navy Act & Rules">
                      Navy Act & Rules
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ route('vacancies.page') }}" class="nav-link {{ isActiveRoute('vacancies.page') }}" data-text="Vacancies">
                  Vacancies
                </a>
              </li>
              <li class="nav-item">
                <a href="contact.html" class="nav-link" data-text="RTI">
                  RTI
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- End Navbar Area -->

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      // Retrieve and display the saved menu item text from localStorage on page load
      var savedMainMenuText = localStorage.getItem('selectedMainMenuText');
      var savedSubMenuText = localStorage.getItem('selectedSubMenuText');
      if (savedMainMenuText) {
        $("#main-menu-value").text(savedMainMenuText);
      }
      if (savedSubMenuText) {
        $("#selected-menu-value").text(savedSubMenuText);
      }

      // Event listener for menu item clicks
      $(".nav-link").click(function() {
        // Check if the clicked element is a sub-menu item or main menu item
        var subMenuText = $(this).data("text");
        var mainMenuText = $(this).closest('.dropdown-menu').siblings('.nav-link').data("text") || subMenuText;

        // Save the text content to localStorage
        localStorage.setItem('selectedMainMenuText', mainMenuText);
        localStorage.setItem('selectedSubMenuText', subMenuText);

        // Display the text content in the desired elements
        $("#main-menu-value").text(mainMenuText);
        $("#selected-menu-value").text(subMenuText);
      });
    });
  </script>
