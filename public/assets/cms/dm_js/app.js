
$(document).on('click','#delete', function () {
    var id = $(this).data('id');
    var url = $(this).data('url');
    $object=$(this);
    $.confirm({
        title: 'तपाईं मेटाउन चाहनुहुन्छ ?',
        autoClose: 'cancelAtion|6000',
        buttons: {
            deleteUser: {
                text: 'Delete',
                btnClass: 'btn-green',
                action: function () {
                    $.ajax ({
                        url: url,
                        type: 'DELETE',
                        dataType: "JSON",
                        beforeSend: function (xhr) {
                            var token = $('meta[name="csrf-token"]').attr('content');
                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },
                        data: {
                            "id": id,
                        },
                        success: function(response){
                            console.log(response);
                            $.alert('Deleted Successfully !');
                            location.reload(true);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                          }
                    });
                }
            },
            cancelAction: function () {
                $.alert('action is canceled');
            }
        }
    });

});

$(document).on('click','#restore', function () {
    var id = $(this).data('id');
    var url = $(this).data('url');
    // alert(url);
    $object=$(this);
    if (confirm(" के तपाई पुनर्स्थापना गर्न चाहनुहुन्छ ??")) {
        $.ajax ({
            url: url,
            type: 'PUT',
            dataType: "JSON",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');
                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
            data: {
                "id": id,
            },
            success: function(response){
                console.log(response);
                $($object).parents('tr').remove();
                alert('Successfully Restored!!');
            },
            error: function(xhr) {
                console.log(xhr.responseText); // this line will save you tons of hours while debugging
               // do something here because of error
            }
        });
    }
    else {

    }

});

$('.dropdown-click').on('click',function() {
    var value=$(this).attr('href');
            window.location.href = value;
    });

    function refreshPage() {
        setTimeout(function() {
            location.reload()
        }, 100);
    }
