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
                    <h1>{{ $front_dynamic_page->title }}</h1>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{ route('front.index') }}">{{ __('Home') }}<i
                                class="fa fa-angle-double-right"></i></a>
                        <a class="breadcrumb-item" href="#">{{ $front_dynamic_page->title }}</a>
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
                <div class="col-md-12 blog-body  blog-container">
                    <div class="blog-post">
                        <h2 class="text-center">
                            {{ $front_dynamic_page->title }}
                        </h2>
                        <p class="post-content">{!! $front_dynamic_page->content !!}</p>

                    </div>
                </div>
                <!-- End Blog Body Section -->
            </div>
        </div>
    </section>
    <!-- End Blog Page Section -->


@endsection
