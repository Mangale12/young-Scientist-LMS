@extends('layouts.admin')
@section('title', 'प्रयोगकर्ता प्रकार')
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
            <h1>प्रयोगकर्ता प्रकार</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">होम</a></li>
              <li class="breadcrumb-item active">नयाँ प्रयोगकर्ता प्रकार</li>
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
                <h3 class="card-title">नयाँ प्रयोगकर्ता प्रकार</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="{{ route($_base_route.'.update', ['id'=>$data['rows']->id]) }}" method="POST" enctype='multipart/form-data'>
                @csrf
                @method('put')
                <div class="card-body row">
                  <div class="form-group col-3">
                    <label for="name"> प्रयोगकर्ता प्रकार *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $data['rows']->name) }}" placeholder="">
                    @if($errors->has('name'))
                    <p id="name-error" class="help-block text-danger" for="agricultural_id"><span>{{ $errors->first('name') }}</span></p>
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-12 mb-3">
                        <h4>कृपया अनुमतिहरू चयन गर्नुहोस्</h4>
                    </div>
                    <div class="col-12 mb-3">
                        <input type="checkbox" id="select-all" class="select-all">
                        <label for="select-all" class="font-weight-bold">सबै छान्नु</label>
                    </div>
                    @foreach ($data['permissions'] as $guardName => $permissionGroup)
                  <div class="col-md-4 mb-3">
                      <h5>{{ $guardName }}</h5>
                      <div class="form-group">
                          @foreach ($permissionGroup as $permission)
                          <label>
                              {{ Form::checkbox('permission[]', $permission->id, $data['role']->hasPermissionTo($permission->name), ['class' => 'permission-checkbox']) }}
                              {{ $permission->name_nep }}
                          </label>
                          <br>
                          @endforeach
                      </div>
                  </div>
                  @endforeach
                </div>


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
