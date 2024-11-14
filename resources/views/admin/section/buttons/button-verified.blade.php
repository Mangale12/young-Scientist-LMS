{{-- <a href="{{ $route }}">
    <button class="btn btn-success btn-sm m-r-5" data-toggle="tooltip" data-original-title="Verified" style="cursor: pointer;">
        <i class="fas fa-check-circle"></i>
    </button>
</a> --}}

{{-- <a href="{{ $route }}">
    <button class="btn btn-sm m-r-5 {{ $is_verified == 1 ? 'btn-success' : 'btn-danger' }}"
            data-toggle="tooltip"
            data-original-title="{{ $is_verified == 1 ? 'Verified' : 'Unverified' }}"
            style="cursor: pointer;">
        <i class="{{ $is_verified == 1 ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
    </button>
</a> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<a href="javascript:void(0);" class="verify-button"
   data-id="{{ $id }}"
   data-url="{{ $route }}"
   data-verified="{{ $is_verified }}">
    <button class="btn btn-sm m-r-5 {{ $is_verified == 1 ? 'btn-success' : 'btn-danger' }}"
            data-toggle="tooltip"
            data-original-title="{{ $is_verified == 1 ? 'Verified' : 'Unverified' }}"
            style="cursor: pointer;">
        <i class="{{ $is_verified == 1 ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
    </button>
</a>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>

$(document).ready(function () {
    // Ensure that the click event handler is attached only once
    $(document).off('click', '.verify-button').on('click', '.verify-button', function () {
        var id = $(this).data('id');
        var url = $(this).data('url');
        var $object = $(this); // Reference the button that was clicked

        $.confirm({
            title: 'तपाईं प्रमाणित गर्न चाहनुहुन्छ ?', // "Do you want to delete?"
            autoClose: 'cancelAction|6000', // Automatically close after 6 seconds
            buttons: {
                deleteUser: {
                    text: 'Verified',
                    btnClass: 'btn-green',
                    action: function () {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: "JSON",
                            beforeSend: function (xhr) {
                                var token = $('meta[name="csrf-token"]').attr('content');
                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },

                            success: function (response) {
                                    $.alert('Verified Successfully!');
                                    // Use DataTables API to remove the row
                                    var table = $('.table').DataTable();
                                    table
                                        .row($object.parents('tr')) // Get the row containing the clicked button
                                        .remove() // Remove the row from the table
                                        .draw(); // Redraw the table without refreshing the page
                            },
                            error: function (xhr) {
                                console.log(xhr.responseText);
                                $.alert('Error occurred!');
                            }
                        });
                    }
                },
                cancelAction: function () {
                    $.alert('Action canceled!');
                }
            }
        });
    });
});

</script>

