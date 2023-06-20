<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <h5>
        Kritik & Saran
    </h5>
    <div class="mt-2">
        <!-- List group with Advanced Contents -->
        <div class="list-group">
            <?= count($critic) == 0 ? 'Belum ada kritik dan saran yang masuk' : '' ?>
            <?php foreach ($critic as $row) : ?>
                <a class="list-group-item list-group-item-action" aria-current="true">
                    <p class="mb-1"><?= $row['critic'] ?></p>
                    <small class="fw-bold"><?= $row['username'] ?>.</small>
                </a>
            <?php endforeach; ?>
        </div><!-- End List group Advanced Content -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#username").val($('#user_id').val());
    });
    $("#ajax_form").validate({
        submitHandler: function(form) {
            $('#send_form').html('Mengirim..');
            $.ajax({
                url: "<?php echo base_url('critic/send') ?>",
                type: "POST",
                data: $('#ajax_form').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil..',
                            html: response.msg,
                            showConfirmButton: false,
                            timer: 3000
                        }).then((result) => {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal..',
                            html: response.msg,
                            showConfirmButton: true,
                            timer: 3000
                        }).then((result) => {})
                        $('#send_form').html('Kirim');
                    }
                }
            });
        }
    })
</script>

<?= $this->endSection() ?>