<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <ul id="cartList" class="list-group"></ul>

    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="totalPrice" id="totalPrice">
                <div class="modal-body">
                    <form id="checkoutForm">
                        <div class="mb-3">
                            <label for="tableNumber" class="form-label">Nomor Meja</label>
                            <input type="number" class="form-control" id="tableNumber" placeholder="Masukkan nomor meja">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="checkout()">Checkout</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        const product = JSON.parse(localStorage.getItem('products'));

        function createCartItem(item) {
            // Menghitung subtotal
            const subtotal = (parseFloat(item.price.replace(",", "")) * parseInt(item.quantity)).toFixed(3); // Memastikan dua digit di belakang koma

            const li = document.createElement('li');
            li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');

            li.innerHTML = `
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">${item.name}</div>
                        <div class="col-md-2">
                            <form class="form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm mx-1 quantity-input" value="${item.quantity}" style="width: 40px;" readonly>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">${subtotal.toLocaleString()}</div> <!-- Menampilkan subtotal -->
                        <div class="col-md-1">
                            <button class="btn btn-danger btn-sm btn-remove" onclick="removeItem('${item.name}')"><i class="ti ti-trash"></i></button>
                        </div>
                    </div>
                </div>
            `;
            // li.innerHTML = `
            //     <div class="col-12">
            //         <div class="row">
            //             <div class="col-md-6">${item.name}</div>
            //             <div class="col-md-2">
            //                 <form class="form-inline">
            //                     <div class="input-group">
            //                         <button class="btn btn-outline-primary btn-sm btn-decrease" type="button">-</button>
            //                         <input type="text" class="form-control form-control-sm mx-1 quantity-input" value="${item.quantity}" style="width: 40px;" readonly>
            //                         <button class="btn btn-outline-primary btn-sm btn-increase" type="button">+</button>
            //                     </div>
            //                 </form>
            //             </div>
            //             <div class="col-md-2">${subtotal.toLocaleString()}</div> <!-- Menampilkan subtotal -->
            //             <div class="col-md-1">
            //                 <button class="btn btn-danger btn-sm btn-remove"><i class="ti ti-trash"></i></button>
            //             </div>
            //         </div>
            //     </div>
            // `;

            // Menambahkan event listener untuk tombol "+" dan "-"
            const increaseBtn = li.querySelector('.btn-increase');
            const decreaseBtn = li.querySelector('.btn-decrease');
            const quantityInput = li.querySelector('.quantity-input');

            if (increaseBtn && decreaseBtn && quantityInput) {
                increaseBtn.addEventListener('click', function() {
                    // Mengupdate nilai quantity saat tombol "+" diklik
                    item.quantity++;
                    quantityInput.value = item.quantity;
                });

                decreaseBtn.addEventListener('click', function() {
                    // Mengupdate nilai quantity saat tombol "-" diklik
                    if (item.quantity > 1) {
                        item.quantity--;
                        quantityInput.value = item.quantity;
                    }
                });
            }

            return li;
        }

        // Ambil elemen ul untuk menampilkan keranjang
        const cartList = document.getElementById('cartList');
        let total = 0; // Inisialisasi total

        // Looping data keranjang dan tampilkan di HTML
        product.forEach((item, index) => {
            const listItem = createCartItem(item);
            cartList.appendChild(listItem);

            // Tambahkan subtotal ke total
            total += parseFloat(item.price.replace(",", "")) * parseInt(item.quantity);
        });

        // Tampilkan total
        const totalElement = document.createElement('div');
        totalElement.classList.add('col-12', 'text-end', 'mt-3');
        totalElement.innerHTML = `
            <div class="col-12 mt-3">
                <button class="btn btn-primary btn-lg" onclick="showCheckoutModal()">Checkout ${total.toFixed(3).toLocaleString()}</button>
            </div>
        `;
        document.getElementById('totalPrice').value = total.toFixed(3).toLocaleString().replace(/[.,]/g, '');
        cartList.parentElement.appendChild(totalElement);
    });

    function showCheckoutModal() {
        const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        checkoutModal.show();
    }

    function checkout() {
        const products = JSON.parse(localStorage.getItem('products'));

        // Mengambil nilai nomor meja dari input
        const userId = $app.user.username;
        const tableNumber = document.getElementById('tableNumber').value;
        const totalPrice = document.getElementById('totalPrice').value;

        // Data yang akan dikirimkan melalui AJAX
        const formData = {
            tableNumber: tableNumber,
            userId: userId,
            totalPrice: totalPrice,
            products: products
        };

        // Kirim data menggunakan AJAX
        $.ajax({
            url: 'cart/store', // Ganti dengan URL endpoint Anda
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.msg,
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    // position: 'top',
                }).then((result) => {
                    localStorage.removeItem('products');

                    const checkoutModal = new bootstrap.Modal(document.getElementById('checkoutModal'));
                    checkoutModal.hide();

                    window.location.href = '<?= base_url('history') ?>';
                });
            },
            error: function(xhr, status, error) {
                // Handle kesalahan
                console.error(xhr.responseText);
            }
        });
    }

    function removeItem(itemName) {
        // Dapatkan data dari local storage
        let products = JSON.parse(localStorage.getItem('products')) || [];

        // Temukan indeks item yang ingin dihapus
        const index = products.findIndex(item => item.name === itemName); // Gantikan dengan cara Anda menyimpan data

        if (index !== -1) {
            // Hapus item dari array
            products.splice(index, 1);

            // Perbarui data dalam local storage
            localStorage.setItem('products', JSON.stringify(products));

            // Hapus elemen HTML
            const listItems = document.querySelectorAll('.list-group-item');
            listItems.forEach(item => {
                const itemNameElement = item.querySelector('.col-md-6');
                if (itemNameElement.textContent.trim() === itemName) {
                    item.remove();
                }
            });

            // Refresh halaman
            location.reload();
        }
    }
</script>

<?= $this->endSection() ?>