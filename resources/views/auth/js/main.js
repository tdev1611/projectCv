// register

$(document).ready(function () {
    $("#registerForm").submit(function (e) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.success == true) {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {});
                }
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {});
            },
        });
    });

    // login
    $("#loginForm").submit(function (e) {
        e.preventDefault();
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.success == true) {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        let url = "http://localhost/back-end/Laravel-Pro/project/new-ismart";
                        location.href = url;
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {});
                }
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {});
            },
        });
    });
});
