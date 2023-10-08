<script>
    $('#actionForm').submit(function(e) {
        e.preventDefault();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log($(this).serialize());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        })
                        .then((result) => {
                            location.reload();
                        })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {

                    })
                }

            },
            error: function(error) {
                console.log(error);
            }
        });
    })
</script>
