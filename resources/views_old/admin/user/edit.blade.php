@extends('layouts.admin')
@section('title', 'प्रयोगकर्ता')
@section('css')
<link href="{{ asset('assets/cms/plugin/nepali.datepicker.v3.7/css/nepali.datepicker.v3.7.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
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
              <li class="breadcrumb-item active">नयाँ प्रयोगकर्ता</li>
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
              <h3 class="card-title">नयाँ प्रयोगकर्ता</h3>
              <h3 class="card-title ml-5 float-right">आजको मिति: {{ datenepUnicode(date('Y-m-d'), 'nepali') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($_base_route.'.update', $data['rows']->id) }}" method="POST" enctype='multipart/form-data'>
              @csrf
              @method('PUT')
              <div class="card-body row">
                <div class="form-group col-3">
                  <label for="no">पहिलो नाम *</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $data['rows']->name) }}" placeholder="">
                  @if($errors->has('name'))
                  <p id="name-error" class="help-block text-danger"><span>{{ $errors->first('name') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="last_name">थर *</label>
                  <input type="text" class="form-control" id="last-name" name="last_name" value="{{ old('last_name', $data['rows']->last_name) }}" placeholder="" >
                  @if($errors->has('last_name'))
                  <p id="last-name-error" class="help-block text-danger"><span>{{ $errors->first('last_name') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                    <label for="email">ईमेल *</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $data['rows']->email) }}" placeholder="">
                    @if($errors->has('email'))
                    <p id="email-error" class="help-block text-danger"><span>{{ $errors->first('email') }}</span></p>
                    @endif
                </div>

                <div class="form-group col-3">
                    <label for="username">प्रयोगकर्ता नाम *</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $data['rows']->username) }}" placeholder="">
                    @if($errors->has('username'))
                    <p id="username-error" class="help-block text-danger"><span>{{ $errors->first('username') }}</span></p>
                    @endif
                </div>

                <div class="form-group col-3">
                    <label for="phone">सम्पर्क नम्बर *</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $data['rows']->phone) }}" placeholder="">
                    @if($errors->has('phone'))
                    <p id="phone-error" class="help-block text-danger"><span>{{ $errors->first('phone') }}</span></p>
                    @endif
                </div>


                <div class="form-group col-3">
                    <label for="branch-id">साखा नाम *</label>
                    <select name="branch_id" id="branch-id" class="form-control">
                      <option selected disabled>साखा नाम छान्न्नुहोस </option>
                      @foreach($data['branches'] as $branch)
                      <option value="{{$branch->id }}" {{ old('branch_id', $data['rows']->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('branch_id'))
                    <p id="branch-id-error" class="help-block text-danger"><span>{{ $errors->first('branch_id') }}</span></p>
                    @endif
                  </div>
                  <div class="form-group col-3">
                    <label for="position-id">पद *</label>
                    <select name="position_id" id="position-id" class="form-control">
                      <option selected disabled>पद छान्न्नुहोस </option>
                      @foreach($data['positions'] as $position)
                      <option value="{{$position->id }}" {{ old('position_id', $data['rows']->position_id) == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('position_id'))
                    <p id="position-id-error" class="help-block text-danger"><span>{{ $errors->first('position_id') }}</span></p>
                    @endif
                  </div>
                <div class="form-group col-3">
                  <label for="ward-id">वार्ड *</label>
                  <select name="ward_id" id="ward-id" class="form-control">
                    <option selected disabled>वार्ड छान्न्नुहोस </option>
                    @foreach($data['wards'] as $ward)
                    <option value="{{$ward->id }}" {{ old('ward_id', $data['rows']->ward_id) == $ward->id ? 'selected' : '' }}>{{ $ward->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('ward_id'))
                  <p id="ward-id-error" class="help-block text-danger"><span>{{ $errors->first('ward_id') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="status-id">स्थिति *</label>
                  <select name="status_id" id="status-id" class="form-control">
                    <option selected disabled>स्थिति छान्न्नुहोस </option>
                    @foreach($data['statuses'] as $status)
                    <option value="{{$status->id }}" {{ old('status_id', $data['rows']->status_id) == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('status_id'))
                  <p id="status-id-error" class="help-block text-danger"><span>{{ $errors->first('status_id') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                    <label for="document-type-id">प्रयोगकर्ता प्रकार *</label>
                    <select name="role_id" id="role-id" class="form-control">
                      <option selected disabled>प्रयोगकर्ता प्रकार छान्न्नुहोस </option>
                      @foreach($data['roles'] as $role)
                      <option value="{{$role->id }}" {{ old('role_id', $data['rows']->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('role_id'))
                    <p id="role-id-error" class="help-block text-danger"><span>{{ $errors->first('role_id') }}</span></p>
                    @endif
                  </div>

                <div class="form-group col-3">
                  <label for="profile-image">प्रोफाइल तस्वीर *</label>
                  <div class="input-group mb-3">
                    <input type="file" class="form-control" id="profile-image" name="profile_img" accept="image/*">
                  </div>

                  @if($errors->has('profile_img'))
                  <p id="profile-img-error" class="help-block text-danger"><span>{{ $errors->first('profile_img') }}</span></p>
                  @endif
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

@endsection
