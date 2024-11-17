@extends('layouts.admin')
@section('title', $_panel)
@section('css')
<link rel="stylesheet" href="{{asset('assets/richtexteditor/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src='{{asset("assets/richtexteditor/richtexteditor/plugins/all_plugins.js")}}'></script>
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
            <form action="{{ route($_base_route.'.update', ['id'=>$data['row']]) }}" method="POST" enctype='multipart/form-data'>
              @csrf
              @method('put')
              <div class="card-body row">
                <input type="hidden" name="course_id" value="1">
                <div class="form-group col-12">
                  <label for="title">Title *</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $data['row']->title) }}" placeholder="Course Title">
                  @if($errors->has('title'))
                  <p id="title-error" class="help-block text-danger"><span>{{ $errors->first('title') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-12">
                  <label for="description">Description *</label>
                  <textarea name="description" id="description" class="form-control description">{{ old('description', $data['row']->description) }}</textarea>
                  @if($errors->has('description'))
                  <p id="description-error" class="help-block text-danger">
                      <span>{{ $errors->first('description') }}</span>
                  </p>
                  @endif
                </div>

                <div class="form-group col-12">
                    <label for="file">File *</label>
                    <small>(Hold down the Ctrl key and click to select multiple files.)</small>
                    <input type="file" name="file[]" id="file" class="form-control" multiple>
                    @if($errors->has('file'))
                    <p id="file-error" class="help-block text-danger">
                        <span>{{ $errors->first('file') }}</span>
                    </p>
                    @endif
                </div>
            
                @include('admin.section.status-edit')
              
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
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
  <script>
  // Initialize the rich text editor
  var editor1 = new RichTextEditor("#description");
  var editor2 = new RichTextEditor("#assignment");
  
</script>
  
  @endsection
  
