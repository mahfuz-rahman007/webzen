@extends('admin.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Testimonials') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Testimonials') }}</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Testimonial Content') }}</h3>
                        <div class="card-tools">
                            <div class="d-inline-block mr-4">
                                <select class="form-control lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                    @foreach($langs as $lang)
                                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.update_testimonialcontent',  $sectiontitle->language_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Testimonial Title') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="testimonial_title" placeholder="{{ __('Testimonial Title') }}" value="{{ $sectiontitle->testimonial_title }}">
                                    @if ($errors->has('testimonial_title'))
                                        <p class="text-danger"> {{ $errors->first('testimonial_title') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('Testimonial Sub-title') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <textarea  class="form-control summernote" name="testimonial_subtitle" id="testimonial_subtitle"  placeholder="{{ __('Testimonial Sub-Title') }}" >{{ $sectiontitle->testimonial_subtitle }}</textarea>
                                    @if ($errors->has('testimonial_subtitle'))
                                        <p class="text-danger"> {{ $errors->first('testimonial_subtitle') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Testimonial BG Image') }} </label>
                                <div class="col-sm-10">
                                    <img class="mw-400 mb-3 show-img img-demo" src="
                                    @if($sectiontitle->testimonial_bg)
                                    {{ asset('assets/front/img/'.$sectiontitle->testimonial_bg) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="testimonial_bg">Choose New Image</label>
                                        <input type="file" class="custom-file-input up-img" name="testimonial_bg" id="testimonial_bg">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 1920X900 (Pixel) Size image for best quality.
                                        Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h3 class="card-title mt-1">{{ __('Testimonials List') }}</h3>
                    <div class="card-tools d-flex">
                        <div class="d-inline-block mr-4">
                            <select class="form-control lang languageSelect" data="{{url()->current() . '?language='}}">
                                @foreach($langs as $lang)
                                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('admin.add_testimonial'). '?language=' . request()->input('language') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> {{ __('Add Testimonial') }}
                        </a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body no-padding">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Position') }}</th>
                                <th>{{ __('Message') }}</th>
                                <th>{{ __('Action') }}</th>
                                </tr>
                        </thead>
                        <tbody>

                        @foreach ($testimonials as $id=>$testimonial)
                        <tr>
                            <td>{{ ++$id }}</td>
                            <td>
                                <img class="w-80" src="{{ asset('assets/front/img/'.$testimonial->image) }}" alt="">
                            </td>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->position}}</td>
                            <td width="40%">{!! $testimonial->message !!}</td>
                            <td width="18%">
                                <a href="{{ route('admin.edit_testimonial', $testimonial->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                <form  id="deleteform" class="d-inline-block" action="{{ route('admin.delete_testimonial', $testimonial->id ) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $testimonial->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                    <i class="fas fa-trash"></i>{{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
