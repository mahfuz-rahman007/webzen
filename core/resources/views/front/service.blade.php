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
                        <a class="breadcrumb-item" href="{{ route('front.index') }}">{{ __('Home') }}<i class="fa fa-angle-double-right"></i></a>
                        <a class="breadcrumb-item" href="#">{{ __('Service') }}</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Section -->

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


	<!-- Pricingplan Area Start -->
	<section class="pricingPlan-section packag-page">
		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center wow fadeInDown" data-wow-duration="2s" data-wow-delay="50ms">
                        <h2>{{ $sectionInfo->plan_title }}</h2>
                        <p>{!! $sectionInfo->plan_subtitle !!}</p>
                    </div>
                </div>
            </div>
			<div class="row justify-content-center">
                @foreach($plans as $key => $plan)
                <div class="col-lg-4 col-md-6">
                    <div class="single-price">
                        <h4 class="name">
                            {{ $plan->name }}
                        </h4>

                        <div class="list">
                            @php
								$feature = explode( ',', $plan->feature );
								for ($i=0; $i < count($feature); $i++) {
									echo '<li><p href="mailto:'.$feature[$i].'">'.$feature[$i].'</p></li>';
								}
							@endphp
                        </div>
                        <div class="bottom-area">
                            <div class="price-area">
								<div class="price-top-area">
									@if($plan->discount_price == null)
										<p class="price showprice">{{ Helper::showCurrency() }}{{ $plan->price }}</p>
									@else
										<p class="discount_price showprice">{{ Helper::showCurrency() }}{{ $plan->discount_price }}</p>
										<p class="price discounted"><del>{{ Helper::showCurrency() }}{{ $plan->price }}</del></p>
									@endif
								</div>
								<p class="time">
									{{ $plan->time }}
								</p>
							</div>
							<a href="#" class="button">{{ __('Get Start') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
			</div>
		</div>
	</section>
	<!-- Pricingplan Area End -->







@endsection
