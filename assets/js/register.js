var $submitButton = $("#submitButton");

$("#ajax_form").validate({
    submitHandler: function (form) {
        $('#send_form').html('Sending..');
        $.ajax({
            url: "auth/valid_register",
            type: "POST",
            data: $('#ajax_form').serialize(),
            dataType: "json",
            beforeSend: function () {
                $submitButton.find(".spinner-border").removeClass("d-none");
                $submitButton.find(".text-button").addClass("d-none");
                $submitButton.prop("disabled", true);
            },
            success: function (response) {
                $submitButton.find(".spinner-border").addClass("d-none");
                $submitButton.find(".text-button").removeClass("d-none");
                $submitButton.prop("disabled", false);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil..',
                        html: response.msg,
                        showConfirmButton: false,
                        timer: 3000
                    }).then((result) => {
                        window.location.href = "login";
                    })
                } else {
                    if (response.msg) {
                        let res = response.msg
                        const error = []
                        for (const [key, value] of Object.entries(res)) {
                            error.push(`<ol>${value}</ol>`)
                        }
                        let error_msg = error.join('')
                        Swal.fire({
                            icon: 'error',
                            title: 'Maaf..',
                            html: error_msg,
                            confirmButtonColor: '#5D87FF',
                            customClass: {
                                container: 'text-left' // Tambahkan kelas CSS 'text-left' untuk membuat pesan menjadi rata kiri
                            }
                        })
                    } else if (response.msg2) {
                        let res = response.msg2
                        let error_msg = res
                        Swal.fire({
                            icon: 'error',
                            title: 'Maaf..',
                            html: error_msg,
                            confirmButtonColor: '#5D87FF',
                            customClass: {
                                container: 'text-left' // Tambahkan kelas CSS 'text-left' untuk membuat pesan menjadi rata kiri
                            }
                        })
                    }
                    $('#send_form').html('Buat');
                }
            }
        });
    }
})