@extends('layouts.admin')
@section('title', $_panel)
@section('css')
<link href="{{ asset('assets/cms/plugin/nepali.datepicker.v3.7/css/nepali.datepicker.v3.7.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$_panel}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$_panel}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{$_panel}}</h3>
              <h3 class="card-title ml-5 float-right">Date: {{ date('Y-m-d') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($_base_route.'.store') }}" method="POST" enctype='multipart/form-data'>
              @csrf
              <input type="hidden" name="is_darta" id="is-darta" value="1">
              <div class="card-body row">
                <div class="form-group col-3">
                  <label for="no">Site Name</label>
                  <input type="text" class="form-control" id="no" name="site_name" value="{{ old('site_name', $data->site_name) }}" placeholder="Site Name">
                  @if($errors->has('site_name'))
                  <p id="no-error" class="help-block text-danger"><span>{{ $errors->first('site_name') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="email">Site Email</label>
                  <input type="text" class="form-control" id="email" name="site_email" value="{{ old('site_email', $data->site_email) }}" placeholder="site email">
                  @if($errors->has('site_email'))
                  <p id="email-error" class="help-block text-danger"><span>{{ $errors->first('site_email') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="contact-name">Contactor Name *</label>
                  <input type="text" class="form-control" id="contact_name" name="site_contact" value="{{ old('site_contact', $data->site_contact) }}" placeholder="सम्पर्क नाम">
                  @if($errors->has('site_contact'))
                  @dd($errors)
                  <p id="contact-name-error" class="help-block text-danger"><span>{{ $errors->first('site_contact') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="phone">Number *</label>
                  <input type="text" class="form-control" id="phone" name="site_phone" value="{{ old('site_phone', $data->site_phone) }}" placeholder="नम्बर">
                  @if($errors->has('phone'))
                  <p id="phone-error" class="help-block text-danger"><span>{{ $errors->first('site_phone') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="mobile">Mobile No. *</label>
                  <input type="text" class="form-control" id="mobile" name="site_mobile" value="{{ old('site_mobile', $data->site_mobile) }}" placeholder="नम्बर">
                  @if($errors->has('mobile'))
                  <p id="mobile-error" class="help-block text-danger"><span>{{ $errors->first('site_mobile') }}</span></p>
                  @endif
                </div>



                <div class="form-group col-3">
                  <label for="name">Address *</label>
                  <input type="text" class="form-control" id="site_first_address" name="site_first_address" value="{{ old('site_first_address',$data->site_first_address) }}" placeholder="site first address">
                  @if($errors->has('address'))
                  <p id="name-error" class="help-block text-danger"><span>{{ $errors->first('site_first_address') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                    <label for="second-address">Second Address *</label>
                    <input type="text" class="form-control" id="second-address" name="site_second_address" value="{{ old('site_second_address', $data->site_second_address) }}" placeholder="site second address">
                    @if($errors->has('second_address'))
                    <p id="second-address-error" class="help-block text-danger"><span>{{ $errors->first('site_second_address') }}</span></p>
                    @endif
                </div>

                <div class="form-group col-6">
                    <label for="logo">Logo *</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                    </div>
                    @if($data->logo)
                    <img src="{{ asset($data->logo) }}" width="100" alt="">
                    @endif
                    @if($errors->has('logo'))
                    <p id="logo-error" class="help-block text-danger"><span>{{ $errors->first('logo') }}</span></p>
                    @endif
                  </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div>
  </section>
    <!-- /.content -->
  </div>
</div>
@endsection

@section('scripts')

@endsection
