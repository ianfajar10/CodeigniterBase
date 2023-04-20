<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div class="row">
    <?php foreach ($file as $row) : ?>
        <div class="col-md-4">
            <!-- Card with an image on top -->
            <div class="card">
                <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['name'] ? $row['name'] : '-' ?></h5>
                    <p class="card-text text-align: justify; text-justify: inter-word;"><?= $row['description'] ? (strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' :  $row['description']) : '-' ?></p>
                    <a class="btn btn-outline-primary float-end" href="<?php echo (base_url() . 'menulist/detail/' . $row['id']) ?>">Lihat</a>
                </div>
            </div><!-- End Card with an image on top -->
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>