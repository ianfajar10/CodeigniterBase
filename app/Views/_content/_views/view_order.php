<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="../assets/css/extend-custom-datatables.min.css" />
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Detail Pesanan</h5>
      </div>
      <div class="modal-body" id="modalContent">
        <!-- Konten dinamis akan muncul di sini -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cancelButton" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0px;">
    <!-- Tombol Pilih Jumlah Baris -->
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
    
    <!-- Tombol Download Data -->
    <div style="display: flex; align-items: center;" class="col-md-4">
      <button type="button" class="btn btn-success m-1" id="downloadButton">
        <i class="ti ti-download"></i>
        Download
      </button>
    </div>

    <!-- Kolom Pencarian -->
    <div class="col-md-2">
      <div class="input-group">
        <input type="text" class="form-control col-2" id="searchInput" placeholder="Cari">
        <button class="btn btn-primary" id="searchButton"> Cari</button>
      </div>
    </div>
  </div>
  
  <!-- Tabel Data -->
  <table id="myTable" class="table text-nowrap mb-0 align-middle">
    <thead class="text-dark fs-4">
      <tr>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 class="fw-semibold mb-0">No</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="id" class="fw-semibold mb-0">No. Pesanan</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="user_name" class="fw-semibold mb-0">Pelanggan</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="product_name" class="fw-semibold mb-0">Nama Produk</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="qty" class="fw-semibold mb-0">Qty</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="price" class="fw-semibold mb-0">Harga</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="paid_status" class="fw-semibold mb-0">Status</h6>
        </th>
        <th class="border-bottom-0" style="text-align: center; vertical-align: middle;">
          <h6 id="action-i" class="fw-semibold mb-0">Aksi</h6>
        </th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<script type="module">
  var columnIDs = $('thead h6').map(function() {
    return this.id;
  }).get();

  // Remove the first element from the array
  columnIDs = columnIDs.slice(1);

  var url = 'order/get'

  getDataAndPopulateTable(url, columnIDs);
</script>
<!-- jQuery (required for Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
  $('#cancelButton').off('click').on('click', function() {
    $('#viewModal').modal('hide'); // Menutup modal yang benar
  });

  function fetchDataAndShowModal(itemId) {
    const modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = '<div class="text-center">Loading...</div>';
    
    $.ajax({
      url: `/order/get`,  
      data: { id: itemId },
      method: 'GET',  
      success: function(response) {
        console.log(response[0]);
        
        modalContent.innerHTML = `
          <h5>No. Pesanan : ${itemId}</h5>
          <p><strong>Nama :</strong> ${response[0].user_name}</p>
          <p><strong>Alamat :</strong> ${response[0].alamat}, ${response[0].kecamatan}, ${response[0].kabupaten}, ${response[0].provinsi}</p>

          <!-- Kolom Input untuk Nomor Resi -->
          <div class="form-group">
            <label for="receipt_number"><strong>Nomor Resi :</strong></label>
            <input type="text" id="receipt_number" name="receipt_number" class="form-control mb-3 mt-3" value="${response[0].receipt_number}">
          </div>
          
          <!-- Tombol untuk kirim Nomor Resi -->
          <button id="sendReceiptBtn" class="btn btn-primary">Kirim Nomor Resi</button>
        `;

        // Menampilkan modal
        $('#viewModal').modal('show');

        // Menangani klik tombol kirim nomor resi
        $('#sendReceiptBtn').on('click', function() {
          var receiptNumber = $('#receipt_number').val();  // Ambil nilai dari inputan nomor resi

          if (receiptNumber.trim() === '') {
            alert('Nomor resi tidak boleh kosong');
            return;
          }

          // Kirim data menggunakan AJAX POST
          $.ajax({
            url: `/order/update`,  // Ganti dengan endpoint yang sesuai
            method: 'POST',
            data: {
              id: itemId,                // Kirim ID item
              receipt_number: receiptNumber // Kirim nomor resi
            },
            success: function(response) {
              alert('Nomor resi berhasil dikirim');
              window.location.href = '<?php echo base_url('order'); ?>';
            },
            error: function(xhr, status, error) {
              alert('Gagal mengirim nomor resi. Coba lagi.');
            }
          });
        });
      },
      error: function(xhr, status, error) {
        modalContent.innerHTML = `<div class="text-danger">Failed to load data. Please try again later.</div>`;
      }
    });

  }

</script>
<?= $this->endSection() ?>
