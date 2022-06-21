@extends('admin.layout')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Scripts') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"> <a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a> </li>
                        <li class="breadcrumb-item">{{ __('Scripts') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Update Scripts') }}</h3>
                        </div>

                        <div class="card-body">
                            <form id="slink" class="form-horizontal" action="{{ route('admin.update_script') }}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label">{{ __('Tawk.to Status') }}<span
                                    class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" {{ $scripts->is_tawk_to == '1' ? 'checked':'' }} name="is_tawk_to" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive" >
                                        @if ($errors->has('is_tawk_to'))
                                        <p class="text-danger"> {{ $errors->first('is_tawk_to') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="meta_description" class="col-sm-2 control-label">{{ __('Tawk.to Widget Code') }}<span
                                    class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <textarea type="text" name="tawk_to" id="tawk_to" class="form-control" placeholder="{{ __('Tawk.to Widget Code') }}" rows="4">{!! $scripts->tawk_to !!}</textarea>
                                        @if($errors->has('meta_description'))
                                        <p class="text-danger">{{ $errors->first('meta_description') }}</p>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label">{{ __('Disqus Status') }}<span
                                    class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" {{ $scripts->is_disqus == '1' ? 'checked':'' }} name="is_disqus" data-size="large"  data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-label-text="<i class='fas fa-mouse'></i>"  data-off-text="Deactive" >
                                        @if ($errors->has('is_disqus'))
                                          <p class="text-danger"> {{ $errors->first('is_disqus') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 control-label">{{ __('Disqus Shortname') }}<span
                                    class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="disqus" class="form-control" value="{{ $scripts->disqus }}" placeholder="{{ __('Disqus Shortname') }}">
                                        @if ($errors->has('disqus'))
                                        <p class="text-danger"> {{ $errors->first('disqus') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
