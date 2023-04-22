<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12">
        <!-- Success Upload -->
        <?php if (!empty(session()->getFlashdata('berhasil'))) { ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('berhasil'); ?>
            </div>
        <?php } ?>

        <?php
        $errors = $validation->getErrors();
        if (!empty($errors)) {
            echo $validation->listErrors('list');
        }
        ?>
        <?= form_open_multipart(base_url('upload/process')); ?>
        <div class="row">
            <div class="col-md-3">
                <label>Nama</label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <label>Deskripsi</label>
                <div class="form-group">
                    <textarea type="text" name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <label>File</label>
                <div class="form-group">
                    <input type="file" name="file_upload" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <label>Aksi</label>
                <div class="form-group">
                    <?= form_submit('Send', 'Simpan') ?>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <table class="table table-bordered">
            <tr>
                <th>Aksi</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Tipe</th>
            </tr>
            <?php $no = 0 ?>
            <?php foreach ($file as $row) : ?>
                <tr>
                    <td><?= $no = $no + 1; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['description'] ? $row['description'] : '-' ?></td>
                    <td><img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" width="100"></td>
                    <td><?= $row['type']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?= $this->endSection() ?>