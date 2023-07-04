<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div class="row">
    <?php if (count($user) < 1) { ?>
        <div class="mb-2">
            <span class="fst-italic">Data pelanggan kosong.</span>
        </div>
    <?php } ?>
    <div class="col-lg-12 margin-tb">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Waktu Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $row) : ?>
                        <tr>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['birth']; ?></td>
                            <td><?= $row['telp']; ?></td>
                            <td><?= $row['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>