<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="../assets/css/extend-custom-datatables.min.css" />
<style>

  .star-rating input {
      display: none; /* Menyembunyikan input radio */
  }

  .star-rating label {
      font-size: 30px;
      color: #ccc; /* Warna default (abu-abu) untuk bintang */
      cursor: pointer;
  }

  .star-rating input:checked ~ label,
  .star-rating label:hover,
  .star-rating label:hover ~ label {
      color: #f39c12; /* Warna bintang aktif (emas) */
  }

</style>
<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pesanan Diterima</h5>
      </div>
      <div class="modal-body">
        <div id='formConfirmation'>
          Apakah Anda yakin sudah menerima produk yang dipesan?
          <div class="form-check">
            <input class="form-check-input" type="radio" name="receiveProduct" id="yesRadio" value="yes">
            <label class="form-check-label" for="yesRadio">Ya</label>
          </div>
        </div>

        <!-- Form penilaian dengan bintang, awalnya disembunyikan -->
        <!-- Form penilaian dengan bintang -->
        <div id="ratingForm" class="d-none mt-3">
          <label for="rating">Penilaian Produk:</label>
          <div id="rating" class="star-rating">
          <input type="radio" name="rating" id="star5" value="5">
            <label for="star5">&#9733;</label>

            <input type="radio" name="rating" id="star4" value="4">
            <label for="star4">&#9733;</label>

            <input type="radio" name="rating" id="star3" value="3">
            <label for="star3">&#9733;</label>

            <input type="radio" name="rating" id="star2" value="2">
            <label for="star2">&#9733;</label>

            <input type="radio" name="rating" id="star1" value="1">
            <label for="star1">&#9733;</label>

          </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="confirmButton">Oke</button>
      </div>
    </div>
  </div>
</div>
<div class="table-responsive">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0px;">
    <div style="display: flex; align-items: center;" class="col-md-4">
      <div class="btn-entries">
        <button type="button" class="btn btn-primary m-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Jumlah Baris: 15
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item">15</a></li>
          <li><a class="dropdown-item">30</a></li>
          <li><a class="dropdown-item">50</a></li>
          <li><a class="dropdown-item">100</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-2">
      <div class="input-group">
        <input type="text" class="form-control col-2" id="searchInput" placeholder="Cari">
        <button class="btn btn-primary" id="searchButton"> Cari</button>
      </div>
    </div>
  </div>
  <table id="myTable" class="table text-nowrap mb-0 align-middle">
    <thead class="text-dark fs-4">
      <tr>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 class="fw-semibold mb-0"> No</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="id" class="fw-semibold mb-0"> No Pesanan</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="mitra_name" class="fw-semibold mb-0">Nama Toko</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="product_name" class="fw-semibold mb-0">Produk</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="qty" class="fw-semibold mb-0"> Qty</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="price" class="fw-semibold mb-0"> Harga</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="paid_status" class="fw-semibold mb-0"> Status</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="receipt_number" class="fw-semibold mb-0"> Resi</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="action-a" class="fw-semibold mb-0"> Aksi</h6>
        </th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  function showConfirmModal(itemId) {
      // Menampilkan modal konfirmasi
      $('#confirmModal').modal('show');

      // Reset rating form dan sembunyikan rating form
      $('#ratingForm').addClass('d-none');
      $('#rating input[type="radio"]').prop('checked', false); // Reset pilihan rating

      // Ambil data rating untuk item
      $.ajax({
          url: `/history/getRating`,  // Pastikan URL ini sesuai dengan API Anda
          data: { id: itemId },
          method: 'GET',
          success: function(response) {
              if (response.status === 'Diterima') {
                document.getElementById('formConfirmation').style.display = 'none';
                document.getElementById('confirmModalLabel').innerHTML = 'Detil Penilaian';
              } else {
                document.getElementById('formConfirmation').style.display = 'block';
                document.getElementById('confirmModalLabel').innerHTML = 'Konfirmasi Pesanan Diterima';
              }
              if (response.rating) {
                  // Jika sudah ada rating, tampilkan rating yang sudah diberikan
                  $('#ratingForm').removeClass('d-none'); // Tampilkan form rating
                  $(`input[name="rating"][value="${response.rating}"]`).prop('checked', true); // Pilih rating sesuai data
                  $('#rating input[type="radio"]').prop('disabled', true);  // Nonaktifkan bintang agar tidak bisa diubah
              } else {
                  // Jika belum ada rating, tampilkan pilihan rating
                  $('#ratingForm').removeClass('d-none'); // Tampilkan form rating
                  $('#rating input[type="radio"]').prop('disabled', false);  // Aktifkan bintang
              }
          },
          error: function(xhr, status, error) {
              console.error('Gagal mengambil data rating:', error);
              alert('Terjadi kesalahan saat memuat data.');
          }
      });

      // Tombol Batal
      $('#cancelButton').off('click').on('click', function() {
          $('#confirmModal').modal('hide');
      });

      // Tombol Oke
      $('#confirmButton').off('click').on('click', function() {
          var isReceived = $('input[name="receiveProduct"]:checked').val();
          var rating = $('input[name="rating"]:checked').val();  // Ambil rating yang dipilih

          if (isReceived === 'yes' && !rating) {
              alert('Silakan beri rating terlebih dahulu.');
              return;  // Tidak lanjut jika rating tidak dipilih
          }

          $('#confirmModal').modal('hide');

          // Kirim data ke server
          $.ajax({
              url: `/history/processAndRating`,  
              type: 'POST',
              data: {
                  id: itemId,
                  rating: rating  
              },
              success: function(response) {
                  console.log('Tindakan berhasil:', response);
                  alert('Tindakan berhasil!');
                  window.location.href = '<?php echo base_url('history'); ?>';  // Redirect setelah berhasil
              },
              error: function(xhr, status, error) {
                  console.error('Tindakan gagal:', error);
                  alert('Terjadi kesalahan!');
              }
          });
      });

      // Menangani perubahan pilihan radio Ya/Tidak
      $('#yesRadio').on('change', function() {
          $('#ratingForm').removeClass('d-none');  // Tampilkan form penilaian
      });

      $('#noRadio').on('change', function() {
          $('#ratingForm').addClass('d-none');  // Sembunyikan form penilaian
      });
  }

</script>
<script type="module">
  var columnIDs = $('thead h6').map(function() {
    return this.id;
  }).get();

  // Remove the first element from the array
  columnIDs = columnIDs.slice(1);

  var url = 'history/get'

  getDataAndPopulateTable(url, columnIDs);
</script>
<?= $this->endSection() ?>
