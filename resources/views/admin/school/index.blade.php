
@extends('layouts.admin')
@section('title', $_panel)
@section('css')

    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dist/toastr-master/toastr.css') }}">
  <script src="{{ asset('dist/toastr-master/toastr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
            <h1>{{$_panel}} </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$_panel}} List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="{{ route($_base_route.'.create') }}"><button id="addToTable" class="btn btn-primary"> Create New <i class="fa fa-plus"></i></button></a>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$_panel}} List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered ward-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{$_panel}}</th>
                            <th>Total Course</th>
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
  
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!--Course list Modal -->
<div class="modal fade" id="course-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Course Lisst</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <div class="form-row align-items-center">
          <div class="col-md-5">
            <select name="course" id="courseSelect" class="form-control">
              <option value="">Select a Course</option>
              @foreach($data['courses'] as $course)
              <option value="{{$course->id}}">{{$course->title}} </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <select name="course" id="courseGradeSelect" class="form-control courses">
              <option value="">Select Grade</option>
              
            </select>
          </div>
          <div class="col-md-3">
            <select name="course" id="courseSelect" class="form-control">
              <option value="">Select section</option>
              @foreach($data['courses'] as $course)
              <option value="{{$course->id}}">{{$course->title}} </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-block">Add</button>
          </div>
          <hr>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Course Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="courseList">
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

{{-- grade List model --}}
<!--chpater list Modal -->
<div class="modal fade" id="grade-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Grade List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <div class="form-row align-items-center">
          <div class="col-md-5">
            <select name="course" id="gradeSelect" class="form-control">
              <option selected disabled>Select Grade</option>
              @foreach($data['grades'] as $grade)
              <option value="{{$grade->id}}">{{$grade->name}} </option>
              @endforeach
            </select>
          </div>
          
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-block btn-add-grade">Add</button>
          </div>
          <hr>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Grade</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="gradeList">
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

