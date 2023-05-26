<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>
<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h5 class="mb-0">Ada memiliki <?= $count_cart ?> item pada keranjang</h5>
            </div>
            <div class="card-body">
                <?php $item = array() ?>
                <?php $quantity = array() ?>
                <?php $price = array() ?>
                <?php $total_item = 0 ?>
                <?php $total_price = 0 ?>
                <!-- Single item -->
                <?php foreach ($file as $row) : ?>
                    <div class="row">
                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                            <!-- Image -->
                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="w-100" alt="<?= $row['name'] ?>" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                </a>
                            </div>
                            <!-- Image -->
                        </div>

                        <div class="col-lg-5 col-md-5 mb-4 mb-lg-0">
                            <!-- Data -->
                            <p><strong><?= $row['name'] ? $row['name'] : '-' ?></strong></p>
                            <button type="button" onclick="deleteItem(<?= $row['file_id'] ?>)" class="btn btn-danger btn-md me-1 mb-2 btn-submit-cart" data-mdb-toggle="tooltip" title="Remove item">
                                <i class="fas fa-trash"></i>
                            </button>
                            <!-- Data -->
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                            <!-- Quantity -->
                            <div class="d-flex mb-4" style="max-width: 300px">

                                <div class="form-outline">
                                    <input id="form1" min="0" name="quantity" value="<?= $row['quantity'] ?>" type="number" class="form-control" disabled />
                                    <label class="form-label" for="form1">Jumlah</label>
                                </div>

                            </div>
                            <!-- Quantity -->

                            <!-- Price -->
                            <p class="text-start text-md-center">
                                <strong>Rp <?= number_format(($row['price'] * $row['quantity']), 0, ',', '.'); ?></strong>
                            </p>
                            <!-- Price -->
                        </div>
                    </div>
                    <!-- Single item -->
                    <?php array_push($item, $row['file_id']) ?>
                    <?php array_push($quantity, $row['quantity']) ?>
                    <?php array_push($price, $row['price']) ?>
                    <?php $total_item = $total_item + $row['quantity'] ?>
                    <?php $total_price = $total_price + ($row['price'] * $row['quantity']) ?>
                    <hr class="my-4" />
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4 <?= $total_item === 0 ? 'visually-hidden' : '' ?>">
            <div class="card-header py-3">
                <h5 class="mb-0">Rincian Pemesanan</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Total Produk
                        <span><?= $total_item ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Total Harga
                        <span>Rp<?= number_format($total_price, 0, ',', '.') ?></span>
                    </li>
                    <li id="discount_baru" class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Diskon Pengguna Baru
                        <span>Rp10.000</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                            <strong>Total Bayar</strong>
                        </div>
                        <span><strong id="total_price"></strong></span>
                    </li>
                </ul>
                <input id="no_order" type="text" value="<?= date("Ymdhis") ?>" hidden>
                <input id="total" type="text" value="<?= $total_price ?>" hidden>

                <button type="button" onclick="confirmOrder($item = [<?= implode(', ', $item) ?>], $quantity = [<?= implode(', ', $quantity) ?>], $price = [<?= implode(', ', $price) ?>])" class="btn btn-primary btn-lg btn-block <?= $total_price === null ? 'visually-hidden' : '' ?>">
                    Lanjut Pesan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var user_id = $('#user_id').val();
    var base_url = $('#base_url').val();
    var no_order = $('#no_order').val();
    var total = $('#total').val();
    var is_new = false;

    function deleteItem($file_id) {
        if (user_id) {

            $.ajax({
                type: "POST",
                url: base_url + ('cart/process'),
                data: {
                    'user_id': user_id,
                    'file_id': $file_id,
                    'quantity': 0
                },
                beforeSend: function(xhr) {

                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Mengupdate..",
                            text: "Mengupdate pesanan",
                            timer: 2000,
                            showConfirmButton: false,
                            willOpen: function() {
                                Swal.showLoading()
                            }
                        }).then(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                showConfirmButton: false,
                                text: response.msg,
                                timer: 2000,
                            }).then(function() {
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
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Maaf!',
                text: 'Harap masuk untuk melanjutkan!',
            })
        }
    }

    function confirmOrder($item, $quantity, $price) {
        if (user_id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda yakin untuk memproses pesanan? Anda tidak dapat mengubah pesanan kembali setelah proses ini.",
                showCancelButton: true,
                confirmButtonText: 'Ya, Yakin',
                cancelButtonText: `Batal`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + ('order/process'),
                        data: {
                            'no_order': no_order,
                            'user_id': user_id,
                            'total': total,
                            'status': 'menunggu_pembayaran',
                            'item': $item,
                            'quantity': $quantity,
                            'price': $price,
                            'is_new': is_new
                        },
                        beforeSend: function(xhr) {

                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Menyimpan..",
                                    text: "Menyimpan pesanan",
                                    timer: 2000,
                                    showConfirmButton: false,
                                    willOpen: function() {
                                        Swal.showLoading()
                                    }
                                }).then(function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        showConfirmButton: false,
                                        text: response.msg,
                                        timer: 2000,
                                    }).then(function() {
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
                    })
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Maaf!',
                text: 'Harap masuk untuk melanjutkan!',
            })
        }
    }

    $(document).ready(function() {
        if (user_id && user_id !== 'admin') {
            $.ajax({
                type: "POST",
                url: base_url + ('order/check_new_user'),
                data: {
                    'user_id': user_id
                },
                success: function(response) {
                    if (response.success) {
                        $('#total_price').text('Rp' + (total - 10000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                        is_new = true
                    } else {
                        $('#discount_baru').addClass('visually-hidden');
                        $('#total_price').text('Rp' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
                    }
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>