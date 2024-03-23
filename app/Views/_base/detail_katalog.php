<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Floating Back Button */
        .back-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            background-color: #b68834;
            color: white;
        }

        .btn-submit-cart {
            background-color: #b68834;
            color: white;
        }
    </style>
</head>

<body>
    <a href="<?= base_url() . "katalog" ?>" class="btn back-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="container mt-5 mb-5">
        <?php foreach ($product as $row) : ?>
            <input type="hidden" id="product_id" value="<?= $row['id'] ?>">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url('../public/assets/images/' . $row['file']); ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title title"><?= $row['name'] ? $row['name'] : '-' ?></h5>
                            <p class="card-text" style="text-align: justify;"><?= $row['description'] ? $row['description'] : '-' ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title text-price" style="color: #b68834;"><?= $row['price'] ? 'Rp. ' . number_format($row['price'], 2, ',', '.') : '-' ?></h5>
                                <div class="input-group w-50">
                                    <input type="number" class="form-control" id="valSpinNumber" step="1" min="0" value="0" data-numspin>
                                    <div class="input-group-append">
                                        <button class="btn btn-submit-cart" type="submit"><i class="fas fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-submit-cart').click(function() {
                // Mengambil nilai produk dari input dan elemen terkait
                var productId = $('#product_id').val();
                var productName = $('.card-title.title').text().trim();
                var productPrice = $('.card-title.text-price').text().replace('Rp. ', '');
                var productQty = parseInt($('#valSpinNumber').val());

                let products = JSON.parse(localStorage.getItem('products')) || [];

                // Mengecek apakah produk sudah ada di dalam keranjang
                const existingProductIndex = products.findIndex(product => product.id === productId);

                if (existingProductIndex !== -1) {
                    // Jika produk sudah ada, update jumlahnya
                    const existingProduct = products[existingProductIndex];
                    const newQuantity = parseInt(existingProduct.quantity) + parseInt(productQty);
                    existingProduct.quantity = newQuantity.toString();
                    products[existingProductIndex] = existingProduct;
                } else {
                    // Jika produk belum ada, tambahkan produk baru
                    const product = {
                        id: productId,
                        name: productName,
                        price: productPrice,
                        quantity: productQty
                    };
                    products.push(product);
                }

                // Simpan array produk kembali ke localStorage
                localStorage.setItem('products', JSON.stringify(products));

                // Memberikan notifikasi atau tindakan lain setelah produk ditambahkan ke keranjang
                alert('Produk telah ditambahkan ke keranjang!');
            });
        });
    </script>
</body>

</html>