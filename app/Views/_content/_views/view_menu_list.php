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
                    <p class="card-text"><?= $row['description'] ? $row['description'] : '-' ?></p>
                </div>
            </div><!-- End Card with an image on top -->
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>