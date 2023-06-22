<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div class="row mt-2 p-3">
    <div class="col-lg-12 margin-tb">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Nomor Pesanan</th>
                        <th scope="col">ID Pengguna</th>
                        <th scope="col">Total Item</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Harga Setelah Diskon</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 ?>
                    <?php foreach ($file as $row) : ?>
                        <tr>
                            <?php $no = $no + 1; ?>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['user_id']; ?></td>
                            <td><?= $row['total_item']; ?></td>
                            <td><?= $row['total_price']; ?></td>
                            <td><?= $row['discount'] ? $row['discount'] : '-'; ?></td>
                            <td><?= $row['price_after_diskon'] ? ($row['price_after_diskon'] < 0 ? 0 : $row['price_after_diskon']) : '-'; ?></td>
                            <td>
                                <select class="form-select" aria-label="Default select">
                                    <option <?= $row['status'] === '' ? 'selected' : '' ?> value="-">Pilih status</option>
                                    <option <?= $row['status'] === 'sudah_bayar' ? 'selected' : '' ?> value="<?= 'sudah_bayar' . '||' . $row['id'] ?>">Pembayaran Diterima</option>
                                    <option <?= $row['status'] === 'pesanan_sedang_diproses' ? 'selected' : '' ?> value="'pesanan_sedang_diproses' . '||' . $row['id'] ?>">Pesanan Sedang Diproses</option>
                                    <option <?= $row['status'] === 'pesanan_belum_diproses' ? 'selected' : '' ?> value="'pesanan_belum_diproses' . '||' . $row['id'] ?>">Pesanan Belum Diproses</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="6">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $no ?>" aria-expanded="false" aria-controls="flush-collapse<?= $no ?>">
                                                Detail Pesanan
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?= $no ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <ul>
                                                    <?php $array = (explode(",", $row['item'])); ?>
                                                    <?php foreach ($array as $row2 => $value) : ?>
                                                        <li><?= $value ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var base_url = $('#base_url').val();

    $(document).ready(function() {
        $('select').on('change', function() {
            if (this.value !== '-') {
                var value = this.value.split("||")
                var status = value[0]
                var order_id = value[1]
                $.ajax({
                    type: "POST",
                    url: base_url + ('order/update_status'),
                    data: {
                        'status': status,
                        'order_id': order_id
                    },
                    beforeSend: function(xhr) {

                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Memproses..",
                                text: "Mengubah status pembayaran",
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
        });
    });
</script>

<?= $this->endSection() ?>