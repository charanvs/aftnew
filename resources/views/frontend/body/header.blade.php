<style>
    .breadcrumb-section {
      width: 90%; /* Set breadcrumb width to 90% of the screen */
      margin: 0 auto; /* Center the breadcrumb */
      padding: 10px 0; /* Adjust padding for the breadcrumb */
    }

    .inner-title {
      background: rgba(0, 0, 0, 0.5);
      padding: 10px 20px;
      border-radius: 8px;
      color: #fff;
    }

    .inner-title h3 {
      font-size: 24px; /* Adjusted font size */
      margin: 5px 0;
      color: #ffd700;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center; /* Centered title */
    }

    .breadcrumb {
      padding: 0;
      margin: 0 0 5px;
      list-style: none;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }

    .breadcrumb li {
      font-size: 14px; /* Adjusted font size */
      margin-right: 8px;
    }

    .breadcrumb li+li:before {
      padding: 0 5px;
      color: #fff;
      content: "/\00a0";
    }

    .breadcrumb li a {
      color: #ffd700;
      text-decoration: none;
    }

    .breadcrumb li a:hover {
      color: #ff8c00;
      text-decoration: underline;
    }

    #google_translate_element {
      margin-left: auto; /* Push the translator to the right */
      text-align: right; /* Ensure text aligns properly */
    }

    /* Make the navbar sticky */
    .navbar-area {
      position: sticky;
      top: 0;
      z-index: 1000; /* Ensure it stays above other elements */
      background-color: #fff; /* Add a background to prevent transparency issues */
    }

    /* Responsive navbar adjustments */
    .navbar-nav {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .navbar-nav .nav-link {
      white-space: normal;
      padding: 8px 15px;
    }

    @media (min-width: 1200px) {
      .navbar-nav .nav-link {
        font-size: 16px;
      }
    }

    @media (min-width: 992px) and (max-width: 1199px) {
      .navbar-nav .nav-link {
        font-size: 14px;
      }
    }

    @media (min-width: 768px) and (max-width: 991px) {
      .navbar-nav .nav-link {
        font-size: 14px;
      }
    }

    @media (max-width: 767px) {
      .navbar-nav .nav-link {
        font-size: 12px;
      }
      .navbar-nav .more-dropdown {
        display: none;
      }
    }

    .navbar-nav .more-dropdown .dropdown-menu {
      right: 0;
      left: auto;
    }

    @media (max-width: 1200px) {
      .navbar-nav .more-dropdown .dropdown-menu {
        display: block;
        position: static;
        width: 90%;
      }
    }

    /* Ensure the content section is placed below the header */
    .content-section {
      padding-top: 20px; /* Ensure content is visible below the header */
    }
  </style>

  <!-- Breadcrumb Section -->
  <div class="breadcrumb-section">
    <div class="inner-title d-flex justify-content-between align-items-center">
      <div>
        <ul class="breadcrumb mb-0">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li id="main-menu-value">AFT PB</li>
          <li id="selected-menu-value"></li>
        </ul>
        <h3>AFT PB</h3>
      </div>
      <!-- Translator moved inside the breadcrumb section -->
      <div id="google_translate_element"></div>
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
    <div class="main-nav">
      <div class="container mean-container">
        <nav class="navbar navbar-expand-md navbar-danger">
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
                    <a href="" class="nav-link" data-text="Review Cases Of Regional Branches">
                      Review Cases Of Regional Branches
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link" data-text="Large Bench Circulars">
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
                      <a href="" class="nav-link" data-text="Chandigarh">
                        Chandigarh
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('advanced.search') }}" class="nav-link  {{ areActiveRoutes(['advanced.search', 'advanced.search.perform']) }}" data-text="Advanced Search">Advanced Search</a>
                  </li>

              <!-- Remaining nav items -->
              <li class="nav-item dropdown more-dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  More
                </a>
                <ul class="dropdown-menu" aria-labelledby="moreDropdown">
                    <li class="nav-item">
                        <a href="{{ route('rules.page') }}" class="nav-link {{ isActiveRoute('rules.page') }}" data-text="Act & Rules">
                        Acts & Rules
                      </a>
                    </li>
                  <li class="nav-item">
                    <a href="{{ route('vacancies.page') }}" class="nav-link {{ isActiveRoute('vacancies.page')  }}">Vacancies</a>
                  </li>

                  <!-- Add more items here as needed -->
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- End Navbar Area -->

  <!-- Content Section -->
  <div class="content-section" id="content-section">
    <!-- Your content goes here -->
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
      $(".nav-link, .services-bar-widget .side-bar-categories a").click(function(e) {
        var link = $(this).attr('href');

        // Check if the link is for an internal section or external page
        if (link.startsWith("#") || link === "javascript:void(0);") {
          e.preventDefault(); // Prevent default action if the link is an internal section or non-functional link
        }

        var subMenuText = $(this).data("text");
        var mainMenuText = $(this).closest('.dropdown-menu').siblings('.nav-link').data("text") || subMenuText;

        // Save the text content to localStorage
        localStorage.setItem('selectedMainMenuText', mainMenuText);
        localStorage.setItem('selectedSubMenuText', subMenuText);

        // Display the text content in the desired elements
        $("#main-menu-value").text(mainMenuText);
        $("#selected-menu-value").text(subMenuText);

        // Scroll to the content section if the link is internal
        if (link.startsWith("#")) {
          $('html, body').animate({
            scrollTop: $("#content-section").offset().top
          }, 500);
        } else {
          window.location.href = link; // Navigate to the external page
        }
      });
    });
  </script>
