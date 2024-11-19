
@extends('layouts.admin')
@section('title', $_panel)
@section('css')

    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
        <a href="{{ route($_base_route.'.create') }}"><button id="addToTable" class="btn btn-primary"> Create New <i class="fa fa-plus"></i></button></a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Code</th>
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
  <!-- Control Sidebar -->
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
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Course Title</th>
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
                { data: 'user.name', name: 'name' },
                { data: 'user.email', name: 'email' },
                { data: 'teacher_id', name: 'teacher_id' },
                { data: 'total_course', name: 'total_course' },
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

              // Loop through the chapters received in the response and append rows
              response.forEach(course => {
                const row = `
                  <tr>
                    <td>${course.title}</td>
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
            populateCourseChapters(id);
            $('#course-list-modal').modal('show')
        });
    });
</script>
@endsection

