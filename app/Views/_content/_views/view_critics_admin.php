<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <h5>
        Kritik & Saran
    </h5>
    <div class="mt-2">
        <!-- List group with Advanced Contents -->
        <div class="list-group">
            <?= count($critic) == 0 ? 'Belum ada kritik dan saran yang masuk' : '' ?>
            <?php foreach ($critic as $row) : ?>
                <a class="list-group-item list-group-item-action" aria-current="true">
                    <p class="mb-1"><?= $row['critic'] ?></p>
                    <small class="fw-bold"><?= $row['username'] ?>.</small>
                </a>
            <?php endforeach; ?>
        </div><!-- End List group Advanced Content -->
    </div>
</div>

<?= $this->endSection() ?>