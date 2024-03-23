<?php $session = session() ?>
<!-- <?php print_r($product) ?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milestone Coffee - Katalog</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/1.35.0/iconfont/tabler-icons.min.css" integrity="sha512-tpsEzNMLQS7w9imFSjbEOHdZav3/aObSESAL1y5jyJDoICFF2YwEdAHOPdOr1t+h8hTzar0flphxR76pd0V1zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            font-weight: bold;
        }

        .btn-floating {
            background-color: #b68834;
        }

        .notification {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .text-divider {
            display: flex;
            align-items: center;
        }

        .text-divider::before,
        .text-divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ccc;
            /* Warna dan gaya garis */
        }

        .text-divider::before {
            margin-right: 0.5rem;
            /* Jarak antara garis dengan teks */
        }

        .text-divider::after {
            margin-left: 0.5rem;
            /* Jarak antara garis dengan teks */
        }

        .btn-outline-custom {
            color: #b68834;
            border-color: #b68834;
        }

        .btn-outline-custom:hover {
            background-color: #b68834;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="form-container">
            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col">
                    <form class="d-flex" action="<?= base_url('katalog/search') ?>" method="post">
                        <input class="form-control me-2" type="search" name="search_query" placeholder="Ketik menu yang dicari.." aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Cari</button>
                    </form>
                </div>
            </div>

            <div class="text-divider">
                <span>Atau</span>
            </div>

            <div class="col mt-3">
                <div class="col-12">
                    <form action="<?= base_url('katalog/search') ?>" method="post">
                        <input type="hidden" name="filterValue" id="filterValue">
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle w-100" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-filter me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"></path>
                                </svg>
                                Filter
                            </button>

                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                                <li><button class="dropdown-item w-100" type="submit" name="filterValue" value="">Semua</button></li>
                                <li><button class="dropdown-item w-100" type="submit" name="filterValue" value="F">Makanan</button></li>
                                <li><button class="dropdown-item w-100" type="submit" name="filterValue" value="D">Minuman</button></li>
                                <li><button class="dropdown-item w-100" type="submit" name="filterValue" value="O">Lainnya</button></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container mt-4">

            <?php if (count($product) < 1) { ?>
                <div class="mb-2">
                    <span class="fst-italic">Maaf, nama menu yang anda cari tidak ditemukan.</span>
                </div>
            <?php } ?>
            <?php if (isset($query) && $query != '') { ?>
                <div class="mb-2">
                    <span>Hasil pencarian untuk : <span class="fst-italic"><?= $query ?></span></span>
                </div>
            <?php } ?>

            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php foreach ($product as $item) : ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?= base_url('../public/assets/images/' . $item['file']) ?>" class="card-img-top" alt="...">
                            <div class="card-body" data-id="<?= $item['id'] ?>">
                                <h5 class="card-title"><?= $item['name'] ?></h5>
                                <p class="text-justify" style="text-align: justify"><?= strlen($item['description']) > 200 ? substr($item['description'], 0, 200) . '...' : $item['description']; ?><span><a href="<?= base_url('katalog/detail/' . $item['id']) ?>" class="mt-0" style="text-decoration: none; color: #b68834"> Lihat detail</a></span></p>
                                <div class="row">
                                    <div class="col text-start">
                                        <a href="#" class="btn" style="background-color: #b68834; color:#fff">Rp. <?= number_format($item['price'], 2, ',', '.') ?></a>
                                    </div>
                                    <div class="col text-end">
                                        <button class="btn btn-outline-custom" onclick="showQtyInput(this)">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-hexagon-plus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M13.666 1.429l6.75 3.98l.096 .063l.093 .078l.106 .074a3.22 3.22 0 0 1 1.284 2.39l.005 .204v7.284c0 1.175 -.643 2.256 -1.623 2.793l-6.804 4.302c-.98 .538 -2.166 .538 -3.2 -.032l-6.695 -4.237a3.23 3.23 0 0 1 -1.678 -2.826v-7.285c0 -1.106 .57 -2.128 1.476 -2.705l6.95 -4.098c1 -.552 2.214 -.552 3.24 .015m-1.666 6.571a1 1 0 0 0 -1 1v2h-2a1 1 0 0 0 -.993 .883l-.007 .117a1 1 0 0 0 1 1h2v2a1 1 0 0 0 .883 .993l.117 .007a1 1 0 0 0 1 -1v-2h2a1 1 0 0 0 .993 -.883l.007 -.117a1 1 0 0 0 -1 -1h-2v-2a1 1 0 0 0 -.883 -.993z" />
                                                </svg>
                                            </span>
                                            Tambah
                                        </button>
                                        <div class="d-none qty-input">
                                            <input type="number" class="form-control" placeholder="Qty" />
                                            <button class="btn btn-success btn-sm mt-1" onclick="addToLocalStorage(this)">Tambahkan ke Keranjang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <a href="<?= base_url('cart') ?>" class="btn-floating rounded-circle position-fixed bottom-0 end-0 p-3 me-3 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="ti ti-shopping-cart" viewBox="0 0 16 16">
            <path d="M4.5 14a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM0 1h1l.81 2.893L3.875 9.11a.5.5 0 0 0 .485.364h7.68a.5.5 0 0 0 .485-.364l1.063-5.217H3.107l-.152-.727a1.5 1.5 0 0 0-1.453-1.073H0V1zm4.441 12h7.118l-1 4H5.39z" />
        </svg>
        <!-- <span class="notification">1</span> -->
    </a>
</body>

<script>
    function showQtyInput(button) {
        // Menampilkan input untuk kuantitas setelah mengklik tombol "Tambah"
        const qtyInput = button.nextElementSibling;
        qtyInput.classList.remove('d-none');
        button.classList.add('d-none'); // Menyembunyikan tombol "Tambah"
    }

    function addToLocalStorage(button) {
        // Mendapatkan data produk dari card
        const card = button.closest('.card-body');
        const productId = card.dataset.id;
        const productName = card.querySelector('.card-title').innerText;
        const productPrice = card.querySelector('.btn').innerText.replace('Rp. ', '');
        const productQty = card.querySelector('.qty-input input').value;
        const productQtyInput = card.querySelector('.qty-input input');

        if (productQty.trim() === '') {
            alert('Silakan isi jumlah produk.');
            return;
        }

        // Mendapatkan data produk yang sudah ada dari localStorage
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

        // Menonaktifkan input jumlah produk setelah ditambahkan
        productQtyInput.disabled = true;
    }
</script>

</html>