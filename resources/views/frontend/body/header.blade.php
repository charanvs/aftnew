<style>
    /* Breadcrumb Section */
    .breadcrumb-section {
      width: 100%; /* Full width */
      max-width: 1200px; /* Optional max-width to prevent it from being too wide on larger screens */
      margin: 0 auto;
      padding: 5px 0; /* Reduced padding to make breadcrumb height less */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .inner-title {
      background: rgba(0, 0, 0, 0.7); /* Darker background for better contrast */
      padding: 10px 20px; /* Reduced padding */
      border-radius: 10px;
      color: #fff;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
      width: 100%; /* Make inner-title take full width */
    }

    .inner-title h3 {
      font-size: 28px; /* Slightly reduced font size */
      margin: 5px 0; /* Reduced margin */
      color: #ffd700;
      font-weight: 700; /* Increased font weight */
      text-transform: uppercase;
      text-align: center;
      letter-spacing: 1px; /* Add some letter spacing */
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
    }

    .breadcrumb {
      padding: 0;
      margin: 5px 0; /* Reduced margin */
      list-style: none;
      display: flex;
      flex-wrap: wrap; /* Make breadcrumb items wrap on smaller screens */
      justify-content: center;
      align-items: center;
      color: #fff;
      width: 100%; /* Ensure breadcrumb spans full width */
    }

    .breadcrumb h5 {
      font-size: 22px; /* Slightly reduced font size */
      color: #0000ff;
      font-weight: bold;
      margin-bottom: 5px; /* Reduced spacing between header and list items */
    }

    .inner-title h5 {
      font-size: 22px; /* Slightly reduced font size */
      color: whitesmoke;
      font-weight: bold;
      margin-bottom: 5px; /* Reduced spacing */
    }

    .breadcrumb li {
      font-size: 16px; /* Reduced font size */
      margin-right: 5px; /* Reduced margin between breadcrumb items */
    }

    .breadcrumb li+li:before {
      padding: 0 5px; /* Reduced padding between breadcrumb separators */
      color: #fff;
      content: "/\00a0";
    }

    .breadcrumb li a {
      color: #ffd700;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .breadcrumb li a:hover {
      color: #ff8c00;
      text-decoration: underline;
    }

    #google_translate_element {
      margin-left: auto;
      text-align: right;
    }

    /* Navbar Section */
    .navbar-area {
      position: sticky;
      top: 0;
      z-index: 1000;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
      padding: 5px 0; /* Reduced padding for navbar */
    }

    /* Navbar Styling */
    .navbar-nav {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .navbar-nav .nav-link {
      white-space: normal;
      padding: 8px 15px; /* Reduced padding for navbar items */
      font-weight: 600;
      font-size: 14px; /* Reduced font size */
      color: #333;
      transition: color 0.3s ease, background-color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #007bff;
      background-color: rgba(0, 123, 255, 0.1); 
    }

    .navbar-nav .dropdown-menu {
      background-color: #f8f9fa;
    }

    .navbar-nav .dropdown-menu .nav-link {
      color: #333;
      font-size: 14px; /* Reduced font size */
    }

    .navbar-nav .dropdown-menu .nav-link:hover {
      color: #007bff;
    }

    .navbar-nav .more-dropdown .dropdown-menu {
      right: 0;
      left: auto;
    }

    @media (max-width: 576px) {
      .inner-title h3 {
        font-size: 24px;
      }

      .breadcrumb li {
        font-size: 14px;
      }

      .navbar-nav .nav-link {
        font-size: 12px; /* Further reduced for small screens */
        padding: 5px 10px; /* Reduced padding */
      }
    }

    /* Ensure the content section is placed below the header */
    .content-section {
      padding-top: 20px;
    }

    html {
      scroll-behavior: smooth;
    }
</style>


<!-- Breadcrumb Section -->
<div class="breadcrumb-section">
    <div class="inner-title">
        <h3>Armed Forces Tribunal (Principal Bench)</h3>
        <a href="https://aftdelhi.nic.in/ourphp/courtdisplay/courtdisplay.php" target="_blank"><h5>Court Display Board</h5></a>
        
        <ul class="breadcrumb mb-0">
            {{-- <li id="main-menu-value">AFT PB</li>
            <li id="selected-menu-value"></li> --}}
        </ul>
        <!-- Translator moved inside the breadcrumb section -->
        <div id="google_translate_element"></div>
    </div>
</div>


<!-- Start Navbar Area -->
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('home') }}" class="logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container mean-container">
            <nav class="navbar navbar-expand-md navbar-danger">
                <a class="navbar-brand" href="{{ url('/') }}">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto custom-nav">
                      
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link {{ areActiveRoutes(['home', 'members.page', 'organization.chart']) }}" data-text="Home">
                                Home
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('members.page') }}" class="nav-link" data-text="Members">
                                       Members
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('organization.chart') }}" class="nav-link" data-text="Organization Chart">
                                        Organization Chart
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ areActiveRoutes(['new.calendar', 'cases.page', 'diary.page']) }}" data-text="Case Management">
                                Case Management
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('new.calendar') }}" class="nav-link" data-text="Daily Cause List">
                                        Daily Cause List
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cases.page') }}" class="nav-link" data-text="Search Orders">
                                        Search Orders
                                    </a>
                                </li>
                                                                <li class="nav-item">
                                    <a href="{{ route('diary.page') }}" class="nav-link" data-text="Search Orders">
                                        Diary Search
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ areActiveRoutes(['judgements', 'judgements.page', 'judgements.reportable', 'judgements.largebench', 'judgements.reviewcases']) }}" data-text="Judgements">
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
                                    <a href="{{ route('judgements.reviewcases') }}" class="nav-link" data-text="Review Cases Of Regional Branches">
                                        Review Cases Of Regional Branches
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
                            <a href="#" class="nav-link dropdown-toggle {{ areActiveRoutes(['rules.page', 'vacancies.page', 'tenders.notifications', 'gallery.page']) }}" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="More">
                                More
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="moreDropdown">
                                <li class="nav-item">
                                    <a href="{{ route('rules.page') }}" class="nav-link {{ isActiveRoute('rules.page') }}" data-text="Act & Rules">
                                        Acts & Rules
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vacancies.page') }}" class="nav-link {{ isActiveRoute('vacancies.page')  }}" data-text="Vacancies">Vacancies</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('tenders.notifications') }}" class="nav-link {{ isActiveRoute('tenders.notifications')  }}" data-text="Tenders & Notifications">Tenders & Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('gallery.page') }}" class="nav-link {{ isActiveRoute('gallery.page')  }}" data-text="Gallery">Gallery</a>
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
