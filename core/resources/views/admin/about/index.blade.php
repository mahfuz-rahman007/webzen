@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('About') }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('About') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('About Content') }}</h3>
                        <div class="card-tools">
                            <div class="d-inline-block mr-4">
                        <select class="form-control lang languageSelect"  data="{{url()->current() . '?language='}}">
                            @foreach($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                            @endforeach
                        </select>
                    </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.update_aboutcontent',  $sectiontitle->language_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="language" value="{{ request()->input('language') }}">
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('About Title') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="about_title" placeholder="{{ __('About Title') }}" value="{{ $sectiontitle->about_title }}">
                                    @if ($errors->has('about_title'))
                                        <p class="text-danger"> {{ $errors->first('about_title') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('About Subtitle') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <textarea name="about_subtitle" class="form-control summernote" placeholder="{{ __('About Description') }}" rows="5">{{ $sectiontitle->about_subtitle }}</textarea>
                                    @if ($errors->has('about_subtitle'))
                                        <p class="text-danger"> {{ $errors->first('about_subtitle') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('About Description') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <textarea name="about_description" class="form-control summernote" placeholder="{{ __('About Description') }}" rows="5">{{ $sectiontitle->about_description }}</textarea>
                                    @if ($errors->has('about_description'))
                                        <p class="text-danger"> {{ $errors->first('about_description') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('About Image Text') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <textarea name="about_image_text" class="form-control summernote" placeholder="{{ __('About Image Text') }}" rows="5">{{ $sectiontitle->about_image_text }}</textarea>
                                    @if ($errors->has('about_image_text'))
                                        <p class="text-danger"> {{ $errors->first('about_image_text') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('About Image') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="w-100 mb-3 show-img img-demo" src="
                                    @if($sectiontitle->about_image)
                                    {{ asset('assets/front/img/'.$sectiontitle->about_image) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="about_image">Choose New Image</label>
                                        <input type="file" class="custom-file-input up-img" name="about_image" id="about_image">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 550X550 (Pixel) Size image for best quality.
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
                        <h3 class="card-title mt-1">{{ __('About Features') }}</h3>
                        <div class="card-tools d-flex">
                            <div class="d-inline-block mr-4">
                                <select class="form-control lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                    @foreach($langs as $lang)
                                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <a href="{{ route('admin.add_about'). '?language=' .request()->input('language') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> {{ __('Add About Feature') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Options') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($abouts as $id=>$about)
                            <tr>
                                <td>
                                    {{ ++$id }}
                                </td>
                                <td>
                                    {{ $about->feature }}
                                </td>
                                <td>
                                    @if($about->status == 1)
                                        <span class="badge badge-success">{{ __('Publish') }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('admin.edit_about', $about->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                    <form  id="deleteform" class="d-inline-block" action="{{ route('admin.delete_about', $about->id ) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $about->id }}">
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
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
