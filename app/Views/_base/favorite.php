<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Barang Favorit</title>
  <!-- Link CSS Bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-fixed-size {
      width: 100%;
      height: 500px;
      display: flex;
      flex-direction: column;
    }

    .card-img-top {
      object-fit: cover;
      height: 300px;
    }

    .card-title {
      font-size: 1.2rem;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }

    .card-text {
      font-size: 1rem;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }

    .card-body {
      display: flex;
      flex-direction: column;
      /* Menyusun elemen-elemen di dalam card secara vertikal */
      justify-content: space-between;
      height: 200px;
      /* Tentukan tinggi body card sesuai kebutuhan */
    }

    .card-body h5,
    .card-body p {
      margin-bottom: 10px;
    }

    .d-flex {
      margin-top: 10px;
      /* Memberikan jarak antara teks dan tombol */
    }

    .d-flex .btn {
      width: 48%;
      /* Tombol memiliki lebar sekitar setengah dari lebar kontainer */
    }

    .d-flex .btn-hapus {
      margin-left: 4%;
      /* Memberikan jarak antara tombol Hapus dan tombol Lihat Detail */
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2>Daftar Barang Favorit</h2>

    <?php if (!empty($products_fav)): ?>
      <div class="row">
        <?php foreach ($products_fav as $product): ?>
          <div class="col-md-4 mb-4" id="card-<?= $product->id ?>">
            <div class="card card-fixed-size">
              <img src="/public/assets/images/<?= $product->file ?>" class="card-img-top" alt="<?= $product->name ?>">
              <div class="card-body">
                <h5 class="card-title"><?= $product->name ?></h5>
                <p class="card-text">Harga: Rp <?= number_format($product->price, 0, ',', '.') ?></p>
                <!-- Menambahkan div untuk tombol-tombol -->
                <div class="d-flex justify-content-between">
                  <a href="/home/details/<?= $product->id ?>" class="btn btn-primary">Lihat Detail</a>
                  <button class="btn btn-danger btn-hapus" data-id="<?= $product->id ?>">Hapus</button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p>Belum ada barang favorit.</p>
    <?php endif; ?>
  </div>

  </div>

  <!-- Script JS Bootstrap -->
  <script src="../assets/home/ogani/js/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {

      $('.btn-hapus').click(function() {
        const productId = $(this).data('id');
        const cardElement = $('#card-' + productId);


        if (confirm('Apakah Anda yakin ingin menghapus barang favorit ini?')) {

          $.ajax({
            url: '/home/love',
            type: 'POST',
            data: {
              product_id: productId
            },
            success: function(response) {
              console.log(response);
              if (response.status == 'success') {
                cardElement.remove();
                alert('Barang berhasil dihapus dari favorit.');
              } else {
                alert('Gagal menghapus barang.');
              }
            },
            error: function(xhr, status, error) {
              console.error(error);
              alert('Terjadi kesalahan, coba lagi nanti.');
            }
          });
        }
      });
    });
  </script>

</body>

</html>