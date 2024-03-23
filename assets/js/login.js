$(document).ready(function () {
    var base_url = $('#base_url').val();
    $("#loginForm").submit(function (event) {
        event.preventDefault();

        var usernameValue = $("#username").val().trim();
        var passwordValue = $("#password").val().trim();

        if (usernameValue === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Nama pengguna tidak boleh kosong.',
                timerProgressBar: true,
                confirmButtonColor: '#5D87FF',
                // position: 'top',
            });
        } else if (passwordValue === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Kata sandi tidak boleh kosong.',
                timerProgressBar: true,
                confirmButtonColor: '#5D87FF',
                // position: 'top',
            });
        } else {
            var $submitButton = $("#submitButton");

            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "auth/valid_login",
                data: formData,
                beforeSend: function () {
                    $submitButton.find(".spinner-border").removeClass("d-none");
                    $submitButton.find(".text-button").addClass("d-none");
                    $submitButton.prop("disabled", true);
                },
                success: function (response) {
                    if (response.success) {
                        setTimeout(function () {
                            $submitButton.find(".spinner-border").addClass("d-none");
                            $submitButton.find(".text-button").removeClass("d-none");
                            $submitButton.prop("disabled", false);

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.msg,
                                timer: 3000,
                                showConfirmButton: false,
                                confirmButtonColor: '#5D87FF',
                                timerProgressBar: true,
                                // position: 'top',
                            }).then((result) => {
                                localStorage.clear();
                                $.ajax({
                                    type: 'GET',
                                    url: 'auth/get_session',
                                    dataType: 'json',
                                    success: function (data) {
                                        localStorage.setItem('user', JSON.stringify(data));
                                        // Set timeout sebelum reload halaman dashboard
                                        setTimeout(function () {
                                            window.location.href = base_url + 'core';
                                        }, 50); // Ganti nilai timeout sesuai kebutuhan
                                    },
                                    error: function () {
                                        console.log('Error fetching session data.');
                                    },
                                });
                            });
                        }, 650);
                        
                    } else {
                        setTimeout(function () {
                            $submitButton.find(".spinner-border").addClass("d-none");
                            $submitButton.find(".text-button").removeClass("d-none");
                            $submitButton.prop("disabled", false);

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.msg,
                                timerProgressBar: true,
                                confirmButtonColor: '#5D87FF',
                                // position: 'top',
                            });
                        }, 1000);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
                complete: function (response) {}
            });
        }
    });
});