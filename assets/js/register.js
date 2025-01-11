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
});

$('#provinsi').on('change', function () {
    const provinsiId = $(this).val();
    const kabupatenSelect = $('#kabupaten');

    if (provinsiId) {
        kabupatenSelect.prop('disabled', true).html('<option value="">Loading...</option>');

        $.post('/auth/getKabupaten', { provinsiId: provinsiId }, function (data) {
            kabupatenSelect.prop('disabled', false).html('<option value="">Pilih Kabupaten/Kota</option>');
            data.forEach(function (kabupaten) {
                kabupatenSelect.append(`<option value="${kabupaten.id}">${kabupaten.name}</option>`);
            });
        }).fail(function () {
            kabupatenSelect.prop('disabled', false).html('<option value="">Terjadi kesalahan</option>');
        });
    } else {
        kabupatenSelect.prop('disabled', true).html('<option value="">Pilih Kabupaten/Kota</option>');
    }
});

$('#kabupaten').on('change', function () {
    const kabupatenId = $(this).val();
    const kecamatanSelect = $('#kecamatan');

    kecamatanSelect.html('<option value="">Loading...</option>').prop('disabled', true);

    if (kabupatenId) {
        $.post('/auth/getKecamatan', { kabupatenId }, function (data) {
            kecamatanSelect.html('<option value="">Pilih Kecamatan</option>').prop('disabled', false);
            data.forEach(function (kecamatan) {
                kecamatanSelect.append(`<option value="${kecamatan.id}">${kecamatan.name}</option>`);
            });
        }).fail(function () {
            kecamatanSelect.html('<option value="">Terjadi kesalahan</option>').prop('disabled', false);
        });
    } else {
        kecamatanSelect.html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
    }
});

$('#telepon').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

$('#rekening').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});
