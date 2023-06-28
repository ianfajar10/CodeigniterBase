<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<?php $session = session() ?>

<?php foreach ($file as $row) : ?>
    <input type="hidden" id="file_id" value="<?= $params['id'] ?>">
    <input type="hidden" id="name" value="<?= $row['name'] ?>">
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
                            <?= $row['discount'] != '0' ? '<span class="badge text-dark fst-italic" style="background-color: #E0CBB0">' . 'Rp' . number_format($row['price'] - ($row['price'] * $row['discount']), 0, ',', '.') . '</span>' : '' ?>
                        </div>
                    </div>
                    <p class="card-text text-align: justify;"><?= $row['description'] ? explode('||', $row['description'])[0] : '-' ?></p>
                    <h5 class="mt-2">Bahan</h5>
                    <p><?= $row['description'] ? explode('||', $row['description'])[1] : '-' ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="ratings">
                            <?php if (count($rating) == 0) { ?>
                                <span class="fst-italic">(Belum ada penilaian)</span>
                            <?php } else { ?>
                                <i class='<?= (count($like) / count($rating) * 5 >= 1 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                                <i class='<?= (count($like) / count($rating) * 5 >= 2 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                                <i class='<?= (count($like) / count($rating) * 5 >= 3 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                                <i class='<?= (count($like) / count($rating) * 5 >= 4 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                                <i class='<?= (count($like) / count($rating) * 5 >= 5 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <?php } ?>
                        </div>
                        <?php if (count($rating) > 0) { ?>
                            <h5 class="review-count"><?= count($rating) ?> Penilaian</h5>
                        <?php } ?>
                    </div>
                    <div class="row mt-2 <?= str_contains($row['name'], '(Hot & Ice)') ? '' : 'visually-hidden' ?>" id="variantCheck">
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input .disabled" name="variant" type="checkbox" id="chekVariant" value="y">
                                <label class="form-check-label fw-bold" for="chekFood">Variasi Dingin?</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 <?= ($session->get('username') == 'admin' ? 'visually-hidden' : '') ?>">
                        <button class="btn btn-outline-primary btn-add-cart" type="submit"><i class="bi bi-cart"></i> Tambah ke Keranjang</button>
                    </div>
                    <div class="mt-3 <?= ($session->get('username') == 'admin' ? 'visually-hidden' : '') ?>">
                        <button class="btn <?= count($check_like) > 0 ? 'btn-primary' : 'btn-outline-primary' ?>" type="button" onclick="handleLike('like')" <?= count($check_like) > 0 ? 'disabled' : '' ?>><i class="bi bi-hand-thumbs-up"></i> Suka</button>
                        <button class="btn <?= count($check_dislike) > 0 ? 'btn-primary' : 'btn-outline-primary' ?>" type="button" onclick="handleLike('dislike')" <?= count($check_dislike) > 0 ? 'disabled' : '' ?>><i class="bi bi-hand-thumbs-down"></i> Tidak Suka</button>
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
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Komentar</h5>
                            <div class="form-floating mb-3 mt-3 <?= count($check_comment) == 0 ? (count($check_like) > 0 || count($check_dislike) > 0 ? '' : 'visually-hidden') : 'visually-hidden' ?>">
                                <textarea class="form-control" placeholder="Leave a comment here" id="comments" value="" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Masukkan komentar disini..</label>
                                <button type="button" onclick="handleKirim()" class="btn btn-primary mt-2">Kirim</button>
                            </div>
                            <div class="mt-2">
                                <!-- List group with Advanced Contents -->
                                <div class="list-group">
                                    <?= count($comment) == 0 ? 'Belum ada komentar' : '' ?>
                                    <?php foreach ($comment as $row2) : ?>
                                        <a class="list-group-item list-group-item-action" aria-current="true">
                                            <p class="mb-1"><?= $row2['comment'] ?></p>
                                            <small class="fw-bold"><?= $row2['user_id'] ?>.</small>
                                        </a>
                                    <?php endforeach; ?>
                                </div><!-- End List group Advanced Content -->
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

    function handleKirim() {
        if (user_id) {

            $.ajax({
                type: "POST",
                url: base_url + ('menulist/comment_process'),
                data: {
                    'user_id': user_id,
                    'file_id': file_id,
                    'comment': $('#comments').val()
                },
                beforeSend: function(xhr) {

                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Mengkomentari..",
                            text: "Memberi Komentar",
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