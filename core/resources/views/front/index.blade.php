@extends('front.layout')
@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")

@section('content')

    <!-- Start Header Section -->
    <div class="banner" style="background-image : url('{{ asset('assets/front/img/herosection_bg.jpg') }}');">
        <div class="overlay">
            <div class="container">
                <div class="intro-text">
                    <h1>Welcome To The <span>{{ $setting->homearea_name }}</span></h1>
                    <p>{!! $setting->homearea_text !!}</p>
                    <a href="#feature" class="page-scroll button">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Section -->


    @if ($setting->is_about_section == 1 )
        <!-- Start About Us Section -->
        <section id="about-section" class="about-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                                <h2>{{ $sectionInfo->about_title }}</h2>
                                <p>{{ $sectionInfo->about_subtitle }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-5">
                        <div class="about-img">
                            <img src="{{ asset('assets/front/img/'. $sectionInfo->about_image) }}" class="img-responsive" alt="About images">
                            <div class="head-text">
                                    {!! $sectionInfo->about_image_text !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="about-text">
                            {!! $sectionInfo->about_description !!}
                        </div>

                        <div class="about-list">
                            <h4>Some important Feature</h4>
                            <ul>
                                @foreach ($abouts as $about)
                                    <li><i class="fas fa-check-square"></i>{{ $about->feature }}</li>
                                @endforeach
                            </ul>

                        </div>

                    </div>



                    </div>
                </div>
        </section>
        <!-- End About us ection -->
    @endif

    @if ($setting->is_team_section == 1)
        <!-- Start Team Member Section -->
        <section id="team-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                            <h2>{{ $sectionInfo->team_title }}</h2>
                            <p>{!! $sectionInfo->team_subtitle !!}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($teams as $team)
                        <div class="col-md-3 wow fadeInLeft team-div" data-wow-duration="2s" data-wow-delay="300ms">
                            <div class="team-member">
                                <img src="{{ asset('assets/front/img/'.$team->image) }}" class="img-responsive" alt="">
                                <div class="team-details">
                                    <h4>{{ $team->name }}</h4>
                                    <p>{{ $team->dagenation }}</p>
                                    <ul>
                                        <li><a href="{{ $team->url1 }}"><i class="{{ $team->icon1 }}"></i></a></li>
                                        <li><a href="{{ $team->url2 }}"><i class="{{ $team->icon2 }}"></i></a></li>
                                        <li><a href="{{ $team->url3 }}"><i class="{{ $team->icon3 }}"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /.col-md-3 -->
                    @endforeach

                </div>
            </div>
        </section>
        <!-- End Team Member Section -->
    @endif

    @if ($setting->is_service_section == 1)
        <!-- Start Service Section -->
        <section id="service-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                            <h2>{{ $sectionInfo->service_title }}</h2>
                            <p>{!! $sectionInfo->service_subtitle !!}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-md-4">
                            <div class="services-post">
                                <a  class="service-image" href="{{ route('front.service_details', $service->slug) }}"><i class="{{ $service->icon }}"></i></a>
                                <a href="{{ route('front.service_details', $service->slug) }}"><h2>{{ $service->name }}</h2></a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Start Service Section -->
    @endif

    @if ($setting->is_testimonial_section == 1)
        <!-- Start Testimonial Section -->
        <section id="testimonial-section" style="background-image: url('{{ asset('assets/front/img/'.$sectionInfo->testimonial_bg) }}');">
            <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                                <h2>{{ $sectionInfo->testimonial_title }}</h2>
                                <p>{!! $sectionInfo->testimonial_subtitle  !!}</p>
                            </div>
                            <div class="testimonial-wrapper">
                                @foreach ($testimonials as $testimonial)
                                    <div class="testimonial-item">
                                        <p> {!! $testimonial->message !!}</p>
                                        <img src="{{ asset('assets/front/img/'.$testimonial->image) }}" alt="Testimonial images">
                                        <div class="stars">
                                            @for ($i = 0; $i < $testimonial->rating; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                        <h5>{{$testimonial->name  }}</h5>
                                        <div class="desgnation">{{ $testimonial->position  }}</div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- End Testimonial Section -->
    @endif

    @if ($setting->is_client_section == 1)
        <!-- Start Client Section -->
        <div id="client-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="client-box">
                                <ul class="client-list">
                                    @foreach ($clients as $client)
                                        <li><a href="{{ $client->url }}"><img src="{{ asset('assets/front/img/'.$client->image) }}" alt="Clients Logo"></a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- End Client Section -->
    @endif


@endsection
