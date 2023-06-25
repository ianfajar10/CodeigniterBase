<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div class="row">
    <?php if (count($file) < 1) { ?>
        <div class="mb-2">
            <span class="fst-italic">Maaf, nama menu yang anda cari tidak ditemukan.</span>
        </div>
    <?php } ?>
    <?php if (isset($query)) { ?>
        <div class="mb-2">
            <span>Hasil pencarian untuk : <span class="fst-italic"><?= $query ?></span></span>
        </div>
    <?php } ?>
    <!-- Default Tabs -->
    <ul class="nav nav-tabs d-flex mb-3" id="myTabjustified" role="tablist">
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100 active" id="food-tab" data-bs-toggle="tab" data-bs-target="#food-justified" type="button" role="tab" aria-controls="food" aria-selected="true">Makanan</button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="drink-tab" data-bs-toggle="tab" data-bs-target="#drink-justified" type="button" role="tab" aria-controls="drink" aria-selected="false">Minuman</button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="bundling-tab" data-bs-toggle="tab" data-bs-target="#bundling-justified" type="button" role="tab" aria-controls="bundling" aria-selected="false">Bundling</button>
        </li>
    </ul>
    <div class="tab-content pt-12" id="myTabjustifiedContent">
        <div class="tab-pane fade show active" id="food-justified" role="tabpanel" aria-labelledby="food-tab">
            <div class="row">
                <?php foreach ($file2 as $row) : ?>
                    <div class="col-md-4">
                        <!-- Card with an image on top -->
                        <div class="card">
                            <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['name'] ? $row['name'] : '-' ?> <span class="badge bg-light text-dark <?= $row['discount'] != '0' ? '' : 'visually-hidden' ?>"><?= 'Diskon ' . $row['discount'] * 100 ?>%</span></span><span class="badge bg-danger text-white <?= $row['best'] != null ? '' : 'visually-hidden' ?>">Best Seller</span></h5>
                                <p class="card-text text-align: justify; text-justify: inter-word;"><?= $row['description'] ? (strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' :  $row['description']) : '-' ?></p>
                                <a class="btn btn-outline-primary float-end" href="<?php echo (base_url() . 'menulist/detail/' . $row['id']) ?>">Lihat Menu</a>
                            </div>
                        </div><!-- End Card with an image on top -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="drink-justified" role="tabpanel" aria-labelledby="drink-tab">
            <div class="row">
                <?php foreach ($file3 as $row) : ?>
                    <div class="col-md-4">
                        <!-- Card with an image on top -->
                        <div class="card">
                            <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['name'] ? $row['name'] : '-' ?> <span class="badge bg-light text-dark <?= $row['discount'] != '0' ? '' : 'visually-hidden' ?>"><?= 'Diskon ' . $row['discount'] * 100 ?>%</span></span><span class="badge bg-danger text-white <?= $row['best'] != null ? '' : 'visually-hidden' ?>">Best Seller</span></h5>
                                <p class="card-text text-align: justify; text-justify: inter-word;"><?= $row['description'] ? (strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' :  $row['description']) : '-' ?></p>
                                <a class="btn btn-outline-primary float-end" href="<?php echo (base_url() . 'menulist/detail/' . $row['id']) ?>">Lihat Menu</a>
                            </div>
                        </div><!-- End Card with an image on top -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="bundling-justified" role="tabpanel" aria-labelledby="bundling-tab">
            <div class="row">
                <?php foreach ($file4 as $row) : ?>
                    <div class="col-md-4">
                        <!-- Card with an image on top -->
                        <div class="card">
                            <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['name'] ? $row['name'] : '-' ?> <span class="badge bg-light text-dark <?= $row['discount'] != '0' ? '' : 'visually-hidden' ?>"><?= 'Diskon ' . $row['discount'] * 100 ?>%</span></span><span class="badge bg-danger text-white <?= $row['best'] != null ? '' : 'visually-hidden' ?>">Best Seller</span></h5>
                                <p class="card-text text-align: justify; text-justify: inter-word;"><?= $row['description'] ? (strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' :  $row['description']) : '-' ?></p>
                                <a class="btn btn-outline-primary float-end" href="<?php echo (base_url() . 'menulist/detail/' . $row['id']) ?>">Lihat Menu</a>
                            </div>
                        </div><!-- End Card with an image on top -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div><!-- End Default Tabs -->
</div>

<?= $this->endSection() ?>