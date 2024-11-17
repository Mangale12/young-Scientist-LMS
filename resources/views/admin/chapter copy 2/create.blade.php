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
              <li class="breadcrumb-item active">New {{$_panel}}</li>
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
              <h3 class="card-title">New {{$_panel}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($_base_route.'.store') }}" method="POST" enctype='multipart/form-data'>
              @csrf
              <div class="card-body row">
                <input type="hidden" name="course_id" value="1">
                <div class="form-group col-12">
                  <label for="title">Title *</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Course Title">
                  @if($errors->has('title'))
                  <p id="title-error" class="help-block text-danger"><span>{{ $errors->first('title') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-12">
                  <label for="chapter_category_id">Chapter Category *</label>
                  <select class="form-control" name="chapter_category_id" id="chapter_category_id">
                    <option selected disabled>Select Chapter Category</option>
                    @foreach($data['chapterCategories'] as $chapterCategory)
                    <option value="{{$chapterCategory->id }}" {{ old('chapter_category_id') == $chapterCategory->id?'selected' : '' }}>{{ $chapterCategory->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('chapter_category_id'))
                  <p id="chapter_category_id-error" class="help-block text-danger"><span>{{ $errors->first('chapter_category_id') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-12">
                  <label for="description">Description *</label>
                  <textarea name="description" id="description" class="form-control description">{{ old('description') }}</textarea>
                  @if($errors->has('description'))
                  <p id="description-error" class="help-block text-danger">
                      <span>{{ $errors->first('description') }}</span>
                  </p>
                  @endif
                </div>
              
                <div class="form-group col-12">
                    <label for="assignment">Assignement *</label>
                    <textarea name="assignment" id="assignment" class="form-control assignment">{{ old('assignment') }}</textarea>
                    @if($errors->has('assignment'))
                    <p id="assignment-error" class="help-block text-danger">
                        <span>{{ $errors->first('assignment') }}</span>
                    </p>
                    @endif
                </div>
              
                {{-- @include('admin.section.status-create') --}}
              
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
  
