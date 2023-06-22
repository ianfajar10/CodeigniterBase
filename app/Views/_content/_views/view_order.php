<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>
<div class="row d-flex justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3">
                <h5 class="mb-0">Ada memiliki <?= $count_order ?> pemesanan</h5>
            </div>
            <div class="card-body">
                <div class="card mt-2">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">No</th> -->
                                    <th scope="col">Diproses</th>
                                    <th scope="col">Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- <th scope="col">No</th> -->
                                    <td scope="col">
                                        <ul class="list-group list-group-flush">
                                            <?php foreach ($file as $row) : ?>
                                                <li onclick="showOrder(<?= $row['id'] ?>)" class="list-group-item">
                                                    <span class="fs-6 fw-bold">No. Pesanan <?= $row['id'] ?></span>
                                                    <br>Waktu Pemesanan <?= $row['date'] ?><br>
                                                    <span class="fs-6 fw-bold <?= $row['discount'] ? '' : 'd-none' ?>">Diskon (Rp.<?= number_format(($row['discount']), 0, ',', '.') ?>)</span><br>
                                                    <span class="fst-italic fw-bold">Total Rp.<?= number_format(($row['total'] - $row['discount']), 0, ',', '.') ?></span>
                                                    <br><span class="fst-italic"><?= $row['status'] == "pesanan_belum_diproses" ? "Pesanan Belum Diproses" : ($row['status'] == "pesanan_sedang_diproses" ? "Pesanan Sedang Diproses" : "Pembayaran Diterima") ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td scope="col">
                                        <ul class="list-group list-group-flush">
                                            <?php foreach ($file2 as $row) : ?>
                                                <li onclick="showOrder(<?= $row['id'] ?>)" class="list-group-item">
                                                    <span class="fs-6 fw-bold">No. Pesanan <?= $row['id'] ?></span>
                                                    <br>Waktu Pemesanan <?= $row['date'] ?><br>
                                                    <span class="fs-6 fw-bold <?= $row['discount'] ? '' : 'd-none' ?>">Diskon (Rp.<?= number_format(($row['discount']), 0, ',', '.') ?>)</span><br>
                                                    <span class="fst-italic fw-bold">Total Rp.<?= number_format(($row['total'] - $row['discount']), 0, ',', '.') ?></span>
                                                    <br><span class="fst-italic"><?= $row['status'] == "pesanan_belum_diproses" ? "Pesanan Belum Diproses" : ($row['status'] == "pesanan_sedang_diproses" ? "Pesanan Sedang Diproses" : "Pembayaran Diterima") ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var user_id = $('#user_id').val();
    var base_url = $('#base_url').val();

    function showOrder($order_id) {
        window.location.href = base_url + 'order/detail/' + $order_id;
    }
</script>

<?= $this->endSection() ?>