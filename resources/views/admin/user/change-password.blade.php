@extends('layouts.admin')
@section('title', 'प्रयोगकर्ता')
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
            <h1>प्रयोगकर्ता</h1>
          </div>
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">होम</a></li>
              <li class="breadcrumb-item active">नयाँ प्रयोगकर्ता</li>
            </ol>
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
              <h3 class="card-title">पासवर्ड परिवर्तन</h3>
              <h3 class="card-title ml-5 float-right">आजको मिति: {{ datenepUnicode(date('Y-m-d'), 'nepali') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($_base_route.'.update-password', $data['rows']->id) }}" method="POST" enctype='multipart/form-data'>
              @csrf
              @method('PUT')
              <div class="card-body row">
                <div class="form-group col-7">
                  <label for="no">पुरानो पासवर्ड *</label>
                  <input type="password" class="form-control" id="old_password" name="old_password" value="{{ old('old_password') }}" placeholder="">
                  @if($errors->has('old_password'))
                  <p id="old_password-error" class="help-block text-danger"><span>{{ $errors->first('old_password') }}</span></p>
                  @endif
                </div>
                <div class="form-group col-7">
                    <label for="no">पुरानो पासवर्ड *</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="">
                    @if($errors->has('password'))
                    <p id="name-error" class="help-block text-danger"><span>{{ $errors->first('password') }}</span></p>
                    @endif
                </div>
                <div class="form-group col-7">
                    <label for="no">पासवर्ड सुनिश्चित गर्नुहोस *</label>
                    <input type="password" class="form-control" id="confirm" name="password_confirmation" value="{{ old('confirm') }}" placeholder="">

                    @if($errors->has('confirm'))
                    <p id="name-error" class="help-block text-danger"><span>{{ $errors->first('confirm') }}</span></p>
                    @endif
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          <!-- /.card -->
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
