@extends('front.layout')
@section('meta-keywords', "$blog->meta_keywords")
@section('meta-description', "$blog->meta_description")

@section('content')
    <!-- Start Header Section -->
    <div class="page-header" style="background-image: url('{{ asset('assets/front/img/'.$commonsetting->breadcrumb_image) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $sectionInfo->blog_title }}</h1>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="{{ route('front.index') }}">{{ __('Home') }} <i
                                class="fa fa-angle-double-right"></i></a>
                        <a class="breadcrumb-item" href="{{ route('front.blogs') }}">{{ __('Blog') }}<i
                                class="fa fa-angle-double-right"></i></a>
                        <span class="breadcrumb-item active">{{ $blog->title }}</span>
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
                    <div class="row">
                                <!-- Start Blog post -->
                                <div class="col-md-12">
                                    <div class="blog-post">
                                        <div class="post-img">
                                            <img src="{{ asset('assets/front/img/'. $blog->main_image) }}" class="img-responsive" alt="Blog image">
                                        </div>
                                        <h4 class="post-title"><a>{{ $blog->title }}</a></h4>

                                        <ul class="post-meta">
                                            <li><i class="fas fa-clock-o"></i>{{date ( 'd M, Y', strtotime($blog->created_at) )}}</li>
                                            <li><i class="fas fa-user"></i><a href="#">{{ __('User') }}</a></li>
                                            <li><i class="fas fa-tags"></i><a href="#">{{ $blog->bcategory->name }}</a></li>
                                        </ul>
                                        <p class="post-content">{!! $blog->content !!}</p>

                                    </div>
                                    <!-- End Blog Post -->
                                </div>
                    </div>

                </div>
                <!-- End Blog Body Section -->

                <!-- Start Sidebar Section -->
                <div class="col-md-4 sidebar right-sidebar">

                    <div class="card search-section">
                        <div class="search-form ">
                            <form action="{{route('front.blogs', ['category' => request()->input('category')]) }}" method="GET">
                                    <div class="searchbar">
                                        <input type="text" name="term" class="input-field" placeholder="{{ __('Search Blogs') }}" value="{{ request()->input('term')}}">
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                            </form>
                        </div>
                    </div>

                    <!-- Start Blog categories widget -->
                    <div class="widget widget-categories">

                        <div class="section-heading-2">
                            <h3 class="section-title">
                                <span>{{ __('Blog Categories') }}</span>
                            </h3>
                        </div>

                        <ul>
                            <li class="blog-category-list">
                                <i class="fa fa-angle-double-right"></i>
                                <a class="@if(request()->path() == 'blog') active @endif" href="{{ route('front.blogs') }}">{{ __('All Blog') }}</a>
                                <span href="#" class="cat-counter">({{ $count_blog }})</span>
                            </li>
                            @foreach ($bcategories as $bcategory)
                                <li class="blog-category-list">
                                    <i class="fa fa-angle-double-right"></i>
                                    <a  class="@if($blog->bcategory->slug  == $bcategory->slug) active @endif" href="{{ route('front.blogs', [ 'term' => request()->input('term') ,'category' => $bcategory->slug ]) }}">{{ $bcategory->name }}</a>
                                    <span href="#" class="cat-counter">({{ $bcategory->blogs->count() }})</span>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <!-- End Blog categories widget -->

                    <!-- Start Recent Post Widget -->
                    <div class="widget widget-recent-post">

                        <div class="section-heading-2">
                            <h3 class="section-title">
                                <span>{{ __('Recent Blogs') }}</span>
                            </h3>
                        </div>
                        @foreach ($latestBlogs as $latestBlog)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="{{ asset('assets/front/img/'. $latestBlog->main_image) }}" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{{ route('front.blog_details', $latestBlog->slug) }}">
                                            {{ (strlen(strip_tags(Helper::convertUtf8($latestBlog->title))) > 50) ? substr(strip_tags(Helper::convertUtf8($latestBlog->title)), 0, 50) . '...' : strip_tags(Helper::convertUtf8($latestBlog->title)) }}
                                        </a>
                                    </h4>
                                    <ul>
                                        <li><a href="#">{{ __('User') }}</a></li>
                                        <li>{{date ( 'd M, Y', strtotime($latestBlog->created_at) )}}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- End Recent Post Widget -->

                </div>
                <!-- End Sidebar Section -->

            </div>
        </div>
</section>
<!-- End Blog Page Section -->

@endsection
