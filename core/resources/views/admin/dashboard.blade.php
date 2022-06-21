 @extends('admin.layout')

 @section('content')
 <!-- Content Header (Page header) -->

 <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Welcome back,') }} {{ $adminprofile->name }} !</h1>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="fas fa-box-open"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Package') }}</span>
                  <h4 class="info-box-number font-weight-normal">{{ $packages->count() }}</h4>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="fas fa-briefcase"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Service') }}</span>
                  <h4 class="info-box-number font-weight-normal">{{ $service->count() }}</h4>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-primary">
                <span class="info-box-icon"><i class="fab fa-blogger-b"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Blogs') }}</span>
                  <h4 class="info-box-number font-weight-normal">{{ $blogs->count() }}</h4>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-danger">
                <span class="info-box-icon"><i class="fas fa-star"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Review') }}</span>
                  <h4 class="info-box-number font-weight-normal">{{ $testimonial->count() }}</h4>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">{{ __('Total Team Member') }}</span>
                  <h4 class="info-box-number font-weight-normal">{{ $team->count() }}</h4>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary  card-outline">
            <div class="card-header">
              <h3 class="card-title">{{ __('Latest 10 Package :') }}</h3>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Discount Price') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($latestpackages as $id=>$package)
                    <tr>
                        <td>
                            {{ $id }}
                        </td>
                        <td>
                            {{ $package->name }}
                        </td>
                        <td>
                            {{  Helper::showCurrency() }}{{ $package->price }}
                        </td>
                        <td>
                            @if($package->discount_price)
                            {{  Helper::showCurrency() }}{{ $package->discount_price }}
                            @else
                            <span class="badge badge-info">{{ __('No Discount') }}</span>
                            @endif
                        </td>
                        <td>
                            @if($package->status == 1)
                                <span class="badge badge-success">{{ __('Publish') }}</span>
                            @else
                                <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                            @endif

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
          </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-primary  card-outline">
            <div class="card-header">
              <h3 class="card-title">{{ __('Latest 10 Blog Post :') }}</h3>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="idtable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($latestblogs as $id=>$blog)
                    <tr>
                        <td>{{ ++$id }}</td>
                        <td>
                            <img class="w-80" src="{{ asset('assets/front/img/'.$blog->main_image) }}" alt="">
                        </td>
                        <td>
                            {{ $blog->title }}
                        </td>
                        <td>
                            {{ $blog->bcategory->name }}
                        </td>
                        <td>
                                @if($blog->status == 1)
                                    <span class="badge badge-success">{{ __('Publish') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Unpublish') }}</span>
                                @endif

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
    <!-- Main row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
@endsection
