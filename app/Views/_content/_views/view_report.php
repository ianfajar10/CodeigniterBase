<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Cetak Laporan Hari Ini ke PDF
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item" href="<?= site_url('report/printToPdf/user/') ?>">Laporan Data Pengguna</a></li>
                <li><a class="dropdown-item" href="<?= site_url('report/printToPdf/order/') ?>">Laporan Data Pemesanan</a></li>
                <li><a class="dropdown-item" href="<?= site_url('report/printToPdf') ?>">Laporan Data Produk Terjual</a></li>
            </ul>
        </div>
    </div>
    <!-- <span><a href="<?= site_url('report/printToPdf') ?>" target="_blank" class="btn btn-primary">Cetak Laporan ke PDF</a></span> -->
</div>

<script>
    $(document).ready(function() {
        console.log($app);
    });
</script>

<?= $this->endSection() ?>