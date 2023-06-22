<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <div class="row mb-3">
        <form action="<?= base_url('report/download_profit') ?>" method="POST">
            <div class="row mb-3">
                <label for="inputDate" class="col-sm-1 col-form-label">Periode</label>
                <div class="col-sm-3">
                    <input type="month" name="date_profit" class="form-control" required>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Pendapatan</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mb-3">
        <form action="<?= base_url('report/download_order') ?>" method="POST">
            <div class="row mb-3">
                <label for="inputDate" class="col-sm-1 col-form-label">Periode</label>
                <div class="col-sm-3">
                    <input type="month" name="date_order" value="" class="form-control" required>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Pesanan</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mb-3">
        <form action="<?= base_url('report/download_unlike_menu') ?>" method="POST">
            <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Menu Kurang Laris</button>
        </form>
    </div>
    <div class="row mb-3">
        <form action="<?= base_url('report/download_critic') ?>" method="POST">
            <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Kritik dan Saran</button>
        </form>
    </div>
    <div class="row mb-3">
        <form action="<?= base_url('report/download_user_loyal') ?>" method="POST">
            <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Download Data Pelanggan Terloyal</button>
        </form>
    </div>
</div>

<script>
</script>
<?= $this->endSection() ?>