{{-- //section list modal --}}
<div class="modal fade" id="section-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Section List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <div class="form-row align-items-center">
          <div class="col-md-5">
            <select name="section_id" id="selectSection" class="form-control">
              
            </select>
          </div>
          
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-block btn-add-section">Add</button>
          </div>
          <hr>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Section</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="sectionList">
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

{{-- //Student list modal --}}
<div class="modal fade" id="grade-section-student-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Student List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <div class="form-row align-items-center">
          <div class="col-md-5">
            <select name="student_id" id="selectSectionStudent" class="form-control">
              
            </select>
          </div>
          
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-block btn-add-grade-section-student">Add</button>
          </div>
          <hr>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Student Id</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="grade-section-student-list">
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

{{-- course list modal --}}
<div class="modal fade" id="grade-section-course-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Course List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <div class="form-row align-items-center">
          <div class="col-md-5">
            <select name="student_id" id="selectSectionCourse" class="form-control">
              
            </select>
          </div>
          
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-block btn-add-grade-section-course">Add</button>
          </div>
          <hr>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="grade-section-course-list">
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

{{-- graded-section-course-teacher list modal --}}
<div class="modal fade" id="grade-section-course-teacher-list-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 78vw; left: -35%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Course List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        <div class="form-row align-items-center">
          <div class="col-md-5">
            <select name="teacher" id="selectSectionTeacher" class="form-control">
              
            </select>
          </div>
          
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary btn-block btn-add-grade-section-teacher">Add</button>
          </div>
          <hr>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Code</th>
              <th>Subject Expert</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="grade-section-teacher-list">
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
        $('.ward-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route($_base_route.'.data') }}",
            columns: [
                {
                    data: null,
                    name: 'id',
                    render: function (data, type, row, meta) {
                      // Generate a dropdown for each row
                      return `
                          <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                  ${meta.row + 1}
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}">
                                  <li><a class="dropdown-item btn-course-list" data-id="${row.id}">Course List</a></li>
                                  <li><a class="dropdown-item" data-id="${row.id}">Teachers</a></li>
                                  <li><a class="dropdown-item btn-grade-list" data-id="${row.id}">Grades</a></li>
                              </ul>
                          </div>
                      `;
                  }
                },
                { data: 'name', name: 'name', },
                { data: 'course_count', name: 'course_count' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });


        function populateCourseChapters(id) {
          $.ajax({
            url: '{{ route($_base_route.".courses", ":id") }}'.replace(':id', id), // Dynamic course ID in route
            type: "GET",
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
            },
            success: function(response) {
              const tbody = $('#courseList');
              tbody.empty(); // Clear existing rows
              $('#courseGradeSelect').empty().append('<option value="">Select Grade</option>');
              // Loop through the chapters received in the response and append rows
              response.courses.forEach(course => {
                const row = `
                  <tr>
                    <td>${course.title}</td>
                    <td><i class="fas fa-trash remove-course" data-course="${course.id}" data-school="${id}"></i></td>
                  </tr>
                `;
                tbody.append(row);
              });

              response.grades.forEach(grade => {
                console.log(grade);
                  const gradeOption = `<option value="${grade.id}">${grade.name}</option>`;
                  $('#courseGradeSelect').append(gradeOption);
              });
            },
            error: function(xhr, status, error) {
              console.error("Failed to load chapters:", error);
              alert("Error loading chapters. Please try again.");
            }
          });
        }

        $(document).on('click', '.btn-course-list', function(e) {
            e.preventDefault();
            var id = $(this).data('id')
            populateCourseChapters(id);
            $('#course-list-modal').modal('show')
        });

        $(document).on('click', '.remove-course', function(e) {
          e.preventDefault();
          
          var courseId = $(this).data('course');
          var schoolId = $(this).data('school');
          
          $.confirm({
            title: 'Confirm Removal',
            content: 'This course will no longer be accessible for this school. Are you sure you want to proceed?',
            type: 'red',
            buttons: {
              confirm: {
                text: 'Yes, Remove',
                btnClass: 'btn-red',
                action: function () {
                  // AJAX request to remove course
                  $.ajax({
                    url: '{{route($_base_route.".remove-course")}}', // Update with your route or endpoint
                    method: 'POST',
                    data: {
                      course_id: courseId,
                      school_id: schoolId,
                      _token: $('meta[name="csrf-token"]').attr('content') // For Laravel CSRF protection
                    },
                    success: function(response) {
                      populateCourseChapters(schoolId)
                      $.alert({
                          title: 'Removed!',
                          content: 'The course has been successfully removed.',
                          type: 'green'
                        });
                    },
                    error: function() {
                      $.alert({
                        title: 'Error!',
                        content: 'Failed to remove the course. Please try again later.',
                        type: 'red'
                      });
                    }
                  });
                }
              },
              cancel: {
                text: 'Cancel',
                action: function () {
                  // No action on cancel
                }
              }
            }
          });
        });

        // function to add remove grades
        function populateGrades(id){
          $.ajax({
            url: '{{ route($_base_route.".grades", ":id") }}'.replace(':id', id), // Dynamic course ID in route
            type: "GET",
            headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
            },
            success: function(response) {
              const tbody = $('#gradeList');
              tbody.empty(); // Clear existing rows

              // Loop through the chapters received in the response and append rows
              response.forEach(grade => {
                const row = `
                  <tr>
                    <td>${grade.name}</td>
                    <td>
                      <a class="btn btn-danger remove-grade mx-1" data-grade="${grade.id}" data-school="${id}"><i class="fas fa-trash "></i>
                      <a class="btn btn-primary btn-section-list" data-grade="${grade.id}" data-school="${id}"><i class="fas fa-list"></i></a>
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
        function populateSections(school_id, grade_id) {
          // Construct the route dynamically
          const url = '{{ route($_base_route.".grade.sections", [":school_id", ":grade_id"]) }}'
              .replace(':school_id', school_id)
              .replace(':grade_id', grade_id);

          $.ajax({
              url: url, // Dynamic course ID in route
              type: "GET",
              headers: {
                  'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
              },
              success: function (response) {
                  const tbody = $('#sectionList');
                  tbody.empty(); // Clear existing rows
                  $('#selectSection').empty().append('<option value="">Select Section</option>');
                  // Loop through the sections received in the response and append rows
                  response.sections.forEach(section => {
                      const row = `
                        <tr>
                          <td>${section.section.name}</td>
                          <td>
                            <a class="btn btn-danger btn-remove-grade-section mx-1" data-section="${section.section.id}" data-school="${school_id}" data-grade="${section.grade_id}">
                              <i class="fas fa-trash"></i>
                            </a>
                            <a class="btn btn-danger btn-grade-section-student-list mx-1" data-section="${section.section.id}" data-school="${school_id}" data-grade="${section.grade_id}">
                              <i class="fas fa-list"></i>
                            </a>
                            <a class="btn btn-danger btn-grade-section-course-list mx-1" data-section="${section.section.id}" data-school="${school_id}" data-grade="${section.grade_id}">
                              <i class="fas fa-book"></i>
                            </a>
                            
                          </td>
                        </tr>
                      `;
                      tbody.append(row);
                  });

                  response.allSection.forEach(section => {
                    const sectionOption = `<option value="${section.id}">${section.name}</option>`;
                    $('#selectSection').append(sectionOption);
                  })
              },
              error: function (xhr, status, error) {
                  console.error("Failed to load sections:", error);
                  alert("Error loading sections. Please try again.");
              }
          });
      }
      function populateGradeStudent(school_id, grade_id, section_id){
        // Construct the route dynamically
        const url = '{{ route($_base_route.".grade.section.student-list", [":school_id", ":grade_id", ":section_id"]) }}'
           .replace(':school_id', school_id)
           .replace(':grade_id', grade_id)
           .replace(':section_id', section_id);
           $.ajax({ 
             url: url, // Dynamic course ID in route
             type: "GET",
             headers: {
                 'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
             },
             success: function (response) {
                 const tbody = $('#grade-section-student-list');
                 tbody.empty(); // Clear existing rows
                 // Loop through the students received in the response and append rows
                 $('#selectSectionStudent').empty().append('<option value="">Select Student</option>');
                 response.students.forEach(student => {
                     const row = `
                       <tr>
                         <td>${student.student.user.name}</td>
                         <td>${student.student.user.email}</td>
                         <td>${student.student.student_id}</td>
                         <td>
                           <a class="btn btn-danger btn-remove-grade-student mx-1" data-student="${student.student.id}" data-school="${student.school_id}" data-grade="${student.grade_id}" data-section="${student.section_id}">
                             <i class="fas fa-trash"></i>
                           </a>
                         </td>
                       </tr>
                     `;
                     tbody.append(row);
                 });
                 response.allStudent.forEach(student => {
                    const sectionOption = `<option value="${student.id}">${student.user.name}</option>`;
                    $('#selectSectionStudent').append(sectionOption);
                  })
              },
              error: function(xhr, status, error) {
              console.error("Failed to load Students:", error);
              alert("Error loading Students. Please try again.");
            }
          });
      }
    // populate school grade section course list
      function populateGradeSectionCourse(school_id, grade_id, section_id){
        // Construct the route dynamically
        const url = '{{ route($_base_route.".grade.section.course-list", [":school_id", ":grade_id", ":section_id"]) }}'
           .replace(':school_id', school_id)
           .replace(':grade_id', grade_id)
           .replace(':section_id', section_id);
           $.ajax({ 
             url: url, // Dynamic course ID in route
             type: "GET",
             headers: {
                 'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
             },
             success: function (response) {
                 const tbody = $('#grade-section-course-list');
                 tbody.empty(); // Clear existing rows
                 // Loop through the students received in the response and append rows
                 $('#selectSectionCourse').empty().append('<option value="">Select Course</option>');
                 response.courses.school_section_grade_courses.forEach(course => {
                  console.log(course);
                  
                     const row = `
                       <tr>
                         <td>${course.course.title}</td>
                         <td>teacher</td>
                         <td>
                           <a class="btn btn-danger btn-remove-grade-section-course mx-1" >
                             <i class="fas fa-trash"></i>
                           </a>
                           <a class="btn btn-danger btn-grade-section-teacher-list mx-1" >
                              <i class="fas fa-chalkboard-teacher"></i>
                            </a>
                         </td>
                       </tr>
                     `;
                     tbody.append(row);
                 });
                 response.allCourses.forEach(course => {
                    const sectionOption = `<option value="${course.id}">${course.title}</option>`;
                    $('#selectSectionCourse').append(sectionOption);
                  })
              },
              error: function(xhr, status, error) {
              console.error("Failed to load Course:", error);
              alert("Error loading Course. Please try again. " + message);
            }
          });
      }

      // populate school grade section teacher list
      function populateGradeSectionTeacher(school_id, grade_id, section_id){
        // Construct the route dynamically
        const url = '{{ route($_base_route.".grade.section.teacher-list", [":school_id", ":grade_id", ":section_id"]) }}'
           .replace(':school_id', school_id)
           .replace(':grade_id', grade_id)
           .replace(':section_id', section_id);
           $.ajax({ 
             url: url, // Dynamic course ID in route
             type: "GET",
             headers: {
                 'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
             },
             success: function (response) {
                 const tbody = $('#grade-section-teacher-list');
                 tbody.empty(); // Clear existing rows
                 // Loop through the students received in the response and append rows
                 $('#selectSectionTeacher').empty().append('<option value="">Select Teacher</option>');
                 response.courses.school_section_grade_courses.forEach(course => {
                     const row = `
                       <tr>
                         <td>${course.course.title}</td>
                         <td>
                           <a class="btn btn-danger btn-remove-grade-section-course mx-1" data-course="${course.course.id}" data-school="${course.school_id}" data-grade="${course.grade_id}" data-section="${course.section_id}">
                             <i class="fas fa-trash"></i>
                           </a>
                         </td>
                       </tr>
                     `;
                     tbody.append(row);
                 });
                 response.allTeachers.forEach(course => {
                    const sectionOption = `<option value="${course.id}">${course.title}</option>`;
                    $('#selectSectionCourse').append(sectionOption);
                  })
              },
              error: function(xhr, status, error) {
              console.error("Failed to load Teacher:", error);
              alert("Error loading Teacher. Please try again. " + message);
            }
          });
      }

        $(document).on('click', '.btn-grade-list', function(e){
          e.preventDefault
          var id = $(this).data('id')
          var grade_section_id = null;
          populateGrades(id);
          $('#grade-list-modal').modal('show')

          $(document).off('click', '.btn-add-grade').on('click', '.btn-add-grade', function (e) {
              e.preventDefault(); // Prevent default behavior
              var grade = $('#gradeSelect').val(); // Get selected grade value
              if (!grade) {
                  alert("Please select a grade.");
                  return;
              }

              // AJAX request to add grade
              $.ajax({
                  url: '{{route($_base_route.".add-grade")}}', // Dynamic course ID in route
                  type: "POST",
                  data: {
                      school_id: id,
                      grade_id: grade
                  },
                  headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
                  },
                  success: function (response) {
                    populateGrades(id); // Re-populate grades
                    alert(response.message);
                  },
                  error: function (xhr, status, error) {
                      console.error("Error:", error);
                      alert("Error adding grade. Please try again.");
                  }
              });
          });
          $(document).off('click', '.remove-grade').on('click', '.remove-grade', function (e) {
              e.preventDefault(); // Prevent default behavior

              var gradeId = $(this).data('grade'); // Get the grade ID
              var schoolId = $(this).data('school'); // Get the school ID

              // Confirm removal
              $.confirm({
                  title: 'Confirm Removal',
                  content: 'This grade will no longer be accessible for this school. Are you sure you want to proceed?',
                  type: 'red',
                  buttons: {
                      confirm: {
                          text: 'Yes, Remove',
                          btnClass: 'btn-red',
                          action: function () {
                              // AJAX request to remove the grade
                              $.ajax({
                                  url: '{{ route($_base_route.".remove-grade") }}', // Dynamic route
                                  type: 'POST',
                                  data: {
                                      school_id: schoolId, // School ID
                                      grade_id: gradeId   // Grade ID
                                  },
                                  headers: {
                                      'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token
                                  },
                                  success: function (response) {
                                      populateGrades(schoolId); // Refresh the grade list
                                      $.alert({
                                          title: 'Removed!',
                                          content: 'The grade has been successfully removed.',
                                          type: 'green'
                                      });
                                  },
                                  error: function (xhr, status, error) {
                                      console.error("Error:", error);
                                      $.alert({
                                          title: 'Error!',
                                          content: 'Error removing the grade. Please try again.',
                                          type: 'red'
                                      });
                                  }
                              });
                          }
                      },
                      cancel: {
                          text: 'Cancel',
                          action: function () {
                              // No action on cancel
                          }
                      }
                  }
              });
          });

          $(document).off('click', '.btn-section-list').on('click', '.btn-section-list', function (e) {
            e.preventDefault(); // Prevent default behavior
            var grade_id = $(this).data('grade');
            grade_section_id = grade_id
            $('#section-list-modal').modal('show')

            populateSections(id, grade_id);                
          });

          $(document).off('click', '.btn-add-section').on('click', '.btn-add-section', function (e) {
              e.preventDefault(); // Prevent default behavior
              var section = $('#selectSection').val(); // Get selected section value
              if (!section) {
                  alert("Please select a section.");
                  return;
              }
              // AJAX request to add grade
              $.ajax({
                  url: '{{route($_base_route.".grade.add-section")}}', // Dynamic course ID in route
                  type: "POST",
                  data: {
                      school_id: id,
                      grade_id: grade_section_id,
                      section_id: section
                  },
                  headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
                  },
                  success: function (response) {
                    alert(response.message);
                    populateSections(id, grade_section_id); // Re-populate grades

                  },
                  error: function (xhr, status, error) {
                      console.error("Error:", error);
                      alert("Error adding grade. Please try again.");
                  }
              });
          });


          $(document).off('click', '.btn-remove-grade-section').on('click', '.btn-remove-grade-section', function (e) {
              e.preventDefault(); // Prevent default behavior

              var gradeId = $(this).data('grade'); // Get the grade ID
              var schoolId = $(this).data('school'); // Get the school ID
              var sectionId = $(this).data('section');

              // Confirm removal
              $.confirm({
                  title: 'Confirm Removal',
                  content: 'This Section will no longer be accessible for this school Grade. Are you sure you want to proceed?',
                  type: 'red',
                  buttons: {
                      confirm: {
                          text: 'Yes, Remove',
                          btnClass: 'btn-red',
                          action: function () {
                              // AJAX request to remove the grade
                              $.ajax({
                                  url: '{{ route($_base_route.".grade.remove-section") }}', // Dynamic route
                                  type: 'POST',
                                  data: {
                                      school_id: schoolId, // School ID
                                      grade_id: gradeId,   // Grade ID
                                      section_id : sectionId,
                                  },
                                  headers: {
                                      'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token
                                  },
                                  success: function (response) {
                                    populateSections(schoolId, gradeId); // Refresh the grade list
                                      $.alert({
                                          title: 'Removed!',
                                          content: 'The Section has been successfully removed.',
                                          type: 'green'
                                      });
                                  },
                                  error: function (xhr, status, error) {
                                      console.error("Error:", error);
                                      $.alert({
                                          title: 'Error!',
                                          content: 'Error removing the Section. Please try again.',
                                          type: 'red'
                                      });
                                  }
                              });
                          }
                      },
                      cancel: {
                          text: 'Cancel',
                          action: function () {
                              // No action on cancel
                          }
                      }
                  }
              });
          });    
          
        });

        $(document).on('click', '.btn-grade-section-student-list', function (e) {
            e.preventDefault(); // Prevent default behavior
            var grade_id = $(this).data('grade');
            var section_id = $(this).data('section');
            var school_id = $(this).data('school');
            $('#grade-section-student-list-modal').modal('show');
            populateGradeStudent(school_id, grade_id, section_id);     
            
            
            $(document).off('click', '.btn-add-grade-section-student').on('click', '.btn-add-grade-section-student', function (e) {
              e.preventDefault(); // Prevent default behavior
              var student_id = $('#selectSectionStudent').val(); // Get selected grade value
              if (!student_id) {
                  alert("Please select a grade.");
                  return;
              }

              // AJAX request to add grade
              $.ajax({
                  url: '{{route($_base_route.".grade.section.add-student")}}', // Dynamic course ID in route
                  type: "POST",
                  data: {
                      school_id: school_id,
                      grade_id: grade_id,
                      section_id : section_id,
                      student_id : student_id,
                  },
                  headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
                  },
                  success: function (response) {
                    populateGradeStudent(school_id, grade_id, section_id); // Re-populate grades
                    alert(response.message);
                  },
                  error: function (xhr, status, error) {
                      console.error("Error:", error);
                      alert("Error adding Student. Please try again.");
                  }
              });
            });
            $(document).off('click', '.btn-remove-grade-student').on('click', '.btn-remove-grade-student', function (e) {
                e.preventDefault(); // Prevent default behavior

                var gradeId = $(this).data('grade'); // Get the grade ID
                var schoolId = $(this).data('school'); // Get the school ID
                var studentId = $(this).data('student');
                var sectionId = $(this).data('section');

                // Confirm removal
                $.confirm({
                    title: 'Confirm Removal',
                    content: 'This student will no longer be in this section. Are you sure you want to proceed?',
                    type: 'red',
                    buttons: {
                        confirm: {
                            text: 'Yes, Remove',
                            btnClass: 'btn-red',
                            action: function () {
                                // AJAX request to remove the grade
                                $.ajax({
                                    url: '{{ route($_base_route.".grade.section.remove-student") }}', // Dynamic route
                                    type: 'POST',
                                    data: {
                                        school_id: schoolId, // School ID
                                        grade_id: gradeId,   // Grade ID
                                        section_id : sectionId,
                                        student_id : studentId,
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token
                                    },
                                    success: function (response) {
                                      populateGradeStudent(schoolId, gradeId, sectionId); // Refresh the grade list
                                        $.alert({
                                            title: 'Removed!',
                                            content: 'The Student has been successfully removed.',
                                            type: 'green'
                                        });
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("Error:", error);
                                        $.alert({
                                            title: 'Error!',
                                            content: 'Error removing the Section. Please try again.',
                                            type: 'red'
                                        });
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            action: function () {
                                // No action on cancel
                            }
                        }
                    }
                });
            });
        });

        $(document).on('click', '.btn-grade-section-course-list', function (e) {
            e.preventDefault(); // Prevent default behavior
            var grade_id = $(this).data('grade');
            var section_id = $(this).data('section');
            var school_id = $(this).data('school');
            $('#grade-section-course-list-modal').modal('show');
            populateGradeSectionCourse(school_id, grade_id, section_id);     
            
            
            $(document).off('click', '.btn-add-grade-section-course').on('click', '.btn-add-grade-section-course', function (e) {
              e.preventDefault(); // Prevent default behavior
              var course_id = $('#selectSectionCourse').val(); // Get selected grade value
              if (!course_id) {
                  alert("Please select a Course.");
                  return;
              }

              // AJAX request to add grade
              $.ajax({
                  url: '{{route($_base_route.".grade.section.add-course")}}', // Dynamic course ID in route
                  type: "POST",
                  data: {
                      school_id: school_id,
                      grade_id: grade_id,
                      section_id : section_id,
                      course_id : course_id,
                  },
                  headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
                  },
                  success: function (response) {
                    populateGradeSectionCourse(school_id, grade_id, section_id); // Re-populate grades
                    alert(response.message);
                  },
                  error: function (xhr, status, error) {
                      console.error("Error:", error);
                      alert("Error adding Course. Please try again."+ error);
                  }
              });
            });
            $(document).off('click', '.btn-remove-grade-section-course').on('click', '.btn-remove-grade-section-course', function (e) {
                e.preventDefault(); // Prevent default behavior
                var course_id = $(this).data('course');
                // Confirm removal
                $.confirm({
                    title: 'Confirm Removal',
                    content: 'This Course will no longer be in this section. Are you sure you want to proceed?',
                    type: 'red',
                    buttons: {
                        confirm: {
                            text: 'Yes, Remove',
                            btnClass: 'btn-red',
                            action: function () {
                                // AJAX request to remove the grade
                                $.ajax({
                                    url: '{{ route($_base_route.".grade.section.remove-course") }}', // Dynamic route
                                    type: 'POST',
                                    data: {
                                        school_id: school_id, // School ID
                                        grade_id: grade_id,   // Grade ID
                                        section_id : section_id,
                                        course_id : course_id,
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token
                                    },
                                    success: function (response) {
                                      populateGradeSectionCourse(school_id, grade_id, section_id); // Refresh the grade list
                                        $.alert({
                                            title: 'Removed!',
                                            content: 'The Course has been successfully removed.',
                                            type: 'green'
                                        });
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("Error:", error);
                                        $.alert({
                                            title: 'Error!',
                                            content: 'Error removing the Section. Please try again.',
                                            type: 'red'
                                        });
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            action: function () {
                                // No action on cancel
                            }
                        }
                    }
                });
            });
        });

        $(document).on('click', '.btn-grade-section-teacher-list', function (e) {
            e.preventDefault(); // Prevent default behavior
            var grade_id = $(this).data('grade');
            var section_id = $(this).data('section');
            var school_id = $(this).data('school');
            $('#grade-section-teacher-list-modal').modal('show');
            populateGradeSectionTeacher(school_id, grade_id, section_id);     
            
            
            $(document).off('click', '.btn-add-grade-section-course').on('click', '.btn-add-grade-section-course', function (e) {
              e.preventDefault(); // Prevent default behavior
              var course_id = $('#selectSectionCourse').val(); // Get selected grade value
              if (!course_id) {
                  alert("Please select a Course.");
                  return;
              }

              // AJAX request to add grade
              $.ajax({
                  url: '{{route($_base_route.".grade.section.add-course")}}', // Dynamic course ID in route
                  type: "POST",
                  data: {
                      school_id: school_id,
                      grade_id: grade_id,
                      section_id : section_id,
                      course_id : course_id,
                  },
                  headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
                  },
                  success: function (response) {
                    populateGradeSectionCourse(school_id, grade_id, section_id); // Re-populate grades
                    alert(response.message);
                  },
                  error: function (xhr, status, error) {
                      console.error("Error:", error);
                      alert("Error adding Course. Please try again."+ error);
                  }
              });
            });
            $(document).off('click', '.btn-remove-grade-section-course').on('click', '.btn-remove-grade-section-course', function (e) {
                e.preventDefault(); // Prevent default behavior
                var course_id = $(this).data('course');
                // Confirm removal
                $.confirm({
                    title: 'Confirm Removal',
                    content: 'This Course will no longer be in this section. Are you sure you want to proceed?',
                    type: 'red',
                    buttons: {
                        confirm: {
                            text: 'Yes, Remove',
                            btnClass: 'btn-red',
                            action: function () {
                                // AJAX request to remove the grade
                                $.ajax({
                                    url: '{{ route($_base_route.".grade.section.remove-course") }}', // Dynamic route
                                    type: 'POST',
                                    data: {
                                        school_id: school_id, // School ID
                                        grade_id: grade_id,   // Grade ID
                                        section_id : section_id,
                                        course_id : course_id,
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token
                                    },
                                    success: function (response) {
                                      populateGradeSectionCourse(school_id, grade_id, section_id); // Refresh the grade list
                                        $.alert({
                                            title: 'Removed!',
                                            content: 'The Course has been successfully removed.',
                                            type: 'green'
                                        });
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("Error:", error);
                                        $.alert({
                                            title: 'Error!',
                                            content: 'Error removing the Section. Please try again.',
                                            type: 'red'
                                        });
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            action: function () {
                                // No action on cancel
                            }
                        }
                    }
                });
            });
        });

          
    
    });
</script>
@endsection

