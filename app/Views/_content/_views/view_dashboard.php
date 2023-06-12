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
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="height:fit-content; background-color:black;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url() . 'assets/img/slides-1.jpeg' ?>" class="d-block w-100" alt="..." style="height: 350px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() . 'assets/img/slides-2.jpeg' ?>" class="d-block w-100" alt="..." style="height: 350px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() . 'assets/img/slides-3.jpeg' ?>" class="d-block w-100" alt="..." style="height: 350px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="<?= base_url() . 'assets/img/slides-4.jpeg' ?>" class="d-block w-100" alt="..." style="height: 350px; object-fit: contain;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
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