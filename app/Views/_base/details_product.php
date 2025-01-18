<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php if (!empty($products)): ?>
    <?php foreach ($products as $product): ?>
      <title><?php echo $product->name ?></title>
    <?php endforeach; ?>
  <?php endif; ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <!-- Bagian Gambar Produk -->
      <div class="col-md-6">
        <img src="/public/assets/images/<?= $product->file ?>" alt="images" class="img-fluid">
      </div>
      <!-- Bagian Informasi Produk -->
      <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
          <div class="col-md-6">
            <h1><?= $product->name ?></h1>
            <h3 class="text-danger">Rp. <?= number_format($product->price, 0, ',', '.') ?></h3>
            <p><strong>Kategori:</strong> <?= $product->category_name ?></p>
            <p><strong>Tersedia:</strong> <?= $product->stock ?></p>
            <p><strong>Penjual:</strong> <?= $product->mitra_name ?></p>
            <p><?= $product->description ?></p>

            <!-- Pilihan Quantity dan Tombol -->
            <form action="../checkout" method="post">
              <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" class="form-control" name="quantity" value="1" min="1" max="<?= $product->stock ?>">
              </div>
              <input type="hidden" name="product_id" value="<?= $product->id ?>">
              <div class="row">
                <div class="col-md-6">
                  <a href="../" class="btn btn-danger btn-block">Batal</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary btn-block"
                    <?php if ($product->stock == 0) echo 'disabled'; ?>>
                    <?php echo ($product->stock == 0) ? 'Stok habis' : 'Tambah ke Keranjang'; ?>
                  </button>
                </div>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>