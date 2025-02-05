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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <?= form_open_multipart(base_url('product/process'), ['id' => 'productForm']); ?>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah <?php echo $title ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-lg-12">
            <div class="mb-4">
              <label for="exampleInputCategoryProduct" class="form-label">Kategori Produk</label>
              <select class="form-control" name="category" id="category">
                <option value="">Pilih Kategori Produk</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <input type="hidden" name="id">
            <div class="row">
              <div class="col-md-6">
                <label>Nama</label>
                <div class="form-group">
                  <input type="text" name="name" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <label>Gambar</label>
                <div class="form-group">
                  <input type="file" name="file_upload" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Harga</label>
                <div class="form-group">
                  <input name="price" class="form-control numberformat">
                </div>
              </div>
              <div class="col-md-6">
                <label>Stok</label>
                <div class="form-group">
                  <input type="number" name="stock" class="form-control numberformat">
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
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary btn_save">Simpan</button> <!-- Use native button for submit -->
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
          <h6 class="fw-semibold mb-0"> No</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="name" class="fw-semibold mb-0">Nama</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="file" class="fw-semibold mb-0">Gambar</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="price" class="fw-semibold mb-0">Harga</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="stock" class="fw-semibold mb-0"> Stok</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="description" class="fw-semibold mb-0"> Deskripsi</h6>
        </th>
        <th class="border-bottom-0">
          <h6 id="action-du" class="fw-semibold mb-0"> Aksi</h6>
        </th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); 
      
      var itemData;
      try {
        var dataItem = button.data('item'); 
        
        if (dataItem) {
          itemData = JSON.parse(decodeURIComponent(dataItem)); 
        } else {
        }
      } catch (error) {
        console.error("Error parsing data-item:", error);
        itemData = null; 
      }

      if (itemData) {
        var modal = $(this);
        
        modal.find('textarea[name="description"]').val(itemData.description); 
        modal.find('input[name="price"]').val(itemData.price); 
        modal.find('input[name="stock"]').val(itemData.stock); 
        modal.find('input[name="name"]').val(itemData.name); 
        modal.find('input[name="id"]').val(itemData.id); 
        modal.find('select[name="category"]').val(itemData.category); 
      } else {
        console.log("Data tidak valid atau tidak tersedia.");
      }
    });

    $('.btn_save').click(function(e) {
      e.preventDefault();
      
      var category = $('#category').val().trim();
      var name = $('input[name="name"]').val().trim();
      var price = $('input[name="price"]').val().trim();
      var stock = $('input[name="stock"]').val().trim();
      var description = $('textarea[name="description"]').val().trim();
      var fileUpload = $('input[name="file_upload"]').val().trim();
      
      if (category === '') {
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Kategori Produk tidak boleh kosong!',
              timerProgressBar: true,
              confirmButtonColor: '#5D87FF',
          });
      } else if (name === '') {
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Nama produk tidak boleh kosong!',
              timerProgressBar: true,
              confirmButtonColor: '#5D87FF',
          });
      } else if (price === '') {
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Harga produk tidak boleh kosong!',
              timerProgressBar: true,
              confirmButtonColor: '#5D87FF',
          });
      } else if (stock === '') {
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Stok produk tidak boleh kosong!',
              timerProgressBar: true,
              confirmButtonColor: '#5D87FF',
          });
      } else if (description === '') {
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Deskripsi produk tidak boleh kosong!',
              timerProgressBar: true,
              confirmButtonColor: '#5D87FF',
          });
      } else if (fileUpload === '') {
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Gambar produk tidak boleh kosong!',
              timerProgressBar: true,
              confirmButtonColor: '#5D87FF',
          });
      } else {
          $('#productForm').submit();
      }
  });
  });
</script>
<script type="module">
  var columnIDs = $('thead h6').map(function() {
    return this.id;
  }).get();

  // Remove the first element from the array
  columnIDs = columnIDs.slice(1);

  var url = 'product/get'

  getDataAndPopulateTable(url, columnIDs);
</script>
<?= $this->endSection() ?>