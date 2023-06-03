<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div class="row">
    <?php if (count($user) < 1) { ?>
        <div class="mb-2">
            <span class="fst-italic">Data kritik & saran kosong.</span>
        </div>
    <?php } ?>
    <div class="col-lg-12 margin-tb">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Komentar</th>
                        <th scope="col">Waktu Ditulis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $row) : ?>
                        <tr>
                            <td><?= $row['menu_name']; ?></td>
                            <td><?= $row['user_id']; ?></td>
                            <td><?= $row['comment']; ?></td>
                            <td><?= $row['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>