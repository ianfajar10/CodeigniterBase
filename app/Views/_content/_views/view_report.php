<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <form action="<?= base_url('report/download_order') ?>" method="POST">
        <button type="submit" class="btn" style="background-color: #E0CBB0"><i class="bi bi-download"></i> Download Data Penjualan Hari Ini</button>
    </form>
    <br>
    <form action="<?= base_url('report/download_user') ?>" method="POST">
        <button type="submit" class="btn" style="background-color: #E0CBB0"><i class="bi bi-download"></i> Download Data Pengguna</button>
    </form>
    <br>
    <form action="<?= base_url('report/download_critic') ?>" method="POST">
        <button type="submit" class="btn" style="background-color: #E0CBB0"><i class="bi bi-download"></i> Download Data Kritik & Saran</button>
    </form>
    <br>
    <form action="<?= base_url('report/download_review') ?>" method="POST">
        <button type="submit" class="btn" style="background-color: #E0CBB0"><i class="bi bi-download"></i> Download Data Review Pelanggan</button>
    </form>
</div>

<?= $this->endSection() ?>