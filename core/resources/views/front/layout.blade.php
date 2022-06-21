<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="@yield('meta-description')">
	<meta name="keywords" content="@yield('meta-keywords')">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ $setting->website_title }}</title>

	<link rel="shortcut icon" href="{{ asset('assets/front/img/' . $commonsetting->fav_icon) }}" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/bootstrap.min.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/font-awesome.min.css') }}">


    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/owl.theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/owl.transitions.css') }}">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/animate.css') }}">
    <!-- Lightbox CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/lightbox.css') }}">
    <!-- Sulfur CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style.css') }}">
    <!-- Responsive CSS Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/responsive.css') }}">



    <!-- dynamic Style change -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/dynamic-css.css') }}">
	<link rel="stylesheet" href="{{ url('/') }}/assets/front/css/dynamic-style.php?color={{ $commonsetting->base_color }}">

	@if($currentLang->direction == 'rtl')
	<!-- RTL css -->
	<link rel="stylesheet" href="{{ asset('/') }}assets/front/css/rtl.css">

	@endif

    <script src="{{ asset('assets/front/js/modernizrr.js') }} "></script>

</head>
<body>
    {{-- site hreader --}}
    <header class="clearfix">

        <!-- Start Top Bar -->
        <div class="top-bar">
            <div class="container">
                        <div class="row">

                            <div class="col-md-6">
                                    <!-- Start Contact Info -->
                                    <ul class="contact-details">
                                        <li><a href="#">
                                                <i class="fas fa-phone"></i>
                                                @php
                                                $number = explode( ',', $commonsetting->number );
                                                @endphp
                                                {{ $number[0] }}
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <i class="fas fa-envelope"></i>
                                                @php
                                                $number = explode( ',', $commonsetting->email );
                                                @endphp
                                                {{ $number[0] }}
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- End Contact Info -->
                            </div><!-- .col-md-6 -->

                            <div class="col-md-6 align-self-center">
                                <div class="row">
                                    <div class="col-sm-7 text-align-end">
                                        <div class="language-section">
                                            <a href=""><i class="fas fa-globe"></i> {{ $currentLang->name }}</a>
                                            <div class="language-menu">
                                                @foreach ($langs as $lang)
                                                <a href="{{ route('front.changeLang', $lang->code) }}" class="{{ $lang->name == $currentLang->name ? 'active' : '' }}">{{ $lang->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <!-- Start Social Links -->
                                        <ul class="social-list">
                                            @foreach ($socials as $social)
                                                <li>
                                                    <a href="{{ $social->url }}"><i class="{{ $social->icon }}"></i></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- End Social Links -->
                                    </div>
                                </div>
                            </div><!-- .col-md-6 -->
                        </div>
            </div><!-- .container -->
        </div>
        <!-- End Top Bar -->

        <!-- Start  Logo & Naviagtion  -->
        <div class="navbar navbar-default navbar-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Stat Toggle Nav Link For Mobiles -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- End Toggle Nav Link For Mobiles -->
                    <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/front/img/' . $commonsetting->header_logo) }}" alt=""></a>
                </div>
                <div class="navbar-collapse collapse">

                    <!-- Start Navigation List -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class=" @if(request()->path() == '/') active @endif" href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        </li>
                        @if ($commonsetting->is_about_page == 1)
                            <li>
                                <a class="@if(request()->path() == 'about') active @endif" href="{{ route('front.about') }}">{{ __('About') }}</a>
                            </li>
                        @endif

                        @if ($commonsetting->is_service_page == 1)
                            <li>
                                <a class="
                                @if (request()->path() == 'service')active
                                @elseif(request()->is('service/*'))active
                                @endif" href="{{ route('front.service') }}">{{ __('Service') }}</a>
                            </li>
                        @endif

                        @if ($commonsetting->is_blog_page == 1)
                            <li>
                                <a class="@if (request()->path() == 'blog')active
                                @elseif(request()->is('blog/*'))active
                                @endif" href="{{ route('front.blogs') }}">{{ __('Blog') }}</a>
                            </li>
                        @endif

                        @if ($commonsetting->is_contact_page == 1)
                            <li>
                                <a class="@if(request()->path() == 'contact') active @endif" href="{{ route('front.contact') }}">{{ __('Contact') }}</a>
                            </li>
                        @endif



                    </ul>
                    <!-- End Navigation List -->
                </div>
            </div>
        </div>
        <!-- End Header Logo & Naviagtion -->

    </header>



    @yield('content')



    <!-- Start Footer Section -->
    <section id="footer-section" class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="section-heading-2">
                            <h3 class="section-title">
                                <span>{{ $setting->footer_text }}</span>
                            </h3>
                        </div>

                    </div><!--/.col-md-3 -->


                    <div class="col-md-4">
                        <div class="section-heading-2">
                            <h3 class="section-title">
                                <span>{{ __('Newsletter') }}</span>
                            </h3>
                        </div>
                        <div class="subscription">
                            <div class="form-area">
                                <input type="text" class="form-control" placeholder="Your E-mail" id="name" required data-validation-required-message="Please enter your name.">
                                <button type="submit"><i class="fas fa-envelope"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="section-heading-2">
                            <h3 class="section-title">
                                <span>{{ __('Connect with us on social media :') }}</span>
                            </h3>
                        </div>

                        <div class="footer-social">
                            <ul>
                                @foreach ($socials as $social)
                                    <li>
                                        <a href="{{ $social->url }}"><i class="{{ $social->icon }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!--/.col-md-3 -->
                </div><!--/.row -->
            </div><!-- /.container -->
    </section>
        <!-- End Footer Section -->

        <!-- Start CCopyright Section -->
    <div id="copyright-section" class="copyright-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            {!! $setting->copyright_text !!}
                        </div>
                        <div class="dynamic-style">
                            <ul>
                                @foreach ($front_dynamic_pages as $front_dynamic_page)
                                    <li><a href="{{ route('front.front_dynamic_page', $front_dynamic_page->slug) }}">{{ $front_dynamic_page->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>


                    </div>

                </div><!--/.row -->
            </div><!-- /.container -->
    </div>
        <!-- End CCopyright Section -->


    <!-- Sulfur JS File -->
    <script src="{{ asset('assets/front/js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.fitvids.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/count-to.js') }}"></script>
    <script src="{{ asset('assets/front/js/styleswitcher.js') }}"></script>

    <script src="{{ asset('assets/front/js/script.js') }}"></script>

</body>
</html>
