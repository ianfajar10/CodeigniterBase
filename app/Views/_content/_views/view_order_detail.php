<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>
<div class="row d-flex justify-content-center">
    <div class="col-md-12">
        <div class="text-center">No. Pesanan <span class="fw-bold"><?= $params['order_id'] ?></span></div>
        <div class="card mt-2">
            <ul class="list-group list-group-flush">
                <?php foreach ($file as $row) : ?>
                    <li class="list-group-item"><span class="fs-6 fw-bold"><?= $row['name'] ?></span><br>Jumlah Item <?= $row['quantity'] ?><br><span class="fst-italic fw-bold">Total Rp.<?= number_format(($row['price'] * $row['quantity']), 0, ',', '.') ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<script>
    var user_id = $('#user_id').val();
    var base_url = $('#base_url').val();
</script>

<?= $this->endSection() ?>