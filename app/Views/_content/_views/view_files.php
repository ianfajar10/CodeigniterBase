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
        <?php } else if (!empty(session()->getFlashdata('gagal'))) { ?>
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('gagal'); ?>
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
            <div class="col-md-6">
                <label>Nama</label>
                <div class="form-group">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <label>File</label>
                <div class="form-group">
                    <input type="file" name="file_upload" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>Deskripsi</label>
                <div class="form-group">
                    <textarea type="text" name="description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <?= form_submit('Send', 'Simpan') ?>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<div class="row mt-2 p-3">
    <div class="card" style="border-radius: 0.4em">
        <div class="card-body">
            <div class="col-lg-12 margin-tb">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Tipe</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>