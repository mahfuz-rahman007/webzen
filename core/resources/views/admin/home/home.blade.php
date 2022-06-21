@extends('admin.layout')

@section('content')
{{-- profile Header --}}
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
              <h1 class="m-0 text-dark">{{ __('Home Static') }}</h1>
            </div>
            <div class="col-md-6">
              <div class="breadcrumb float-sm-right">
                  <div class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"> <i class="fas fa-home"></i>{{ __('Home') }}</a> </div>
                  <div class="breadcrumb-item">{{ __('Home Static') }}</div>
              </div>
            </div>
        </div>
    </div>
</div>

{{-- profile information --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="card card-primary card-outline">

                  <div class="card-header">
                      <h3 class="card-title">{{ __('Update Home Details') }}</h3>
                      <div class="card-tools d-flex">
                        <div class="d-inline-block mr-4">
                            <select class="form-control lang languageSelect" data="{{ url()->current(). '?language='}}">
                                @foreach ($langs as $lang)
                                <option value="{{ $lang->code }}" {{ $lang->code == request()->input('language') ? 'selected':'' }}>{{ $lang->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>

                  <div class="card-body">
                      <form class="form-horizontal" action="{{ route('admin.update_home') }}" method="post" enctype="multipart/form-data">
                          @csrf

                          <input type="hidden" name="language" value={{ request()->input('language') }}>
                          <div class="row justify-content-center">
                              <div class="col-lg-10">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <img class="mw-400 mb-3 show-img img-demo" src="{{ asset('assets/front/img/homearea_bg.jpg') }}" alt="">
                                            <div class="custom-file">
                                                <label for="homearea_bg" class="custom-file-label">{{ __('Choose New Image') }}</label>
                                                <input type="file" name="homearea_bg" id="homearea_bg" class="custom-file-input up-img">
                                                <p class="text-block text-info">
                                                    {{ __('Upload 1920X970 (Pixel) size image for best quality. Only jpg,jpeg and png image is allowed') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="website_title" class="col-sm-12 control-label mb-3">{{ __('Home area Name') }} <span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" name="homearea_name" id="homearea_name" class="form-control" value="{{$home->homearea_name}}" placeholder="{{ __('Home area Name') }}">

                                            @if($errors->has('homearea_name'))
                                                <p class="text-danger">{{ $errors->first('homearea_name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="website_title" class="col-sm-12 control-label mb-3">{{ __('Home area Text') }} <span class="text-danger">*</span></label>
                                        <div class="col-sm-12">
                                            <textarea name="homearea_text" class="form-control summernote" placeholder="{{ __('Home area Text') }}">{{ $home->homearea_text }}</textarea>

                                            @if($errors->has('cookie_alert_text'))
                                                 <p class="text-danger">{{ $errors->first('cookie_alert_text') }}</p>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="submit" value="Update" class="btn btn-primary btn-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </form>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
