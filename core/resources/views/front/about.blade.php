@extends('front.layout')
@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")

@section('content')

    <!-- Start Header Section -->
    <div class="page-header" style="background-image: url('{{ asset('assets/front/img/'.$commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $sectionInfo->about_title }}</h1>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{ route('front.index') }}">{{ __('Home') }}<i class="fa fa-angle-double-right"></i></a>
                        <a class="breadcrumb-item" href="#">{{ __('About') }}</a>
                    </nav>
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


    <!-- Start Fun Facts Section -->
    <section class="fun-facts" style="background-image: url('{{ asset('assets/front/img/'. $sectionInfo->funfact_bg) }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    @foreach ($funfacts as $funfact)
                        <div class="col-xs-12 col-sm-3 col-md-3 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="300ms">
                            <div class="counter-item">
                                <i class="{{ $funfact->icon }}"></i>
                                <div class="timer" id="item1" data-to="{{ $funfact->value }}" data-speed="5000"></div>
                                <h3>{{ $funfact->name }}</h3>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
    </section>
    <!-- End Fun Facts Section -->

    <!-- Start About-section 2 -->
        <section id="about-section-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="300ms">

                            <!-- Start Accordion Section -->
                            <div class="panel-group" id="accordion">

                                @foreach ($faqs as $faq)
                                    <!-- Start Accordion 1 -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 data-toggle="collapse" aria-expanded="@if ($loop->first) true @endif" data-target="#id{{ $faq->id }}" aria-controls="id{{ $faq->id }}"
                                            class="panel-title">
                                                {{ $faq->title }}
                                            </h4>
                                        </div>
                                        <div id="id{{ $faq->id }}" class="panel-collapse collapse @if ($loop->first) in @endif" aria-labelledby="id{{ $faq->id }}" data-parent="#accordion">
                                            <div class="panel-body">
                                                {!! $faq->content !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Accordion 1 -->
                                @endforeach


                            </div>
                            <!-- End Accordion section -->

                        </div><!--/.col-md-6 -->
                        </div>
                    </div>
        </section>
    <!-- Start About-section 2 -->

@endsection
