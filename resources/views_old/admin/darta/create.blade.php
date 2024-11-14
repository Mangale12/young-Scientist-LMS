@extends('layouts.admin')
@section('title', 'दर्ता')
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
            <h1>दर्ता</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">होम</a></li>
              <li class="breadcrumb-item active">नयाँ दर्ता</li>
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
              <h3 class="card-title">नयाँ दर्ता</h3>
              <h3 class="card-title ml-5 float-right">आजको मिति: {{ datenepUnicode(date('Y-m-d'), 'nepali') }}</h3>
              <h3 class="card-title mr-5 float-right">पछिल्लो दर्ता नम्बर: {{ $data['darta_no'] }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route($_base_route.'.store') }}" method="POST" enctype='multipart/form-data'>
              @csrf
              <input type="hidden" name="is_darta" id="is-darta" value="1">
              <div class="card-body row">
                <div class="form-group col-3">
                  <label for="no">दर्ता नम्बर</label>
                  <input type="text" class="form-control" id="no" name="darta_no" value="{{ old('darta_no', $data['darta_no']) }}" placeholder="">
                  @if($errors->has('darta_no'))
                  <p id="no-error" class="help-block text-danger"><span>{{ $errors->first('darta_no') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="date">पत्रको मिति</label>
                  <input type="text" class="form-control" id="date" name="date" value="{{ old('date', getNepToEng(datenepUnicode(date('Y-m-d'), 'nepali'))) }}" placeholder="" readonly>
                  @if($errors->has('date'))
                  <p id="date-error" class="help-block text-danger"><span>{{ $errors->first('date') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="fiscal-year-id">आर्थिक बर्ष *</label>
                  <select name="fiscal_year_id" id="fiscal-year-id" class="form-control">
                    <option selected disabled>आर्थिक वर्षा छान्न्नुहोस </option>
                    @foreach($data['fiscalYears'] as $fiscalYear)
                    <option value="{{$fiscalYear->id }}" {{ old('fiscal_year_id') == $fiscalYear->id ? 'selected' : '' }}>{{ $fiscalYear->fiscal_np }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('fiscal_year_id'))
                  <p id="fiscal-year-id-error" class="help-block text-danger"><span>{{ $errors->first('fiscal_year_id') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="subject">बिषय *</label>
                  <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" placeholder="">
                  @if($errors->has('subject'))
                  <p id="subject-error" class="help-block text-danger"><span>{{ $errors->first('subject') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="office-id">कार्यालय *</label>
                  <select name="office_id" id="office-id" class="form-control">
                    <option selected disabled>कार्यालय छान्न्नुहोस </option>
                    @foreach($data['offices'] as $office)
                    <option value="{{$office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('office_id'))
                  <p id="office-id-error" class="help-block text-danger"><span>{{ $errors->first('office_id') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="name">व्यक्तिको नाम/कार्यालय ठेगाना *</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="">
                  @if($errors->has('name'))
                  <p id="name-error" class="help-block text-danger"><span>{{ $errors->first('name') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="document-type-id">कागजातको प्रकार *</label>
                  <select name="document_type_id" id="document-type-id" class="form-control">
                    <option selected disabled>कागजातको प्रकार छान्न्नुहोस </option>
                    @foreach($data['documentTypes'] as $documentType)
                    <option value="{{$documentType->id }}" {{ old('document_type_id') == $documentType->id ? 'selected' : '' }}>{{ $documentType->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('document_type_id'))
                  <p id="document-type-id-error" class="help-block text-danger"><span>{{ $errors->first('document_type_id') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="branch-id">साखा नाम *</label>
                  <select name="branch_id" id="branch-id" class="form-control">
                    <option selected disabled>साखा नाम छान्न्नुहोस </option>
                    @foreach($data['branches'] as $branch)
                    <option value="{{$branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('branch_id'))
                  <p id="branch-id-error" class="help-block text-danger"><span>{{ $errors->first('branch_id') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="remarks">कैफियत *</label>
                  <textarea name="remarks" id="remarks" class="form-control">{{ old('remarks') }}</textarea>
                  @if($errors->has('remarks'))
                  <p id="remarks-error" class="help-block text-danger"><span>{{ $errors->first('remarks') }}</span></p>
                  @endif
                </div>

                <div class="form-group col-3">
                  <label for="image">कागजातको अपलोड *</label>
                  <div class="input-group mb-3">
                    <input type="file" class="form-control" id="image" name="image[]" accept="image/*">
                  </div>
                  <div id="fileInputs"></div>
                  <button type="button" class="btn btn-success" id="addMoreButton">
                    <i class="fa fa-plus"></i> थप्नुस् थप तस्विरहरू
                  </button>
                  @if($errors->has('image'))
                  <p id="image-error" class="help-block text-danger"><span>{{ $errors->first('image') }}</span></p>
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
