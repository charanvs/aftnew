@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Judgements
@endsection
@include('frontend.body.header')

<div class="reservation-widget-area pt-100 pb-70">
  <div class="container">
    <div class="tab reservation-tab">
      <ul class="tabs">
        <li>
          <a href="#">File Number</a>
        </li>

        <li>
          <a href="#">Party Name</a>
        </li>

        <li>
          <a href="#">Advocate Name</a>
        </li>

        <li>
          <a href="#">Case Type</a>
        </li>

      </ul>

      <div class="tab_content current active pt-45">
        <div class="tabs_item current">
          <div class="reservation-tab-item">
            <div class="row">
              <div class="col-lg-4">
                <div class="side-bar-form">
                  <h3>Search By </h3>
                  <form method="get" action="{{ route('judgements.fileno') }}">
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label>Select Bench</label>
                            <select class="form-control">
                              <option>Principal Bench</option>
                              <option>Chandigarh</option>
                              <option>Chennai</option>
                              <option>Guwhati</option>
                              <option>Kolkata</option>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>File No</label>
                          <div class="input-group">
                            <input name="fileno" type="text" class="form-control" placeholder="File No">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label>Select Year</label>
                            <select name="year" class="form-control">
                              <option value="2009">2009</option>
                              <option>2010</option>
                              <option>2011</option>
                              <option>2012</option>
                              <option>2013</option>
                              <option>2014</option>
                              <option>2015</option>
                              <option>2016</option>
                              <option>2017</option>
                              <option>2018</option>
                              <option>2019</option>
                              <option>2020</option>
                              <option>2021</option>
                              <option>2022</option>
                              <option>2023</option>
                              <option>2024</option>


                            </select>
                          </div>
                      </div>

                      <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                          Search
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="reservation-widget-content">
                  <h2>Details of Judgements</h2>
                  <div class="row">
                    <div class="col-lg-12 col-md-6">
                      <div class="room-item reservation-room">
                        <div class="content">
                          <h3><a href="room-details.html">File Search</a></h3>
                          <table class="table table-striped mb-0">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">File No</th>
                                <th scope="col">Year</th>
                                <th scope="col">Action</th>

                              </tr>
                            </thead>
                            <tbody>
                              @php($i = 1)
                              @foreach ($judgements as $key => $item)
                                <tr>
                                  <th scope="row">{{ $i++ }}</th>
                                  <td>{{ $item->file_no }}</td>
                                  <td>{{ $item->year }}</td>
                                  <td> <button type="submit" class="default-btn btn-bg-two border-radius-3">
                                      View
                                    </button></td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                          <ul>
                            <li class="text-color">File No wise search</li>
                            <li><span></span></li>
                          </ul>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tabs_item">
          <div class="reservation-tab-item">
            <div class="row">
              <div class="col-lg-8">
                <div class="reservation-widget-content">
                  <h2>Most Suitable Relevant Rooms</h2>
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img7.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Double Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">320</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img2.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Single Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">300</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="side-bar-form">
                  <h3>Booking Sheet </h3>
                  <form>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check in</label>
                          <div class="input-group">
                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check Out</label>
                          <div class="input-group">
                            <input id="datetimepicker-check" type="text" class="form-control"
                              placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Persons</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Rooms</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                          Book Now
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tabs_item">
          <div class="reservation-tab-item">
            <div class="row">
              <div class="col-lg-4">
                <div class="side-bar-form">
                  <h3>Booking Sheet </h3>
                  <form>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check in</label>
                          <div class="input-group">
                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check Out</label>
                          <div class="input-group">
                            <input id="datetimepicker-check" type="text" class="form-control"
                              placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Persons</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Rooms</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                          Book Now
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="reservation-widget-content">
                  <h2>Most Suitable Relevant Rooms</h2>
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img7.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Double Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">320</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img2.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Single Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">300</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tabs_item">
          <div class="reservation-tab-item">
            <div class="row">
              <div class="col-lg-8">
                <div class="reservation-widget-content">
                  <h2>Most Suitable Relevant Rooms</h2>
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img7.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Double Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">320</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img2.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Single Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">300</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="side-bar-form">
                  <h3>Booking Sheet </h3>
                  <form>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check in</label>
                          <div class="input-group">
                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check Out</label>
                          <div class="input-group">
                            <input id="datetimepicker-check" type="text" class="form-control"
                              placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Persons</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Rooms</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                          Book Now
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tabs_item">
          <div class="reservation-tab-item">
            <div class="row">
              <div class="col-lg-4">
                <div class="side-bar-form">
                  <h3>Booking Sheet </h3>
                  <form>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check in</label>
                          <div class="input-group">
                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check Out</label>
                          <div class="input-group">
                            <input id="datetimepicker-check" type="text" class="form-control"
                              placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Persons</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Rooms</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                          Book Now
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-lg-8">
                <div class="reservation-widget-content">
                  <h2>Most Suitable Relevant Rooms</h2>
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img7.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Double Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">320</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img2.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Single Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">300</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tabs_item">
          <div class="reservation-tab-item">
            <div class="row">
              <div class="col-lg-8">
                <div class="reservation-widget-content">
                  <h2>Most Suitable Relevant Rooms</h2>
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img7.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Double Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">320</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                      <div class="room-item reservation-room">
                        <a href="room-details.html">
                          <img src="assets/img/room/room-img2.jpg" alt="Images">
                        </a>
                        <div class="content">
                          <h3><a href="room-details.html">Single Room</a></h3>
                          <p>You can easily reserve a hotel room with a double bed as you want. This will give you a
                            very good feeling.</p>
                          <ul>
                            <li class="text-color">300</li>
                            <li><span>Per Night</span></li>
                          </ul>
                          <a href="book.html" class="book-btn">Book Now</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="side-bar-form">
                  <h3>Booking Sheet </h3>
                  <form>
                    <div class="row align-items-center">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check in</label>
                          <div class="input-group">
                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Check Out</label>
                          <div class="input-group">
                            <input id="datetimepicker-check" type="text" class="form-control"
                              placeholder="09/29/2020">
                            <span class="input-group-addon"></span>
                          </div>
                          <i class='bx bxs-calendar'></i>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Persons</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>Numbers of Rooms</label>
                          <select class="form-control">
                            <option>01</option>
                            <option>02</option>
                            <option>03</option>
                            <option>04</option>
                            <option>05</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-12 col-md-12">
                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                          Book Now
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('frontend.body.footer')
@endsection
