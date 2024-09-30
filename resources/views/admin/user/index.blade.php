
@extends('layouts.admin')
@section('title', 'प्रयोगकर्ता')
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
            <h1>प्रयोगकर्ता</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">होम</a></li>
              <li class="breadcrumb-item active">प्रयोगकर्ता सुची</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="{{ route($_base_route.'.create') }}"><button id="addToTable" class="btn btn-primary"> थप्नुहोस् <i class="fa fa-plus"></i></button></a>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">प्रयोगकर्ता सुची</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered fiscal-year-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>पहिलो नाम</th>
                            <th>थर</th>
                            <th>ईमेल</th>
                            <th>प्रयोगकर्ता भूमिका	</th>
                            <th>कारवाही भएको स्थिति</th>
                            <th>कार्य</th>

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
            ajax: "{{ route('admin.user.data') }}",
            columns: [
                {
                    data: null,
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                { data: 'roles', name: 'roles' },
                { data: 'user_status', name: 'user_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
