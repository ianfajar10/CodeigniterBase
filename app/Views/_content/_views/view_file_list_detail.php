<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<?php foreach ($file as $row) : ?>
    <!-- Card with an image on left -->
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['name'] ? $row['name'] : '-' ?></h5>
                    <p class="card-text text-align: justify;"><?= $row['description'] ? $row['description'] : '-' ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="ratings">
                            <i class='<?= ($rating >= 1 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 2 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 3 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 4 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                            <i class='<?= ($rating >= 5 ? 'fa-solid fa-star' : 'fa-regular fa-star') ?>' style='color:#62b1f6'></i>
                        </div>
                        <h5 class="review-count">12 Reviews</h5>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Card with an image on left -->
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>