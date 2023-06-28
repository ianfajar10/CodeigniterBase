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
        <?= form_open_multipart(base_url('upload/banner_process')); ?>
        <div class="row">
            <div class="col-md-12">
                <label>Foto</label>
                <div class="form-group">
                    <input type="file" name="file_upload" class="form-control">
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
<script>
    var base_url = $('#base_url').val();

    function deleteItem($file_id) {
        $.ajax({
            type: "POST",
            url: base_url + ('upload/delete_file'),
            data: {
                'file_id': $file_id
            },
            beforeSend: function(xhr) {

            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Menghapus..",
                        text: "Menghapus menu",
                        timer: 2000,
                        showConfirmButton: false,
                        willOpen: function() {
                            Swal.showLoading()
                        }
                    }).then(function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            showConfirmButton: false,
                            text: response.msg,
                            timer: 2000,
                        }).then(function() {
                            location.reload();
                        })
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.msg,
                    })
                }

            }
        });
    }
</script>
<?= $this->endSection() ?>