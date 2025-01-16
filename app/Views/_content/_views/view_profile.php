<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="../assets/css/custom-page-profile.min.css" />
<div>
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div>
        <form>
          <h6 class="heading-small text-muted mb-4">Identitas</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="username">Username</label>
                  <input type="text" id="username" class="form-control form-control-alternative" placeholder="Username" value="lucky.jesse">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="email">Email</label>
                  <input type="email" id="email" class="form-control form-control-alternative" placeholder="jesse@example.com">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group focused">
                  <label class="form-control-label" for="name">Nama Toko</label>
                  <input type="text" id="name" class="form-control form-control-alternative" placeholder="First name" value="Lucky">
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">
          <!-- Address -->
          <h6 class="heading-small text-muted mb-4">Informasi Kontak</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="bank">Nama Bank</label>
                  <input type="text" id="bank" class="form-control form-control-alternative" placeholder="Country" value="-- Pilih Salah Satu --">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="rekening">Nomor Rekening</label>
                  <input type="text" id="rekening" class="form-control form-control-alternative" placeholder="Country" value="-- Pilih Salah Satu --">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="rekening_name">Nama Rekening</label>
                  <input type="text" id="rekening_name" class="form-control form-control-alternative" placeholder="Postal code" value="-- Pilih Salah Satu --">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="provinsi">Provinsi</label>
                  <input type="text" id="provinsi" class="form-control form-control-alternative" placeholder="City" value="-- Pilih Salah Satu --">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="kabupaten">Kabupaten / Kota</label>
                  <input type="text" id="kabupaten" class="form-control form-control-alternative" placeholder="Country" value="-- Pilih Salah Satu --">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group focused">
                  <label class="form-control-label" for="kecamatan">Kecamatan</label>
                  <input type="text" id="kecamatan" class="form-control form-control-alternative" placeholder="Country" value="-- Pilih Salah Satu --">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group focused">
                  <label class="form-control-label" for="alamat">Alamat</label>
                  <input id="alamat" class="form-control form-control-alternative" placeholder="Home Address" value="Harap masukkan nama jalan, nomor rumah, dan kode pos dengan lengkap !" type="text">
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    let name = $app.user.name
    let username = $app.user.username
    let email = $app.user.email
    let bank = $app.user.bank
    let rekening = $app.user.rekening
    let rekening_name = $app.user.rekening_name
    let provinsi = $app.user.provinsi
    let kabupaten = $app.user.kabupaten
    let kecamatan = $app.user.kecamatan
    let alamat = $app.user.alamat

    $('#name').val(name);
    $('#username').val(username);
    $('#email').val(email);
    $('#bank').val(bank);
    $('#rekening').val(rekening);
    $('#rekening_name').val(rekening_name);
    $('#provinsi').val(provinsi);
    $('#kabupaten').val(kabupaten);
    $('#kecamatan').val(kecamatan);
    $('#alamat').val(alamat);
    console.log(name);
  });
</script>

<?= $this->endSection() ?>