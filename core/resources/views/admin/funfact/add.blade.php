@extends('admin.layout')

@section('content')

<section class="content-header">
    <h1>
       {{ __('FunFact') }}
    </h1>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header  with-border">
                        <h3 class="card-title mt-1">{{ __('Add New Facts') }}</h3>
                        <div class="card-tools">
                        <a href="{{ route('admin.funfact'). '?language=' . request()->input('language') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                        </a>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form  id="slink" class="form-horizontal" action="{{ route('admin.store_funfact') }}" method="POST" enctype="multipart/form-data" onsubmit="store(event)">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Language') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <select class="form-control lang" name="language_id">
                                        @foreach($langs as $lang)
                                            <option value="{{$lang->id}}" {{ $lang->code == request()->input('language') ? 'selected' : '' }} >{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('language_id'))
                                        <p class="text-danger"> {{ $errors->first('language_id') }} </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-2 control-label">{{ __('Funfact Icon') }}<span
                                class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <button class="btn btn-secondary biconpicker" data-iconset="fontawesome5" data-icon="fab fa-facebook-f" role="iconpicker"></button>
                                    <input id="inputIcon" type="hidden" name="icon"  value="">
                                    @if ($errors->has('icon'))
                                    <p class="text-danger"> {{ $errors->first('icon') }} </p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{ __('Name') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="{{ __('Enter Fact Name') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="value" class="col-sm-2 control-label">{{ __('Value') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="value" placeholder="{{ __('Enter Fact Value') }}">
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
    </div>
    <!-- /.row -->

</section>
@endsection
