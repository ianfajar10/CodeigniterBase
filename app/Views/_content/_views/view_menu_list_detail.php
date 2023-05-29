<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<?php foreach ($file as $row) : ?>
    <input type="hidden" id="file_id" value="<?= $params['id'] ?>">
    <!-- Card with an image on left -->
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><?= $row['name'] ? $row['name'] : '-' ?></h5>
                        </div>
                        <div>
                            <h5 class="card-title d-flex align-items-end flex-column fst-italic <?= $row['discount'] != '0' ? 'text-decoration-line-through' : '' ?>"><?= $row['price'] ? 'Rp' . number_format($row['price'], 0, ',', '.') : '-' ?></h5>
                            <?= $row['discount'] != '0' ? '<span class="badge bg-light text-dark fst-italic">' . 'Rp' . number_format($row['price'] - ($row['price'] * $row['discount']), 0, ',', '.') . '</span>' : '' ?>
                        </div>
                    </div>
                    <p class="card-text text-align: justify;"><?= $row['description'] ? $row['description'] : '-' ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="ratings">
                            <i class='<?= (count($like)/$rating*5 >= 1 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= (count($like)/$rating*5 >= 2 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= (count($like)/$rating*5 >= 3 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= (count($like)/$rating*5 >= 4 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= (count($like)/$rating*5 >= 5 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <?php if ($rating == 0) { ?>
                                <span class="fst-italic">(Belum ada penilaian)</span>
                            <?php } ?>
                        </div>
                        <?php if ($rating > 0) { ?>
                            <h5 class="review-count"><?= $rating ?> Penilaian</h5>
                        <?php } ?>
                    </div>
                    <div class="mt-3">
                        <button class="btn <?= count($like) > 0 ? 'btn-primary' : 'btn-outline-primary' ?>" type="button" onclick="handleLike('like')" <?= count($like) > 0 ? 'disabled' : '' ?>><i class="bi bi-hand-thumbs-up"></i> Suka</button>
                        <button class="btn <?= count($dislike) > 0 ? 'btn-primary' : 'btn-outline-primary' ?>" type="button" onclick="handleLike('dislike')" <?= count($dislike) > 0 ? 'disabled' : '' ?>><i class="bi bi-hand-thumbs-down"></i> Tidak Suka</button>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-add-cart" type="submit">Tambah</button>
                    </div>
                    <div class="row mt-3 div-spin-number visually-hidden">
                        <div class="col-8">
                            <input type="number" class="form-control btn-spin-number" step="1" min="0" value="0" data-numspin />
                        </div>
                        <div class="col-3 mt-1">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-outline-primary btn-submit-cart" type="submit"><i class="bi bi-check-lg"></i></button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-danger btn-delete-cart" type="submit"><i class="bi bi-x"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 div-value-spin-number visually-hidden">
                        <div class="col-8">
                            <input type="number" class="form-control value-spin-number" step="1" min="0" value="0" />
                        </div>
                        <div class="col-2">
                            <div>
                                <button class="btn btn-outline-danger btn-delete-value-cart" type="submit"><i class="bi bi-x-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="<?= base_url() . 'assets/self/function/js/view-menu-list-detail.js' ?>"></script>
<script>
    var user_id = $('#user_id').val();
    var base_url = $('#base_url').val();
    var file_id = $('#file_id').val();

    function handleLike($rate) {
        if (user_id) {
            console.log(user_id, file_id);

            $.ajax({
                type: "POST",
                url: base_url + ('menulist/rate_process'),
                data: {
                    'user_id': user_id,
                    'file_id': file_id,
                    'rate': $rate
                },
                beforeSend: function(xhr) {

                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Menilai..",
                            text: "Memberi Penilaian",
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

    // $(document).ready(function() {
    //     if (user_id && user_id !== 'admin') {
    //         $.ajax({
    //             type: "POST",
    //             url: base_url + ('order/check_new_user'),
    //             data: {
    //                 'user_id': user_id
    //             },
    //             success: function(response) {
    //                 if (response.success) {
    //                     $('#total_price').text('Rp' + (total - 10000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
    //                     is_new = true
    //                 } else {
    //                     $('#discount_baru').addClass('visually-hidden');
    //                     $('#total_price').text('Rp' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
    //                 }
    //             }
    //         });
    //     }
    // });
</script>
<?= $this->endSection() ?>