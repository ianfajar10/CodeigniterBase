<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <h5>
        Review Pelanggan
    </h5>
    <div class="mt-2">
        <!-- List group with Advanced Contents -->
        <div class="list-group">
            <?= count($review) == 0 ? 'Belum ada review pelanggan yang masuk' : '' ?>
            <?php foreach ($review as $row) : ?>
                <a class="list-group-item list-group-item-action" aria-current="true">
                    <p class="mb-1"><?= $row['comment'] ?></p>
                    <small class="fw-bold"><?= $row['username'] ?>.</small>
                </a>
            <?php endforeach; ?>
        </div><!-- End List group Advanced Content -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#username").val($('#user_id').val());
    });
</script>

<?= $this->endSection() ?>