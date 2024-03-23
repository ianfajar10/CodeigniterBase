<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="../assets/css/extend-custom-datatables.min.css" />
<style>
    .modal-dialog {
        top: 35%;
        transform: translateY(-35%);
    }

    .large-id {
        font-size: 75px;
        font-weight: bold;
        color: #4f73d9;
    }
</style>
<div class="modal fade" id="modalTableS" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-left">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTableM" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                    <h6 id="action" class="fw-semibold mb-0">Aksi</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 id="table" class="fw-semibold mb-0">Meja</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 id="status" class="fw-semibold mb-0">Status</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 id="total_amount" class="fw-semibold mb-0">Total</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 id="updated_at" class="fw-semibold mb-0">Waktu</h6>
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

    var url = 'history/get_list_table'

    var action = 'SM'

    getDataAndPopulateTable(url, columnIDs, action);
</script>
<?= $this->endSection() ?>