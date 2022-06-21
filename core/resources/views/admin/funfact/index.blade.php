@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('FunFact') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('FunFact') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('FunFacts Content') }}</h3>
                        <div class="card-tools">
                            <div class="d-inline-block mr-4">
                                <select class="form-control lang languageSelect" data="{{url()->current() . '?language='}}">
                                    @foreach($langs as $lang)
                                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.update_funfactcontent',  $sectiontitle->language_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Funfact BG Image') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <img class="mw-400 mb-3 show-img img-demo" src="
                                    @if($sectiontitle->funfact_bg)
                                    {{ asset('assets/front/img/'.$sectiontitle->funfact_bg) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }}
                                    @endif" alt="">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="funfact_bg">Choose New Image</label>
                                        <input type="file" class="custom-file-input up-img" name="funfact_bg" id="funfact_bg">
                                    </div>
                                    <p class="help-block text-info">{{ __('Upload 1920X500 (Pixel) Size image for best quality.
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
                    <h3 class="card-title mt-1">{{ __('FunFacts List') }}</h3>
                    <div class="card-tools d-flex">
                        <div class="d-inline-block mr-4">
                            <select class="form-control lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                @foreach($langs as $lang)
                                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('admin.add_funfact'). '?language=' .request()->input('language') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> {{ __('Add offer') }}
                        </a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Icon') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Value') }}</th>
                                <th>{{ __('Action') }}</th>
                                </tr>
                        </thead>
                        <tbody>

                        @foreach ($funfacts as $id=>$funfact)
                        <tr>
                            <td>{{ ++$id }}</td>
                            <td>
                               {{ $funfact->icon }}
                            </td>
                            <td>{{ $funfact->name }}</td>
                            <td>{{ $funfact->value }}</td>
                            <td>
                                <a href="{{ route('admin.edit_funfact', $funfact->id )  }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>

                                <form  id="deleteform" class="d-inline-block" action="{{ route('admin.delete_funfact', $funfact->id ) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $funfact->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                    <i class="fas fa-trash"></i>{{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
@endsection
