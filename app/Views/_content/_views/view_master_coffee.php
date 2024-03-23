<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="../assets/css/extend-custom-datatables.min.css" />
<div class="table-responsive">
  <!-- Success Upload -->
  <?php if (!empty(session()->getFlashdata('berhasil'))) { ?>
    <div class="alert alert-success">
      <?php echo session()->getFlashdata('berhasil'); ?>
    </div>
  <?php } ?>

  <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
    <div class="alert alert-danger">
      <?php echo session()->getFlashdata('gagal'); ?>
    </div>
  <?php } ?>

  <?php
  $errors = $validation->getErrors();
  if (!empty($errors)) {
    echo $validation->listErrors('list');
  }
  ?>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="ti ti-plus"></i> Tambah
  </button>

  <div class="modal fade" id="modalTableD" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body text-center">
          <p>Anda yakin untuk menghapus data ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deleteKatalog()">Ya</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <?= form_open_multipart(base_url('mastercoffee/process')); ?>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $title ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-md-4">
                <label>Nama</label>
                <div class="form-group">
                  <input type="text" name="name" class="form-control">
                </div>
              </div>
              <div class="col-md-5">
                <label>Foto</label>
                <div class="form-group">
                  <input type="file" id="file_upload" name="file_upload" multiple="" accept=".jpg,.jpeg,.png">
                </div>
              </div>
              <div class="col-md-3">
                <label>Harga</label>
                <div class="form-group">
                  <input name="price" class="form-control numberformat">
                </div>
              </div>
            </div>
            <div class="row mt-4 mb-4">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <label>Jenis</label>
                  </div>
                  <div class="col-md-8">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="typeMenu" id="inlineRadio1" value="F">
                      <label class="form-check-label" for="inlineRadio1">Makanan</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="typeMenu" id="inlineRadio2" value="D">
                      <label class="form-check-label" for="inlineRadio2">Minuman</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="typeMenu" id="inlineRadio3" value="O">
                      <label class="form-check-label" for="inlineRadio3">Lainnya</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-12">
                <label>Deskripsi</label>
                <div class="form-group">
                  <textarea type="text" name="description" class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <?= form_submit('submit', 'Simpan', 'class="btn btn-primary"') ?>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
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
          <h6 id="name" class="fw-semibold mb-0">Nama</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="description" class="fw-semibold mb-0">Deskripsi</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="file" class="fw-semibold mb-0">Gambar</h6>
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

  columnIDs = columnIDs.slice(1);

  var url = 'mastercoffee/get_crud'

  var action = 'D'

  getDataAndPopulateTable(url, columnIDs, action);
</script>
<script>
  function deleteKatalog() {
    var id = $('#idx').val();

    const formData = {
      id: id,
    };

    $.ajax({
      url: 'filelist/drop', // Ganti dengan URL endpoint Anda
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
          const deleteKatalogModal = new bootstrap.Modal(document.getElementById('modalTableD'));
          deleteKatalogModal.hide();

          window.location.href = '<?= base_url('master-coffee') ?>';
        });
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }
</script>
<?= $this->endSection() ?>