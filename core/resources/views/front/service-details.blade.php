@extends('front.layout')
@section('meta-keywords', "$setting->meta_keywords")
@section('meta-description', "$setting->meta_description")

@section('content')

    <!-- Start Header Section -->
    <div class="page-header" style="background-image: url('{{ asset('assets/front/img/breadcrumb_image_.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $sectionInfo->service_title }}</h1>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{ route('front.index') }}">{{ __('Home') }} <i
                                class="fa fa-angle-double-right"></i></a>
                        <a class="breadcrumb-item" href="{{ route('front.service') }}">{{ __('Service') }}<i
                                class="fa fa-angle-double-right"></i></a>
                        <span class="breadcrumb-item active">{{ $service->name }}</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Section -->

    <!-- Start Blog Page Section -->
    <section class="blog-section">
        <div class="container">
            <div class="row">

                <!-- Start Blog Body Section -->
                <div class="col-md-8 blog-body  blog-container">
                    <div class="blog-post">
                        <div class="post-img">
                            <img src="{{ asset('assets/front/img/' . $service->image) }}" class="img-responsive"
                                alt="Blog image">
                        </div>
                        <h4 class="post-title"><a
                                href="#">{{  $service->name  }}</a>
                        </h4>

                        <p class="post-content">{!! $service->content !!}</p>

                    </div>
                    <!-- End Blog Post -->
                </div>
                <!-- End Blog Body Section -->

                <!-- Start Sidebar Section -->
                <div class="col-md-4 sidebar right-sidebar">

                    <!-- Start Blog categories widget -->
                    <div class="widget widget-categories">

                        <div class="section-heading-2">
                            <h3 class="section-title">
                                <span>{{ __('Service Categories') }}</span>
                            </h3>
                        </div>

                        <ul>
                            @foreach ($all_services as $all_service)
                                <li class="blog-category-list">
                                    <i class="fa fa-angle-double-right"></i>
                                    <a class="@if ($service->slug == $all_service->slug) active @endif"
                                        href="{{ route('front.service_details', $all_service->slug) }}">{{ $all_service->name }}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <!-- End Blog categories widget -->


                </div>
                <!-- End Sidebar Section -->

            </div>
        </div>
    </section>
    <!-- End Blog Page Section -->

@endsection
