@extends('layouts.admin')
@section('title', 'प्रयोगकर्ता')
@section('css')
<style>
    .card {
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table th {
    width: 40%;
}

textarea {
    resize: none;
}

.btn-success {
    margin-right: 10px;
}

.btn-primary {
    margin-top: 10px;
}

</style>
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
                        <strong>प्रयोगकर्ता</strong>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>पहिलो नाम :</th>
                                <td>{{ $data['rows']->fiscalYear->fiscal_np }}</td>
                            </tr>
                            <tr>
                                <th>थर :</th>
                                <td>{{ $data['rows']->date }}</td>
                            </tr>
                            <tr>
                                <th>ईमेल :</th>
                                <td>Send</td>
                            </tr>
                            <tr>
                                <th>प्रयोगकर्ता भूमिका :</th>
                                <td>{{ $data['rows']->no }}</td>
                            </tr>
                            <tr>
                                <th>कारवाही भएको स्थिति :</th>
                                <td>{{ $data['rows']->branch->name }}</td>
                            </tr>

                            <tr>
                                <th>दर्ता गरिएको मिति :</th>
                                <td>{{ $data['rows']->subject }}</td>
                            </tr>

                            <tr>
                                <th>दर्ता गरिएको आईपी ठेगाना :</th>
                                <td>{{ $data['rows']->name }}</td>
                            </tr>
                            <tr>
                                <th>अन्तिम लगइन मिति :</th>
                                <td><a href="#">Download Document</a></td>
                            </tr>
                            <tr>
                                <th>अन्तिम लगइन आईपी ठेगाना :</th>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection
