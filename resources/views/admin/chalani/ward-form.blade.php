
<link href="{{ asset('assets/cms/plugin/nepali.datepicker.v3.7/css/nepali.datepicker.v3.7.min.css')}}" rel="stylesheet" />
<form action="" class="col-12 row" id="chalani-form">
    @csrf
    <input type="hidden" name="type" value="chalani">
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
        <label for="no">चलानी नम्बर</label>
        <input type="text" class="form-control" id="chalani-no" name="chalani_no" value="{{ old('chalani_no') }}" placeholder="">
        @if($errors->has('chalani_no'))
        <p id="chalani-no-error" class="help-block text-danger"><span>{{ $errors->first('chalani_no') }}</span></p>
        @endif
    </div>
    <div class="form-group col-3">
        <label for="no">पत्रको दर्ता नम्बर</label>
        <input type="text" class="form-control" id="chalani-no" name="darta_no" value="{{ old('darta_no') }}" placeholder="">
        @if($errors->has('chalani_no'))
        <p id="chalani-no-error" class="help-block text-danger"><span>{{ $errors->first('chalani_no') }}</span></p>
        @endif
    </div>
    <div class="form-group col-3">
        <label for="date">मिति( from )</label>
        <input type="text" class="form-control" id="date-from" name="start_date" value="{{ old('start_date', getNepToEng(datenepUnicode(date('Y-m-d'), 'nepali'))) }}" placeholder="" readonly>
        @if($errors->has('date'))
        <p id="date-error" class="help-block text-danger"><span>{{ $errors->first('date') }}</span></p>
        @endif
    </div>
    <div class="form-group col-3">
        <label for="date">मिति (to)</label>
        <input type="text" class="form-control" id="date-to" name="end_date" value="{{ old('end_date', getNepToEng(datenepUnicode(date('Y-m-d'), 'nepali'))) }}" placeholder="" readonly>
        @if($errors->has('date'))
        <p id="date-error" class="help-block text-danger"><span>{{ $errors->first('date') }}</span></p>
        @endif
    </div>

    <div class="form-group col-3">
        <label for="document-type-id">वार्ड *</label>
        <select name="document_type_id" id="document-type-id" class="form-control">
        <option selected disabled>वार्ड छान्नुहोस् </option>
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
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
    <script src="{{ asset('assets/cms/plugin/nepali.datepicker.v3.7/js/nepali.datepicker.v3.7.min.js')}}" type="text/javascript"></script>
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            $('#date-from').nepaliDatePicker({
                dateFormat: 'YYYY/MM/DD',
                closeOnDateSelect: true,
            });
            $('#date-to').nepaliDatePicker({
                dateFormat: 'YYYY/MM/DD',
                closeOnDateSelect: true,
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#chalani-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: "{{ route('admin.chalani.get-ward-data') }}", // Replace with your actual route
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('.fiscal-year-table').empty().append(response.html);
                    },
                    error: function(xhr, status, error) {
                        // Handle server errors
                        console.log(xhr);
                        console.log('Error: ' + xhr);
                    }
                });
            });
        });
    </script>






