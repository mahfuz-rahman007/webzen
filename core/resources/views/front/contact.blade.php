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
                    <h1>{{ __('Contact') }}</h1>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{ route('front.index') }}">{{ __('Home') }}<i class="fa fa-angle-double-right"></i></a>
                        <a class="breadcrumb-item" href="#">{{ __('Contact') }}</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Section -->


    <!-- Contact Us Area Start -->
	<section class="contact-us">
		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                        <h2>{{ __('Contact') }}</h2>
                    </div>
                </div>
            </div>
			<div class="row ">
				<div class="col-lg-7">
					<div class="left-area">
						<div class="contact-form">
                            @if(session()->has('success'))
                                <p class="text-success">{{ session('success') }}</p>
                            @endif
							<form action="{{ route('front.contact_submit') }}" method="POST">
                                @csrf
								<ul>
									<li>
										<input type="text" name="name" class="input-field" placeholder="Name">
									</li>
									<li>
										<input type="email" name="email" class="input-field" placeholder="Email Address">
									</li>
									<li>
										<input type="number" name="phone" class="input-field" placeholder="Phone Number">
									</li>
									<li>
										<textarea name="message" class="input-field textarea" placeholder="Your Message"></textarea>
									</li>
								</ul>
								<button class="submit-btn" type="submit">Send Message</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-5 align-self-center">
					<div class="right-area">
						<div class="contact-info">
							<div class="left ">
									<div class="icon">
										<i class="fas fa-envelope"></i>
									</div>
							</div>
							<div class="content">
									<h4 class="title">
										Email
									</h4>
									@php
										$email = explode( ',', $commonsetting->email );
										for ($i=0; $i < count($email); $i++) {
											echo '<a href="mailto:'.$email[$i].'">'.$email[$i].'</a>';
										}
									@endphp
							</div>
                        </div>
                        <div class="contact-info">
							<div class="left ">
									<div class="icon">
										<i class="fas fa-phone"></i>
									</div>
							</div>
							<div class="content">
									<h4 class="title">
										Phone
									</h4>
									@php
										$number = explode( ',', $commonsetting->number );
										for ($i=0; $i < count($number); $i++) {
											echo '<a href="tel:'.$number[$i].'">'.$number[$i].'</a>';
										}
									@endphp
							</div>
						</div>
						<div class="contact-info">
							<div class="left ">
									<div class="icon">
										<i class="fas fa-location-arrow"></i>
									</div>
							</div>
							<div class="content">
									<h4 class="title">
										Location
									</h4>
                                   {{ $setting->address }}
							</div>
						</div>

						<div class="social-links">
							<h4 class="title">Find us here :</h4>
							<ul>
                                @foreach ($socials as $social)
                                <li>
                                    <a href="{{ $social->url }}"><i class="{{ $social->icon }}"></i></a>
                                </li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact Us Area End-->

@endsection
