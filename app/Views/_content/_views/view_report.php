<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <form action="<?= base_url('report/download_order') ?>" method="POST">
        <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Penjualan Hari Ini</button>
    </form>
    <br>
    <form action="<?= base_url('report/download_user') ?>" method="POST">
        <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Pengguna</button>
    </form>
</div>

<?= $this->endSection() ?>