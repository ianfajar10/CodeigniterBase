// JS UNTUK VIEW: view_menu_list_detail
var base_url = $('#base_url').val();
var user_id = $('#user_id').val();
var file_id = $('#file_id').val();

$.ajax({
    type: "POST",
    url: base_url + ('menulist/detail_item_user'),
    data: {
        "user_id": user_id,
        "file_id": file_id
    },
    success: function (data) {
        if (data) {
            $(".btn-add-cart").hide();
            $(".div-value-spin-number").show();
            $(".value-spin-number").val(data.quantity);
            $(".value-spin-number").attr("disabled", true);
            $(".div-value-spin-number").removeClass('visually-hidden');
            $(".div-spin-number").hide();
        }
    }
});


$(".div-spin-number").hide();
$(".div-value-spin-number").hide();

$(".btn-add-cart").on("click", function () {
    $(".btn-add-cart").hide();
    $(".div-spin-number").removeClass('visually-hidden');
    $(".div-spin-number").show();
});

$(".btn-delete-cart").on("click", function () {
    $(".btn-add-cart").show();
    $(".div-spin-number").hide();
    $(".btn-spin-number").val(0);
});

$(".btn-submit-cart").on("click", function () {

    $(".div-value-spin-number").show();
    $(".value-spin-number").val($(".btn-spin-number").val());
    $(".value-spin-number").attr("disabled", true);

    if (user_id) {
        $(".div-value-spin-number").show();
        $(".value-spin-number").val($(".btn-spin-number").val());
        $(".value-spin-number").attr("disabled", true);

        $.ajax({
            type: "POST",
            url: base_url + ('cart/process'),
            data: {
                'user_id': user_id,
                'file_id': file_id,
                'quantity': $(".value-spin-number").val()
            },
            beforeSend: function (xhr) {

            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: "Menyimpan..",
                        text: "Menyimpan pesanan kedalam keranjang.",
                        timer: 2000,
                        showConfirmButton: false,
                        willOpen: function () {
                            Swal.showLoading()
                        }
                    }).then(function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            showConfirmButton: false,
                            text: response.msg,
                            timer: 2000,
                        }).then(function () {
                            location.reload();
                        })
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.msg,
                    })
                }

            }
        });
        $(".div-value-spin-number").removeClass('visually-hidden');
        $(".div-spin-number").hide();
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Maaf!',
            text: 'Harap masuk untuk melanjutkan!',
        })
    }
});

$(".btn-delete-value-cart").on("click", function () {
    $(".btn-add-cart").show();
    $(".div-value-spin-number").hide();
    $(".btn-spin-number").val(0);
});