@extends('layouts.admin')
@section('title', $_panel)
@section('css')
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
              <li class="breadcrumb-item active">Edit {{$_panel}}</li>
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
                <h3 class="card-title">Edit {{$_panel}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="{{ route($_base_route.'.update', ['id'=>$data['row']->id]) }}" method="POST" enctype='multipart/form-data'>
                @csrf
                @method('put')
                <div class="card-body row">
                  <div class="form-group col-12">
                    <label for="name">{{$_panel}} *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $data['row']->name) }}" placeholder="">
                    @if($errors->has('name'))
                    <p id="name-error" class="help-block text-danger" for="agricultural_id"><span>{{ $errors->first('name') }}</span></p>
                    @endif
                  </div>
                  @include('admin.section.status-edit')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection
