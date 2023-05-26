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
                    <ul class="list-group list-group-flush">
                        <?php foreach ($file as $row) : ?>
                            <li onclick="showOrder(<?= $row['id'] ?>)" class="list-group-item">
                                <span class="fs-6 fw-bold">No. Pesanan <?= $row['id'] ?></span>
                                <br>Waktu Pemesanan <?= $row['date'] ?><br>
                                <span class="fs-6 fw-bold <?= $row['discount'] ? '' : 'd-none' ?>">Diskon (Rp.<?= number_format(($row['discount']), 0, ',', '.')?>)</span><br>
                                <span class="fst-italic fw-bold">Total Rp.<?= number_format(($row['total'] - $row['discount']), 0, ',', '.') ?></span>
                                <br><span class="fst-italic"><?= $row['status'] ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
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