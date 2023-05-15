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
                            <h5 class="card-title d-flex align-items-end flex-column fst-italic"><?= $row['price'] ? 'Rp' . number_format($row['price'], 0, ',', '.') : '-' ?></h5>
                        </div>
                    </div>
                    <p class="card-text text-align: justify;"><?= $row['description'] ? $row['description'] : '-' ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="ratings">
                            <i class='<?= ($rating >= 1 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 2 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 3 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 4 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 5 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <?php if ($rating == 0) { ?>
                                <span class="fst-italic">(Belum ada penilaian)</span>
                            <?php } ?>
                        </div>
                        <?php if ($rating > 0) { ?>
                            <h5 class="review-count">12 Reviews</h5>
                        <?php } ?>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-hand-thumbs-up"></i> Suka</button>
                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-hand-thumbs-down"></i> Tidak Suka</button>
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
<?= $this->endSection() ?>