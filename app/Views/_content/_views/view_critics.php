<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <h5>
        Kritik & Saran
    </h5>
    <!-- Floating Labels Form -->
    <form class="row g-3" id="ajax_form">
        <input type="text" class="form-control" name="username" id="username" hidden>
        <div class="col-md-12">
            <div class="form-group">
                <textarea rows="5" type="text" name="critic" class="form-control" placeholder="Masukkan kritik dan saran anda disini.."></textarea>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" id="send_form">Kirim</button>
        </div>
    </form>
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