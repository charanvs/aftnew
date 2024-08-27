@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Members
@endsection

<style>
    /* General Styles */
    .team-area-three {
        background-color: #f0f4f8;
    }
    .section-title h2 {
        font-size: 2.5rem;
        color: #1d4ed8;
        text-shadow: 1px 1px 2px #000000;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .section-title .sp-color {
        color: #3b82f6;
        font-size: 1.5rem;
        text-transform: uppercase;
        font-weight: bold;
    }
    .team-item {
        background: linear-gradient(135deg, #3b82f6 0%, #0ea5e9 100%);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .team-item:hover {
        transform: translateY(-10px);
    }
    .team-item img {
        width: 100%;
        border-bottom: 4px solid #1d4ed8;
    }
    .content {
        padding: 20px;
        text-align: center;
    }
    .content h3 {
        font-size: 1.75rem;
        color: #ffffff;
        font-weight: bold;
        margin-bottom: 10px;
        text-shadow: 1px 1px 2px #000000;
    }
    .content span {
        font-size: 1.25rem;
        color: #e0f7ff;
        display: block;
        margin-bottom: 15px;
    }
    .social-link li {
        display: inline-block;
        margin: 0 5px;
    }
    .social-link li a {
        font-size: 1.25rem;
        color: #ffffff;
        transition: color 0.3s ease;
    }
    .social-link li a:hover {
        color: #1d4ed8;
    }
    .thick-hr {
        border: 2px solid #3b82f6;
        margin: 30px 0;
    }
    .owl-carousel .team-item {
        margin: 10px;
    }
</style>

<!-- Team Area Three -->
<div class="team-area-three pt-10 pb-10">
  <div class="container">
    <div class="section-title text-center">
      <span class="sp-color">Members</span>
      <h2>Members</h2>
    </div>

    <div class="row justify-content-center pt-15">
      <div class="col-lg-4 col-md-6">
        <div class="team-item">
          <a href="team.html">
            <img src="{{ asset($chair->image) }}" alt="Images">
          </a>
          <div class="content">
            <h3><a href=""></a>{{ $chair->name }}</h3>
            <span>{{ $chair->salutation }}</span>
            <ul class="social-link">
              <li>
                <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <hr class="thick-hr">
    
    <div class="row justify-content-center pt-45">
      <div class="col-lg-4 col-md-6">
        <div class="team-item">
          <a href="team.html">
            <img src="{{ asset($second->image) }}" alt="Images">
          </a>
          <div class="content">
            <h3><a href=""></a>{{ $second->name }}</h3>
            <span>{{ $second->salutation }}</span>
            <ul class="social-link">
              <li>
                <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <hr class="thick-hr">
    
    <div class="team-slider-two owl-carousel owl-theme pt-45">
      @foreach ($data as $item)
        <div class="team-item">
          <a href="team.html">
            <img src="{{ asset($item->image) }}" alt="Images">
          </a>
          <div class="content">
            <h3><a href=""></a>{{ $item->name }}</h3>
            <span>{{ $item->salutation }}</span>
            <ul class="social-link">
              <li>
                <a href="#" target="_blank"><i class='bx bxl-facebook'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-twitter'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-instagram'></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  
  <hr class="thick-hr">
</div>

@endsection
