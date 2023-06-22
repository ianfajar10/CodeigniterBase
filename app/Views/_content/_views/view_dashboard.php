<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<?php $session = session() ?>

<div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">Hai, <?= $session->get('name'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Selamat, kamu berhak mendapatkan potongan sebesar Rp10.000 untuk pemesanan pertama!
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Slides with captions -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/banner.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div><!-- End Slides with captions -->
</div>
<script>
    var user_id = $('#user_id').val();
    var base_url = $('#base_url').val();
    $(document).ready(function() {
        if (user_id && user_id !== 'admin') {
            $.ajax({
                type: "POST",
                url: base_url + ('order/check_new_user'),
                data: {
                    'user_id': user_id
                },
                success: function(response) {
                    if (!response.success) {
                        $('#newUserModal').modal('show');
                    }
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>