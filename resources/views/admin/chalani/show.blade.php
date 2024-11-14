@extends('layouts.admin')
@section('title', 'चलानी')
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
                                <th>पत्रको चलानी नम्बर :</th>
                                <td>{{ $data['rows']->no }}</td>
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
                                <td>
                                    @foreach($data['rows']->images as $image)
                                        <li><a href="javascript:void(0);"
                                            class="download-file"
                                            onclick="downloadFile('{{ asset($image->image_path) }}')" data-key="{{ $image->key }}">
                                            {{ $image->document ? $image->document->name : 'N/A' }}
                                         </a></li>
                                    @endforeach
                                    </td>
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
                                <button type="button" class="btn btn-primary">अपलोड गर्नुहोस</button>
                            </div>
                            <button type="button" class="btn btn-success" id="addUser">
                                <i class="fa fa-users"></i> + Add Users
                            </button>
                            <div id="userFields">
                                <!-- Dynamic user input fields will be appended here -->
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function downloadFile(url) {
        // Use fetch to get the file from the URL
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.blob(); // Convert the response into a Blob
            })
            .then(blob => {
                const link = document.createElement('a'); // Create an invisible anchor element
                const objectUrl = URL.createObjectURL(blob); // Create a URL for the Blob
                link.href = objectUrl;
                link.download = url.split('/').pop(); // Use the last part of the URL as the filename
                document.body.appendChild(link); // Append the link to the body
                link.click(); // Trigger the download
                document.body.removeChild(link); // Remove the link from the DOM
                URL.revokeObjectURL(objectUrl); // Clean up the object URL
            })
            .catch(error => {
                console.error('There was an error downloading the file:', error);
            });
    }

    $(document).ready(function() {
        $('.download-file').on('click', function(e) {
            e.preventDefault();
        alert('The file has been downloaded')
            var key = $(this).data('key');
            $.ajax({
                url: "{{ route($_base_route.'.download-image', ['key' => 'KEY_PLACEHOLDER']) }}".replace('KEY_PLACEHOLDER', key), // Replace placeholder with actual key,
                type: "GET",
                success: function(response) {
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });




</script>
@endsection
