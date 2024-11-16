
@extends('layouts.admin')
@section('title', $_panel)
@section('css')

    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{asset('assets/richtexteditor/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src='{{asset("assets/richtexteditor/richtexteditor/plugins/all_plugins.js")}}'></script>
    @endsection
@section('content')
<div class="wrapper">
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
              <li class="breadcrumb-item"><a href="#">{{$_panel}}</a></li>
              <li class="breadcrumb-item active">{{$_panel}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="{{ route($_base_route.'.create') }}"><button id="addToTable" class="btn btn-primary"> Add New <i class="fa fa-plus"></i></button></a>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$_panel}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered fiscal-year-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Video</th>
                            <th>Thumbnail</th>
                            <th>Cost</th>
                            <th>Chapter Count</th>
                            <th>Teachers</th>
                            <th>Student Count</th>
                            <th>Total Enrolled</th>
                            <th>Added Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  {{-- course Modal --}}
<!-- Button trigger modal -->

<!--chpater list Modal -->
<div class="modal fade" id="chapter-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Course Chapters</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button id="new-chapter" class="btn btn-primary btn-add-chapter"> Add New <i class="fa fa-plus"></i></button>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Chapter Title</th>
              <th>Chapter Category</th>
              <th>Assignment</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="courseChaptersList">
            <!-- Rows will be populated here dynamically -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- add new chpater --}}
<div class="modal fade chapter-form-modal" id="chapter-form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Course Chapters</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">New Chapter</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form enctype='multipart/form-data' action="{{ route('admin.chapters.store') }}">
            @csrf
            <div class="card-body row">
              <input type="hidden" name="course_id" value="1" class="course-id" id="course_id">
              <div class="form-group col-12">
                <label for="title">Title *</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Chapter Title">
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
              </div>
            
              <div class="form-group col-12">
                  <label for="assignment">Assignement *</label>
                  <textarea name="assignment" id="assignment" class="form-control assignment">{{ old('assignment') }}</textarea>
                  
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection
<!-- ./wrapper -->
@section('scripts')
<!-- DataTables JS -->
<script src="{{ asset('https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.fiscal-year-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route($_base_route.'.data') }}",
            columns: [
                {
                    data: null,
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'title', name: 'title' },
                { data: 'video_link', name: 'video_link' },
                { data: 'thumbnail', name: 'thumbnail' },
                { data: 'cost', name: 'cost' },
                { data: 'cost', name: 'cost' },
                { data: 'cost', name: 'cost' },
                { data: 'description', name: 'description' },
                { data: 'cost', name: 'cost' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Sample data - replace with your actual data
        const courseChapters = [
          { title: 'Introduction to Course', category: 'Basic', assignment: 'Assignment 1' },
          { title: 'Advanced Concepts', category: 'Intermediate', assignment: 'Assignment 2' },
          { title: 'Final Project', category: 'Advanced', assignment: 'Project' }
        ];

        // Function to populate the table
        function populateCourseChapters(courseId) {
          $.ajax({
            url: '{{ route($_base_route.".chapters", ":courseId") }}'.replace(':courseId', courseId), // Dynamic course ID in route
            type: "GET",
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
            },
            success: function(response) {
              const tbody = $('#courseChaptersList');
              tbody.empty(); // Clear existing rows

              // Loop through the chapters received in the response and append rows
              response.forEach(chapter => {
                const row = `
                  <tr>
                    <td>${chapter.title}</td>
                    <td>${chapter.chapter_category.name}</td>
                    <td>${chapter.assignment}</td>
                    <td>
                      <button class="btn btn-sm btn-primary btn-chapter-edit" 
                        data-id="${chapter.id}" 
                        data-description="${chapter.description || ''}" 
                        data-title="${chapter.title}" 
                        data-assignment="${chapter.assignment || ''}"
                        data-category="${chapter.chapter_category.id}">Edit</button>
                      <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                  </tr>
                `;
                tbody.append(row);
              });
            },
            error: function(xhr, status, error) {
              console.error("Failed to load chapters:", error);
              alert("Error loading chapters. Please try again.");
            }
          });
        }

        $(document).on('click', '.btn-chapter-list', function(e) {
            e.preventDefault();
            var id = $(this).data('id')
            $('.course-id').val(id);
            populateCourseChapters(id);
            $('#chapter-list-modal').modal('show')
        });
        // Initialize the rich text editor
        var editor1 = new RichTextEditor("#description");
        var editor2 = new RichTextEditor("#assignment");
        $('.btn-add-chapter').on('click', function(){
          $('#chapter-form-modal').modal('show');
        })
        // chapter form submit
        $(document).on('submit', '#chapter-form-modal form', function(e) {
          e.preventDefault(); // Prevent default form submission

          let form = $(this);
          let url = form.attr('action') || '/chapters'; // Update with the actual endpoint
          let data = new FormData(this); // For handling file uploads
          let submitButton = form.find('button[type="submit"]');
          submitButton.prop('disabled', true).text('Submitting...');
          
          $.ajax({
              headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
              },
              url: url,
              method: 'POST',
              data: data,
              processData: false,
              contentType: false,
              success: function(response) {
                  alert('Chapter created successfully!');
                  form[0].reset();
                  $('#chapter-form-modal').modal('hide');
                  populateCourseChapters(form.find('#course_id').val());
                   // Refresh the page or update the DOM as needed
              },
              error: function(xhr) {
                  // Print server errors
                  console.error(xhr.responseText);
                  let errors = xhr.responseJSON?.errors;

                  if (errors) {
                      form.find('.help-block.text-danger').remove(); // Clear previous errors
                      for (const [field, messages] of Object.entries(errors)) {
                          let errorMessage = `<p class="help-block text-danger"><span>${messages.join('<br>')}</span></p>`;
                          $(`#${field}`).after(errorMessage); // Append error message near the field
                      }
                  } else {
                      alert('Something went wrong. Please try again.');
                  }
              },
              complete: function() {
                  submitButton.prop('disabled', false).text('Submit');
              }
          });
        });

      $(document).on('click', '.btn-chapter-edit', function (e) {
        e.preventDefault();

        // Extract data attributes from the clicked button
        const id = $(this).data('id');
        const title = $(this).data('title') || ''; // Fallback to empty if not set
        const description = $(this).data('description') || ''; // Handle null or undefined
        const assignment = $(this).data('assignment') || ''; // Handle null or undefined
        const category = $(this).data('category'); // Get the category text
        console.log(description);
        console.log(assignment);
        console.log(category);
        
        // Populate the form fields in the modal
        const modal = $('#chapter-form-modal');
        modal.modal('show');
        modal.find('form').attr('action', "{{ route('admin.chapters.update', ':id') }}".replace(':id', id));
        modal.find('#title').val(title); // For input field
        modal.find('#description').val(description); // For textarea
        modal.find('#chapter_category_id').val(category);
        editor1.setHTMLCode(description); // Set description content
        editor2.setHTMLCode(assignment);
    });

    });
</script>

@endsection

