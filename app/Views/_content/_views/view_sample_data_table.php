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
          <h6 class="fw-semibold mb-0">#</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="column1" class="fw-semibold mb-0">Kolom 1</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="column2" class="fw-semibold mb-0">Kolom 2</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="column3" class="fw-semibold mb-0">Kolom 3</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="column4" class="fw-semibold mb-0">Kolom 4</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="column5" class="fw-semibold mb-0">Kolom 5</h6>
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

  var url = 'samplepage/get_dummy'

  getDataAndPopulateTable(url, columnIDs);
</script>
<?= $this->endSection() ?>
