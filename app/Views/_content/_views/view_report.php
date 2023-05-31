<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <form action="<?= base_url('report/download') ?>" method="POST">
        <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Penjualan Hari Ini</button>
    </form>
</div>

<?= $this->endSection() ?>