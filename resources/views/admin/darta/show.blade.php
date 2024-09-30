@extends('layouts.admin')
@section('title', 'चलानी')
@section('css')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="container mt-2">
        <div class="row">
            <!-- Left Section: Document Details -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>कागजात विवरण सूची</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>आर्थिक वर्ष :</th>
                                <td>{{ $data['rows']->fiscalYear->fiscal_np }}</td>
                            </tr>
                            <tr>
                                <th>Added मिति :</th>
                                <td>{{ $data['rows']->date }}</td>
                            </tr>
                            <tr>
                                <th>कागजात वर्ग :</th>
                                <td>Send</td>
                            </tr>
                            <tr>
                                <th>पत्रको दर्ता नम्बर :</th>
                                <td>{{ $data['rows']->darta_no }}</td>
                            </tr>
                            <tr>
                                <th>शाखा :</th>
                                <td>{{ $data['rows']->branch->name }}</td>
                            </tr>

                            <tr>
                                <th>विषय :</th>
                                <td>{{ $data['rows']->subject }}</td>
                            </tr>

                            <tr>
                                <th>व्यक्तिको नाम/कार्यलय ठेगाना :</th>
                                <td>{{ $data['rows']->name }}</td>
                            </tr>
                            <tr>
                                <th>कागजातको अपलोड :</th>
                                <td><a href="#">Download Document</a></td>
                            </tr>
                            <tr>
                                <th>अपलोड गरिएको कागजात(हरु) हेर्नुहोस् :</th>
                                <td>
                                    <ul>
                                        @foreach($data['rows']->images as $image)
                                            <li><a href="{{ asset($image->image_path) }}">{{ $image->image_path }}</a></li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Section: Comments & File Upload -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong>कागजात विवरण सूची</strong>
                    </div>
                    <div class="card-body">
                        <p><strong>0 Comments</strong></p>
                        <form>
                            <div class="form-group">
                                <label for="comments">टिप्पणी थनुहोस्</label>
                                <textarea class="form-control" id="comments" rows="3" placeholder="टिप्पणी थनुहोस्"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">फाइल</label>
                                <input type="file" class="form-control-file" id="file">
                            </div>
                            <button type="button" class="btn btn-success">
                                <i class="fa fa-users"></i> + Add Users
                            </button>
                            <button type="submit" class="btn btn-primary">Recieve</button>
                            <button type="button" class="btn btn-primary">अपलोड गर्नुहोस</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
