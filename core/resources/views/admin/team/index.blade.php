@extends('admin.layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Teams') }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Teams') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Service Content') }}</h3>
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
                        <form class="form-horizontal" action="{{ route('admin.update_teamcontent',  $sectiontitle->language_id) }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ __('Team Title') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="team_title" placeholder="{{ __('Team Title') }}" value="{{ $sectiontitle->team_title }}">
                                    @if ($errors->has('team_title'))
                                        <p class="text-danger"> {{ $errors->first('team_title') }} </p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 control-label">{{ __('Team Sub-title') }}<span class="text-danger">*</span></label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="team_subtitle" placeholder="{{ __('Team Sub-Title') }}" value="{{ $sectiontitle->team_subtitle }}">
                                    @if ($errors->has('team_subtitle'))
                                        <p class="text-danger"> {{ $errors->first('team_subtitle') }} </p>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                    <h3 class="card-title mt-1">{{ __('Team List') }}</h3>
                    <div class="card-tools d-flex">
                        <div class="d-inline-block mr-4">
                            <select class="form-control lang" id="languageSelect" data="{{url()->current() . '?language='}}">
                                @foreach($langs as $lang)
                                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}} >{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('admin.add_team'). '?language=' . request()->input('language') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> {{ __('Add') }}
                        </a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table  class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Dagenation') }}</th>
                                <th>{{ __('status') }}</th>
                                <th>{{ __('Action') }}</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $id=>$team)
                            <tr>
                                <td>
                                    {{ ++$id }}
                                </td>
                                <td>
                                    <img class="w-80" src="{{ asset('assets/front/img/'.$team->image) }}" alt="">
                                </td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->dagenation}}</td>
                                <td>
                                    @if($team->status == 1)
                                            <span class="badge badge-success">{{ __('Publish') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                        @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.edit_team', $team->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>{{ __('Edit') }}</a>
                                        <form  id="deleteform" class="d-inline-block" action="{{ route('admin.delete_team', $team->id ) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $team->id }}">
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
