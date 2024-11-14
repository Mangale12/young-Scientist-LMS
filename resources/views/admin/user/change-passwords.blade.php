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
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">होम</a></li>
              <li class="breadcrumb-item active">नयाँ प्रयोगकर्ता</li>
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
              <h3 class="card-title">पासवर्ड परिवर्तन</h3>
              <h3 class="card-title ml-5 float-right">आजको मिति: {{ datenepUnicode(date('Y-m-d'), 'nepali') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($_base_route.'.update-password', $data['rows']->id) }}" method="POST" enctype='multipart/form-data'>
              @csrf
              <div class="card-body row">
                <div class="form-group col-3">
                  <label for="no">पासवर्ड *</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="">
                  @if($errors->has('name'))
                  <p id="name-error" class="help-block text-danger"><span>{{ $errors->first('name') }}</span></p>
                  @endif
                </div>
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
