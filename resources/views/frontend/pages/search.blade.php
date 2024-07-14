@extends('frontend.main_master')
@section('main')

@section('title')
Cases | 2016-2019
@endsection
<div class="reservation-widget-area pt-100 pb-70">
    <div class="container">
        <div class="tab reservation-tab">
            <ul class="tabs">
                <li>
                    <a href="#">Hotel Room</a>
                </li>

                <li>
                    <a href="#">Conference</a>
                </li>

                <li>
                    <a href="#">Resort Reserve</a>
                </li>

                <li>
                    <a href="#">Weeding Hall</a>
                </li>

                <li>
                    <a href="#">Community Center</a>
                </li>
            </ul>

            <div class="tab_content current active pt-45">
                <div class="tabs_item current">
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
                                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
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
                                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
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
                                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                    <p>You can easily reserve a hotel room with a double bed as you want. This will give you a very good feeling.</p>
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
                                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
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
@endsection
