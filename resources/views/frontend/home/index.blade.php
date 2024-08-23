@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Home
@endsection

<link rel="stylesheet" href="{{ asset('frontend/assets/css/home.css') }}" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Noto+Sans:wght@400;700&display=swap"
  rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Blog Style Area -->
<div class="blog-style-area">
  <div class="container">
    <section id="Main">
      <div class="row">
        <div class="col-lg-7">
          <div class="blog-card">
            <div class="row align-items-center">
              <div class="col-lg-5 col-md-4 p-0">
                <div class="blog-img">
                  <a href="blog-details.html">
                    <img src="{{ asset('frontend/assets/img/banner/delhi_resized_300x500.jpg') }}" alt="Images"
                      >
                  </a>
                </div>
              </div>
              <div class="col-lg-7 col-md-8 p-0">
                <div class="blog-content">
                  <span>About AFT</span>
                  <h3>
                    <a href="blog-details.html">About Us</a>
                  </h3>
                  <p>
                    The Armed Forces Tribunal Act 2007, was passed by the Parliament and led to the formation of AFT
                    with the power provided for the adjudication or trial by Armed Forces Tribunal of disputes and
                    complaints with respect to commission, appointments, enrolments and conditions of service in
                    respect of persons subject to the Army Act, 1950, The Navy Act, 1957 and the Air Force Act, 1950.
                    It can further provide for appeals arising out of orders, findings or sentences of courts- martial
                    held under the said Acts and for matters connected therewith or incidental thereto.
                  </p>
                  <p>
                    Besides the Principal Bench in New Delhi, AFT has Regional Benches at Chandigarh, Lucknow,
                    Kolkata, Guwahati, Chennai, Kochi, Mumbai, Jabalpur, Srinagar and Jaipur. With the exception of
                    the Chandigarh and Lucknow Regional Benches, which have three benches each, all other...
                  </p>
                  <a href="{{ url('/') }}" class="read-btn">
                    Read More
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="side-bar-wrap">
            <div class="side-bar-widget">
              <a href="{{ route('members.page') }}">
                <h3 class="title">Members</h3>
              </a>
              <div class="widget-popular-post">
                @foreach ($data as $item)
                  <article class="item">
                    <a href="blog-details.html" class="thumb">
                      <img src="{{ asset($item->image ?: 'default-image.jpg') }}" alt="image"
                        class="full-image cover bg1" role="img">
                    </a>
                    <div class="info">
                      <h4 class="title-text">
                        <a href="blog-details.html">
                          <span class="text-bold">{{ $item->name }}</span>
                          <br>
                          {{ $item->salutation }}
                        </a>
                      </h4>
                    </div>
                    <hr class="bg-danger">
                  </article>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog Style Area -->
    <div class="blog-style-area">
      <div class="container">
        <section id="Main">
          <!-- Your existing content here -->
        </section>

        <!-- New section for What's New, Notifications, Blog Category, and Tenders -->
        <section id="newSection">
          <div class="row">
            <div class="col-lg-7">
              <div class="news-card">
                <div class="card-header">What's New</div>
                <div class="card-body">
                  <div class="marquee" id="marquee1">
                    <div class="marquee-content" id="marqueeContent1">
                      @foreach ($new_records as $item)
                        <a href="{{ asset('upload/tender_notifications/' . $item->pdfname) }}" target="_blank">
                          <p>{{ $item->title }}</p>
                        </a>
                      @endforeach
                      <!-- Add more notifications as needed -->
                    </div>
                  </div>
                  <div class="controls">
                    <button id="play1"><i class="fas fa-play"></i></button>
                    <button id="stop1"><i class="fas fa-stop"></i></button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="services-bar-widget">
                <h3 class="title">Handy Links</h3>
                <div class="side-bar-categories">
                  <ul>
                    <li>
                      <a href="{{ route('judgements.page') }}" data-text="Judgements">Judgements</a>
                    </li>
                    <li>
                      <a href="{{ route('cases.page') }}" data-text="Daily Orders">Daily Orders</a>
                    </li>
                    <li>
                      <a href="#" data-text="Gallery">Gallery</a>
                    </li>
                    <li>
                      <a href="#" data-text="Notification">Notification</a>
                    </li>
                    <li>
                      <a href="{{ route('vacancies.page') }}" data-text="Vacancies">Vacancies</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Section for Regional Benches -->
        <section id="branches">
          <div class="col-lg-12">
            <div class="container">
              <div class="section-title text-center pb-5">
                <h2>Regional Benches</h2>
              </div>
              <div id="branchesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  @foreach ($bench->chunk(3) as $benchChunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                      <div class="row">
                        @foreach ($benchChunk as $bench)
                          <div class="col-lg-4 col-md-6">
                            <div class="room-card">
                              <a href="">
                                <img src="{{ asset($bench->image ?: 'default-image.jpg') }}" alt="Image">
                              </a>
                              <div class="content">
                                <h3><a href="room-details.html" class="text-white">{{ $bench->bench_name }}</a></h3>
                                <ul>
                                  <li class="text-color">{{ $bench->description }}</li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endforeach
                </div>
                <!-- Carousel controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#branchesCarousel"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#branchesCarousel"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <!-- Section for Gallery and Daily Cause List-->
    <section id="Last">
      <div class="row">
        <div class="col-lg-7 pt-5 pb-5">
          <div class="section-title text-center pb-5">
            <h2>Gallery</h2>
          </div>
          <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach ($gallery->chunk(3) as $index => $galleryChunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                  <div class="row">
                    @foreach ($galleryChunk as $item)
                      <div class="col-lg-4 col-md-6">
                        <div class="room-card">
                          <a href="">
                            <img src="{{ asset($item->image ?: 'default-image.jpg') }}" alt="Image">
                          </a>
                          <div class="content">
                            <h3><a href="room-details.html" class="text-white">{{ $item->title }}</a></h3>
                            <ul>
                              <li class="text-color">{{ $item->description }}</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endforeach
            </div>
            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

        <div class="col-lg-5 pt-5 pb-5">
          <div class="section-title text-center pb-5">
            <h2>Daily Cause List</h2>
          </div>
          <div class="card">
            <div class="card-body">
              <!-- Calendar -->
              <div id='calendar'></div>
              <div class="legend">
                <span class="cause-list">Cause List</span>
                <span class="holidays">Holidays</span>
                <span class="other">Other</span>
              </div>
              <iframe id="pdfFrame" style="display:none; width:100%; height:600px;" frameborder="0"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal to display PDF -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const marquee1 = document.getElementById('marqueeContent1');
        const playButton1 = document.getElementById('play1');
        const stopButton1 = document.getElementById('stop1');

        playButton1.addEventListener('click', function() {
          marquee1.style.animationPlayState = 'running';
        });

        stopButton1.addEventListener('click', function() {
          marquee1.style.animationPlayState = 'paused';
        });

        const marquee2 = document.getElementById('marqueeContent2');
        const playButton2 = document.getElementById('play2');
        const stopButton2 = document.getElementById('stop2');

        playButton2.addEventListener('click', function() {
          marquee2.style.animationPlayState = 'running';
        });

        stopButton2.addEventListener('click', function() {
          marquee2.style.animationPlayState = 'paused';
        });

        const marquee3 = document.getElementById('marqueeContent3');
        const playButton3 = document.getElementById('play3');
        const stopButton3 = document.getElementById('stop3');

        playButton3.addEventListener('click', function() {
          marquee3.style.animationPlayState = 'running';
        });

        stopButton3.addEventListener('click', function() {
          marquee3.style.animationPlayState = 'paused';
        });
      });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: '{{ route('events.get') }}',
          eventContent: function(arg) {
            let content = document.createElement('div');
            content.classList.add('fc-event-content');

            let title = document.createElement('div');
            title.innerHTML = arg.event.title;
            content.appendChild(title);

            if (arg.event.extendedProps.category == 'Cause List') {
              title.style.backgroundColor = 'green';
              let pdfLink = document.createElement('a');
              pdfLink.href = arg.event.extendedProps.pdfUrl;
              pdfLink.target = '_blank';
              pdfLink.classList.add('show-pdf');
              pdfLink.textContent = 'View PDF';
              content.appendChild(pdfLink);
            } else if (arg.event.extendedProps.category == 'Holidays') {
              title.style.backgroundColor = 'blue';
            } else {
              title.style.backgroundColor = 'gray';
            }

            return {
              domNodes: [content]
            };
          },
          eventDidMount: function(info) {
            if (info.event.extendedProps.category == 'Holidays') {
              let eventEl = info.el;
              eventEl.style.whiteSpace = 'normal';
              eventEl.style.overflow = 'hidden';
              eventEl.style.textOverflow = 'ellipsis';
            }
          },
          dayCellDidMount: function(info) {
            if (info.date.getDay() === 0 || info.date.getDay() === 6) { // 0 = Sunday, 6 = Saturday
              info.el.classList.add('fc-day-sat');
              info.el.classList.add('fc-day-sun');
            }
          }
        });

        calendar.render();
      });
    </script>

  @endsection
