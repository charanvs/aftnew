@extends('frontend.main_master')
@section('main')
@section('title')
  AFT-PB | Gallery
@endsection

<style>
    .gallery-area {
        background-color: #f8f9fa;
        padding-top: 100px;
        padding-bottom: 70px;
    }
    .section-title h2 {
        font-size: 2.5rem;
        color: #1d4ed8;
        text-shadow: 1px 1px 2px #000000;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .gallery-tab .tabs {
        margin-bottom: 45px;
    }
    .gallery-tab .tabs li {
        display: inline-block;
        margin-right: 15px;
    }
    .gallery-tab .tabs li a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3b82f6;
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        text-transform: uppercase;
    }
    .gallery-tab .tabs li a:hover,
    .gallery-tab .tabs li a.active {
        background-color: #2563eb;
        color: #ffffff;
    }
    .single-gallery {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .single-gallery:hover {
        transform: scale(1.05);
    }
    .single-gallery img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 10px;
    }
    .gallery-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: #ffffff;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .single-gallery:hover .gallery-icon {
        opacity: 1;
    }
</style>

<!-- Gallery Area -->
<div class="gallery-area pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Gallery</h2>
        </div>

        <div class="tab gallery-tab">
            <ul class="tabs text-center">
                <li>
                    <a href="#" class="active">Event 1</a>
                </li>
                <li>
                    <a href="#">Event 2</a>
                </li>
                <li>
                    <a href="#">Event 3</a>
                </li>
                <li>
                    <a href="#">Event 4</a>
                </li>
                <li>
                    <a href="#">Event 5</a>
                </li>
            </ul>

            <div class="tab_content current active pt-45">
                <div class="tabs_item current">
                    <div class="gallery-tab-item">
                        <div class="gallery-view">
                            <div class="row">
                                @foreach($data as $item)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-gallery">
                                        <img src="{{ asset($item->image) }}" alt="Images">
                                        <a href="{{ asset($item->image) }}" class="gallery-icon">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabs_item">
                    <div class="gallery-tab-item">
                        <div class="gallery-view">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-gallery">
                                        <img src="{{ asset('frontend/assets/img/gallery/gallery-img1.jpg') }}" alt="Images">
                                        <a href="{{ asset('frontend/assets/img/gallery/gallery-img1.jpg') }}" class="gallery-icon">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabs_item">
                    <div class="gallery-tab-item">
                        <div class="gallery-view">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single-gallery">
                                        <img src="{{ asset('frontend/assets/img/gallery/gallery-img1.jpg') }}" alt="Images">
                                        <a href="{{ asset('frontend/assets/img/gallery/gallery-img1.jpg') }}" class="gallery-icon">
                                            <i class='bx bx-plus'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Gallery Area End -->

@endsection
