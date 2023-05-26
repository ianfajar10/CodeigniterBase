<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div class="row mt-2 p-3">
    <div class="col-lg-12 margin-tb">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Harga Setelah Diskon</th>
                        <th scope="col">Besar Diskon (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($file as $row) : ?>
                        <tr>
                            <td><?= $row['name']; ?></td>
                            <td><img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" width="100"></td>
                            <td>Rp<?= number_format($row['price'], 0, ',', '.'); ?></td>
                            <td><?= $row['discount'] ? $row['discount'] . '%' : '-'; ?></td>
                            <td>Rp<?= number_format($row['after_discount'], 0, ',', '.'); ?></td>
                            <td>
                                <select class="form-select" aria-label="Default select">
                                    <option <?= $row['discount'] ? '' : 'selected' ?>>Pilih besar diskon (%)</option>
                                    <?php foreach ($discount as $row2) : ?>
                                        <option <?= $row['discount'] == $row2['label'] ? 'selected' : '' ?> value="<?= $row2['value'] . '||' . $row['id'] ?>"><?= $row2['label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
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
            var value = this.value.split("||")
            var discount = value[0]
            var file_id = value[1]
            $.ajax({
                type: "POST",
                url: base_url + ('discount/process'),
                data: {
                    'file_id': file_id,
                    'discount': discount
                },
                beforeSend: function(xhr) {

                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Memproses..",
                            text: "Menambahkan diskon pada menu",
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
        });
    });
</script>

<?= $this->endSection() ?>