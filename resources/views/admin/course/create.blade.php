@extends('layouts.admin')
@section('title', $_panel)
@section('css')
<link rel="stylesheet" href="{{asset('assets/cms/assets/select2/css/select2.min.css')}}">
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
                <div class="form-group col-12">
                  <label for="title">Course Title *</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Course Title">
                  @if($errors->has('title'))
                  <p id="title-error" class="help-block text-danger"><span>{{ $errors->first('title') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-12">
                  <label for="video">Intro Video *</label>
                  <input type="url" class="form-control" id="video" name="video_link" value="{{ old('video') }}" placeholder="Youtube Video Link" >
                  @if($errors->has('video'))
                  <p id="video-error" class="help-block text-danger"><span>{{ $errors->first('video') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-12">
                  <label for="video">Schooles *</label>
                  <select name="school_ids[]" id="school-id">
                    <option selected disabled>Select Schools</option>
                    @foreach($data['schools'] as $school)
                    <option value="{{$school->id }}" {{ old('school_ids', $data['row']->school_ids) == $school->id?'selected' : '' }}>{{ $school->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('school_ids'))
                  <p id="school_ids-error" class="help-block text-danger"><span>{{ $errors->first('school_ids') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-12">
                  <label for="teacher_ids">Teacher *</label>
                  <select name="teacher_ids[]" id="teacher_ids">
                    <option selected disabled>Select Schools</option>
                    @foreach($data['teachers'] as $teacher)
                    <option value="{{$school->id }}" {{ old('teacher_ids', $data['row']->teacher) == $teacher->id?'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('teacher_ids'))
                  <p id="teacher_ids-error" class="help-block text-danger"><span>{{ $errors->first('teacher_ids') }}</span></p>
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
                  <label for="course_material">Materials *</label>
                  <textarea name="course_material" id="course_material" class="form-control course_material">{{ old('course_material') }}</textarea>
                  @if($errors->has('course_material'))
                  <p id="course_material-error" class="help-block text-danger">
                      <span>{{ $errors->first('course_material') }}</span>
                  </p>
                  @endif
              </div>

              <div class="form-group col-12">
                <label for="course_resource_id">Course Resource *</label>
                <select name="course_resource_id[]" id="course_resource_id" class="form-control select-two" multiple>
                  <option selected disabled>Select Course Resource</option>
                    @foreach($data['course_resources'] as $course_resource)
                        <option value="{{ $course_resource->id }}"
                            {{ (is_array(old('course_resource_id')) && in_array($course_resource->id, old('course_resource_id'))) ? 'selected' : '' }}>
                            {{ $course_resource->title }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('course_resource_id'))
                <p id="course_resource_id-error" class="help-block text-danger">
                    <span>{{ $errors->first('course_resource_id') }}</span>
                </p>
                @endif                
            </div>
            
              {{-- <div class="form-group col-12">
                <label for="course_resource_id">Course Resource *</label>
                <select name="course_resource_id[]" id="course_resource_id" class="form-control select-two" multiple>
                  <option selected disabled>Select Course Resource</option>
                  @foreach($data['course_resources'] as $course_resource)
                      <option value="{{$course_resource->id }}">{{ $course_resource->title }}</option>
                  @endforeach
                </select>
                @if($errors->has('course_resource_id'))
                <p id="course_resource_id-error" class="help-block text-danger">
                    <span>{{ $errors->first('course_resource_id') }}</span>
                </p>
                @endif                
              </div> --}}

              
              @include('admin.section.status-create')
              
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
              <script src="{{asset('assets/cms/assets/select2/js/select2.min.js')}}"></script>
             <script>
              // Initialize the rich text editor
              var editor1 = new RichTextEditor("#description");
              var editor2 = new RichTextEditor("#course_material");
              $(document).ready(function () {
                  $('.select-two').select2({
                      allowClear: true // Allows clearing the selection
                  });
              });
          </script>
             
              @endsection
              
