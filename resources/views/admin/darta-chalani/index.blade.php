
@extends('layouts.admin')
@section('title', 'सबै पत्रहरु')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection
@section('content')
<div class="wrapper">
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>सबै पत्रहरु</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">होम</a></li>
            <li class="breadcrumb-item active">सबै पत्र सुची</li>
          </ol>
        </div>
      </div>
      <!-- Adding buttons below the title -->
      <div class="row mb-2">
        <div class="col-sm-12">
          <button  class="btn btn-primary btn-all-data">सबै पत्रहरु</button>
          <button  class="btn btn-primary btn-verified-data">कार्यवाही भएका पत्रहरु</button>
          <button  class="btn btn-primary btn-unverified-data">कार्यवाही नभएका पत्रहरु</button>
          {{-- <button class="btn btn-primary btn-ward">वडा अन्तर्गत दर्ता</button>
          <a href="" class="btn btn-primary">नगरपालिका अन्तर्गत दर्ता</a> --}}
        </div>
      </div>
    </div>
  </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{-- <a href="{{ route($_base_route.'.create') }}"><button id="addToTable" class="btn btn-primary"> थप्नुहोस् <i class="fa fa-plus"></i></button></a> --}}
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">सबै दर्ता पत्रहरु सुची</h3>
              </div>
              <!-- /.card-header -->
              <div class="ward-form"></div>
              <div class="card-body row all-darta">
                <table class="table table-bordered fiscal-year-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>आर्थिक वर्ष</th>
                            <th>कागजात वर्ग</th>
                            <th>कार्यालय</th>
                            <th>व्यक्तिको नाम/कार्यालय ठेगाना</th>
                            <th>बिषय</th>
                            <th>पत्र NO</th>
                            <th>पत्रको नेपाली मिति</th>
                            <th>कैफियत</th>
                            <th>कारवाही भएको स्थिति	</th>
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

{{-- scripts --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
    // Get stored filter from localStorage, default to 'all'
    var filter = localStorage.getItem('darta_chalanli_filter') || 'all';
    var route;

    // Function to reload the DataTable based on the route
    function reloadTable() {
        var table = $('.fiscal-year-table').DataTable();
        table.ajax.url(route).load();  // Update ajax URL and reload the table
    }

    // Set the initial route and button state based on the filter
    function setInitialRoute() {
        if (filter === 'verified') {
            route = "{{ route('admin.darta-chalani.verified-data') }}";
            activateButton('.btn-verified-data');
        } else if (filter === 'unverified') {
            route = "{{ route('admin.darta-chalani.unverified-data') }}";
            activateButton('.btn-unverified-data');
        } else {
            route = "{{ route('admin.darta-chalani.data') }}";
            activateButton('.btn-all-data');
        }
    }

    // Function to activate the button
    function activateButton(selector) {
        // Remove 'btn-success' from all buttons and reset them to 'btn-primary'
        $('.btn-all-data, .btn-verified-data, .btn-unverified-data')
            .removeClass('btn-success')
            .addClass('btn-primary');

        // Add 'btn-success' to the active button
        $(selector).removeClass('btn-primary').addClass('btn-success');
    }

    // Initialize the DataTable with the current route
    function initializeDataTable() {
        $('.fiscal-year-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: route,  // Use the route from the filter
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
                }
            },
            columns: [
                {
                    data: null,
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'fiscal_year', name: 'fiscal_year' },
                { data: 'type', name: 'type' },
                { data: 'subject', name: 'subject' },
                { data: 'branch', name: 'branch' },
                { data: 'name', name: 'name' },
                { data: 'darta_no', name: 'darta_no' },
                { data: 'date', name: 'date' },
                { data: 'remarks', name: 'remarks' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', text: 'CSV', className: 'btn btn-info' },
                { extend: 'excel', text: 'Excel', className: 'btn btn-success' },
                { extend: 'pdf', text: 'PDF', className: 'btn btn-danger' },
                { extend: 'print', text: 'Print', className: 'btn btn-primary' }
            ]
        });
    }

    // Initial setup
    setInitialRoute();
    initializeDataTable();

    // Event listeners for button clicks
    $('.btn-verified-data').on('click', function() {
        route = "{{ route('admin.darta-chalani.verified-data') }}";
        localStorage.setItem('darta_chalanli_filter', 'verified');  // Save filter to localStorage
        activateButton('.btn-verified-data');
        $('.ward-form').empty()
        reloadTable();
    });

    $('.btn-unverified-data').on('click', function() {
        route = "{{ route('admin.darta-chalani.unverified-data') }}";
        localStorage.setItem('darta_chalanli_filter', 'unverified');  // Save filter to localStorage
        activateButton('.btn-unverified-data');
        $('.ward-form').empty()
        reloadTable();
    });

    $('.btn-all-data').on('click', function() {
        route = "{{ route('admin.darta-chalani.data') }}";
        localStorage.setItem('darta_chalanli_filter', 'all');  // Save filter to localStorage
        activateButton('.btn-all-data');
        $('.ward-form').empty()
        reloadTable();
    });

    $('.btn-ward').on('click', function() {
       {{-- route = "{{ route('admin.darta-chalani.ward-data') }}"; --}}
        activateButton('.btn-ward');

        $.ajax({
            url: route,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}" // Include CSRF token for protection
            },
            success: function(response) {
                console.log(response);
                // $('.ward-form').empty().append(response);
                $('.all-data tbody').empty();
                    $('.ward-form').append(response);
            }
        });
    });
});

</script>
@endsection

