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
              <h3 class="card-title">Edit {{$_panel}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($_base_route.'.update', ['id'=>$data['row']->id]) }}" method="POST" enctype='multipart/form-data'>
              @csrf
              @method('put')
              <div class="card-body row">
                <div class="form-group col-12">
                  <label for="title">Course Title *</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $data['row']->title) }}" placeholder="Course Title">
                  @if($errors->has('title'))
                  <p id="title-error" class="help-block text-danger"><span>{{ $errors->first('title') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-12">
                  <label for="video">Intro Video *</label>
                  <input type="url" class="form-control" id="video" name="video_link" value="{{ old('video_ling', $data['row']->video_link) }}" placeholder="Youtube Video Link" >
                  @if($errors->has('video_link'))
                  <p id="video-error" class="help-block text-danger"><span>{{ $errors->first('video_link') }}</span></p>
                  @endif
                </div>
                <div class="form-group col-12">
                  <label for="school-id">Schools *</label>
                  <select name="school_ids[]" id="school-id" class="form-control select-two select-school" multiple>
                      <option selected disabled>Select Schools</option>
                      @foreach($data['schools'] as $school)
                          <option value="{{ $school->id }}" 
                              {{ in_array($school->id, old('school_ids', $data['row']->schools->pluck('id')->toArray())) ? 'selected' : '' }}>
                              {{ $school->name }}
                          </option>
                      @endforeach
                  </select>
                  @if($errors->has('school_ids'))
                      <p id="school_ids-error" class="help-block text-danger">
                          <span>{{ $errors->first('school_ids') }}</span>
                      </p>
                  @endif
              </div>
              
              <div class="form-group col-12">
                  <label for="teacher_ids">Teacher *</label>
                  <select name="teacher_ids[]" id="teacher_ids" class="form-control select-two select-teacher" multiple>
                      <option selected disabled>Select Teacher</option>
                      @foreach($data['teachers'] as $teacher)
                          <option value="{{ $teacher->id }}" 
                              {{ in_array($teacher->id, old('teacher_ids', $data['row']->teachers->pluck('id')->toArray())) ? 'selected' : '' }}>
                              {{ $teacher->user->name }}
                          </option>
                      @endforeach
                  </select>
                  @if($errors->has('teacher_ids'))
                      <p id="teacher_ids-error" class="help-block text-danger">
                          <span>{{ $errors->first('teacher_ids') }}</span>
                      </p>
                  @endif
              </div>
              
              <div class="form-group col-12">
                  <label for="grade_ids">Grade *</label>
                  <select name="grade_ids[]" id="grade_ids" class="form-control select-two select-grade" multiple>
                      <option selected disabled>Select Grade</option>
                      @foreach($data['grades'] as $grade)
                          <option value="{{ $grade->id }}" 
                              {{ in_array($grade->id, old('grade_ids', $data['row']->grades->pluck('id')->toArray())) ? 'selected' : '' }}>
                              {{ $grade->name }}
                          </option>
                      @endforeach
                  </select>
                  @if($errors->has('grade_ids'))
                      <p id="grade_ids-error" class="help-block text-danger">
                          <span>{{ $errors->first('grade_ids') }}</span>
                      </p>
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
                  <label for="course_material">Materials *</label>
                  <textarea name="course_material" id="course_material" class="form-control course_material">{{ old('course_material', $data['row']->course_material) }}</textarea>
                  @if($errors->has('course_material'))
                  <p id="course_material-error" class="help-block text-danger">
                      <span>{{ $errors->first('course_material') }}</span>
                  </p>
                  @endif
              </div>
              <div class="form-group col-12">
                <label for="course_resource_id">Course Resource *</label>
                <select name="course_resource_id[]" id="course_resource_id" class="form-control select-two" multiple>
                    @foreach($data['course_resources'] as $course_resource)
                        <option value="{{ $course_resource->id }}"
                            {{ (is_array(old('course_resource_id', $data['selected-courseresources'])) && in_array($course_resource->id, old('course_resource_id', $data['selected-courseresources']))) ? 'selected' : '' }}>
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
            
              
              @include('admin.section.status-edit')
              
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
              <script src="{{asset('assets/cms/assets/select2/js/select2.min.js')}}"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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
              
