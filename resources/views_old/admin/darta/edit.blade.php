@extends('layouts.admin')
@section('title', 'चलानी')
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
            <h1>चलानी</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">होम</a></li>
              <li class="breadcrumb-item active">सम्पादन चलानी</li>
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
                <h3 class="card-title">सम्पादन चलानी</h3>
                <h3 class="card-title ml-5 float-right">आजको मिति: {{ datenepUnicode(date('Y-m-d'), 'nepali') }}</h3>
                <h3 class="card-title mr-5 float-right">पछिल्लो चालानी नम्बर: {{ $data['rows']->no }}</h3>

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="{{ route($_base_route.'.store') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="card-body row">
                  <div class="form-group col-3">
                    <label for="exampleInputEmail1">आर्थिक बर्ष *</label>
                    <select name="fiscal_year_id" id="fiscal-year-id" class="form-control">
                        <option selected disabled>आर्थिक वर्षा छान्न्नुहोस </option>
                      @foreach($data['fiscalYears'] as $fiscalYear)
                        <option value="{{$fiscalYear->id }}" {{ old('fiscal_year_id', $data['rows']->fiscal_year_id) == $fiscalYear->id ? 'selected' : '' }}>{{ $fiscalYear->fiscal_np }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('fiscal_year_id'))
                    <p id="fiscal-np-error" class="help-block text-danger" for="agricultural_id"><span>{{ $errors->first('fiscal_year_id') }}</span></p>
                    @endif
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputEmail1">चलानी नम्बर</label>
                    <input type="text" class="form-control" id="no" name="no" value="{{ old('no', $data['rows']->no) }}" placeholder="">
                    @if($errors->has('no'))
                    <p id="no-error" class="help-block text-danger" for="agricultural_id"><span>{{ $errors->first('no') }}</span></p>
                    @endif
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputEmail1">बिषय *</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject', $data['rows']->subject) }}" placeholder="">
                    @if($errors->has('subject'))
                    <p id="subject-error" class="help-block text-danger" for="subject"><span>{{ $errors->first('subject') }}</span></p>
                    @endif
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputEmail1">पत्रको मिति</label>
                    <input type="text" class="form-control" id="date" name="date" value="{{ old('date', $data['rows']->date) }}" placeholder="" readonly>
                    @if($errors->has('date'))
                    <p id="date-error" class="help-block text-danger" for="date"><span>{{ $errors->first('date') }}</span></p>
                    @endif
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputEmail1">व्यक्तिको नाम/कार्यालय ठेगाना *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $data['rows']->name) }}" placeholder="">
                    @if($errors->has('name'))
                    <p id="name-error" class="help-block text-danger" for="name"><span>{{ $errors->first('name') }}</span></p>
                    @endif
                  </div>
                  <div class="form-group col-3">
                    <label for="branch">शाखा *</label>
                    <input type="text" class="form-control" id="branch" name="branch" value="{{ old('branch', $data['rows']->branch) }}" placeholder="">
                    @if($errors->has('branch'))
                    <p id="branch-error" class="help-block text-danger" for="branch"><span>{{ $errors->first('branch') }}</span></p>
                    @endif
                  </div>

                  <div class="form-group col-3">
                    <label for="remarks">कैफियत *</label>
                    <textarea name="remarks" id="remarks" class="form-control">{{ old('remarks', $data['rows']->remarks) }}</textarea>
                    @if($errors->has('remarks'))
                    <p id="remarks-error" class="help-block text-danger" for="remarks"><span>{{ $errors->first('remarks') }}</span></p>
                    @endif
                  </div>

                  <div class="form-group col-3">
                    <label for="remarks">कागजातको अपलोड *</label>

                    <!-- Display existing images if any -->
                    @if($data['rows']->chalaniImages->isNotEmpty())
                        @foreach($data['rows']->chalaniImages as $key => $image)
                            <img src="{{ asset($image->image_path) }}" alt="{{ $data['rows']->name }}" class="img-thumbnail mb-2" style="width: 100px;">
                        @endforeach
                    @endif

                    <!-- First file input -->
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="image" name="image[]" accept="image/*">
                    </div>

                    <!-- Place for dynamic file inputs -->
                    <div id="fileInputs"></div>

                    <!-- Add More Button -->
                    <button type="button" class="btn btn-success" id="addMoreButton">
                        <i class="fa fa-plus"></i> थप्नुस् थप तस्विरहरू
                    </button>

                    <!-- Display validation errors for remarks -->
                    @if($errors->has('remarks'))
                        <p id="remarks-error" class="help-block text-danger" for="remarks">
                            <span>{{ $errors->first('remarks') }}</span>
                        </p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="{{ asset('assets/cms/plugin/nepali.datepicker.v3.7/js/nepali.datepicker.v3.7.min.js')}}" type="text/javascript"></script>
<script>
    $('#date').nepaliDatePicker({
            dateFormat: 'YYYY-MM-DD',
            closeOnDateSelect: true,
        });

        // Add more file inputs dynamically
        document.getElementById('addMoreButton').addEventListener('click', function () {
            var fileInput = document.createElement('div');
            fileInput.classList.add('input-group', 'mb-3');
            fileInput.innerHTML = '<input type="file" class="form-control" name="image[]" accept="image/*">';
            document.getElementById('fileInputs').appendChild(fileInput);
        });
</script>
@endsection
