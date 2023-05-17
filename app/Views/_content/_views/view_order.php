<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>
<div class="row d-flex justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h5 class="mb-0">Ada memiliki <?= $count_cart ?> pemesanan</h5>
            </div>
            <div class="card-body">
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
                            <button type="button" onclick="myFunction(<?= $row['file_id'] ?>)" class="btn btn-danger btn-md me-1 mb-2 btn-submit-cart" data-mdb-toggle="tooltip" title="Remove item">
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
                    <?php $total_item = $total_item + $row['quantity'] ?>
                    <?php $total_price = $total_price + ($row['price'] * $row['quantity']) ?>
                    <hr class="my-4" />
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    var user_id = $('#user_id').val();
    var base_url = $('#base_url').val();

    function myFunction($file_id) {
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
                            title: "Menupdate..",
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
</script>

<?= $this->endSection() ?>