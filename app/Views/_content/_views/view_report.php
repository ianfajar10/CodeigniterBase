<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="../assets/css/extend-custom-datatables.min.css" />
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
    <!-- Tombol Download Data -->
    <div style="display: flex; align-items: center;" class="col-md-4">
      <button type="button" class="btn btn-success m-1" id="downloadButton">
        Download Data
      </button>
    </div>
    <div class="col-md-2">
      <div class="input-group">
        <input type="text" class="form-control col-2" id="searchInput" placeholder="Cari">
        <button class="btn btn-primary" id="searchButton">Cari</button>
      </div>
    </div>
  </div>
  <table id="myTable" class="table text-nowrap mb-0 align-middle">
    <thead class="text-dark fs-4">
      <tr>
        <th class="border-bottom-0">
          <h6 class="fw-semibold mb-0">No</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="name" class="fw-semibold mb-0">Nama Mitra</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="email" class="fw-semibold mb-0">Email</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="telepon" class="fw-semibold mb-0">Telepon</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="provinsi" class="fw-semibold mb-0">Provinsi</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="total_products_sold" class="fw-semibold mb-0">Produk Terjual</h6>
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

  var url = 'report/get'

  getDataAndPopulateTable(url, columnIDs);
</script>
<?= $this->endSection() ?>
