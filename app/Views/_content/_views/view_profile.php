<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="../assets/css/custom-page-profile.min.css" />
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <?= form_open_multipart(base_url('auth/update'), ['id' => 'profileForm']); ?>
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ubah Profil</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="pl-lg-4">
                  <div class="row">
                      <input type="hidden" id="username_edit" class="form-control form-control-alternative" placeholder="Username" name="username_edit" value="lucky.jesse">
                      <input type="hidden" id="role_edit" class="form-control form-control-alternative" placeholder="Role" name="role_edit">
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label class="form-control-label" for="email_edit">Email</label>
                              <input type="email" id="email_edit" class="form-control form-control-alternative" placeholder="jesse@example.com" name="email_edit" value="jesse@example.com">
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="row mitra_name_edit">
                      <div class="col-lg-6">
                          <div class="form-group focused">
                              <label class="form-control-label label_mitra_name_edit" for="name_edit">Nama Toko</label>
                              <input type="text" id="name_edit" class="form-control form-control-alternative" placeholder="Nama Toko" name="name_edit" value="Lucky">
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group focused">
                              <label class="form-control-label" for="telp_edit">Telepon</label>
                              <input type="text" id="telp_edit" class="form-control form-control-alternative" placeholder="Telepon" name="telp_edit" value="123456789">
                          </div>
                      </div>
                  </div>
              </div>
              <hr class="my-4 contact_information_edit">
              <h6 class="heading-small text-muted mb-4 contact_information_edit">Informasi Kontak</h6>
              <div class="pl-lg-4 contact_information_edit">
                  <div class="row bank_information_edit">
                      <div class="col-lg-4">
                          <div class="form-group focused">
                              <label class="form-control-label" for="bank_edit">Nama Bank</label>
                              <input type="text" id="bank_edit" class="form-control form-control-alternative" placeholder="Nama Bank" name="bank_edit" value="Bank ABC">
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group focused">
                              <label class="form-control-label" for="rekening_edit">Nomor Rekening</label>
                              <input type="text" id="rekening_edit" class="form-control form-control-alternative" placeholder="Nomor Rekening" name="rekening_edit" value="1234567890">
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group focused">
                              <label class="form-control-label" for="rekening_name_edit">Nama Rekening</label>
                              <input type="text" id="rekening_name_edit" class="form-control form-control-alternative" placeholder="Nama Rekening" name="rekening_name_edit" value="Lucky">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-4">
                          <div class="form-group focused">
                              <label class="form-control-label" for="provinsi_edit">Provinsi</label>
                              <input type="text" id="provinsi_edit" class="form-control form-control-alternative" placeholder="Provinsi" name="provinsi_edit" value="Jawa Barat" disabled>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group focused">
                              <label class="form-control-label" for="kabupaten_edit">Kabupaten / Kota</label>
                              <input type="text" id="kabupaten_edit" class="form-control form-control-alternative" placeholder="Kabupaten / Kota" name="kabupaten_edit" value="Bandung" disabled>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group focused">
                              <label class="form-control-label" for="kecamatan_edit">Kecamatan</label>
                              <input type="text" id="kecamatan_edit" class="form-control form-control-alternative" placeholder="Kecamatan" name="kecamatan_edit" value="Cibeunying" disabled>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group focused">
                              <label class="form-control-label" for="alamat_edit">Alamat</label>
                              <input id="alamat_edit" class="form-control form-control-alternative" placeholder="Alamat Lengkap" name="alamat_edit" value="Jl. ABC No. 123, Bandung" type="text" disabled>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          <?= form_close(); ?>

        </div>
    </div>
</div>
<div>
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div>
        <form>
          <h6 class="heading-small text-muted mb-4">Identitas</h6>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary m-1 btn_change" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="ti ti-plus"></i> Ubah
            </button>
          </div>
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
            <div class="row mitra_name">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label label_mitra_name" for="name">Nama Toko</label>
                  <input type="text" id="name" class="form-control form-control-alternative" placeholder="First name" value="Lucky">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="telp">Telepon</label>
                  <input type="text" id="telp" class="form-control form-control-alternative" placeholder="telp" value="Lucky">
                </div>
              </div>
            </div>
          </div>
          <hr class="my-4 contact_information">
          <!-- Address -->
          <h6 class="heading-small text-muted mb-4 contact_information">Informasi Kontak</h6>
          <div class="pl-lg-4 contact_information">
            <div class="row bank_information">
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
          <hr class="my-4 contact_information">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    if ($app.user.role == 1 || $app.user.role == '1') {
      $('.mitra_name').hide();
      $('.contact_information').hide();
      $('.contact_information_edit').hide();
      $('.bank_information_edit').hide();
      $('.mitra_name_edit').hide();
      $('.btn_change').hide();
    } else if ($app.user.role == 3 || $app.user.role == '3') {
      $('.label_mitra_name').text('Nama Lengkap');
      $('.label_mitra_name_edit').text('Nama Lengkap');
      $('.bank_information').hide();
      $('.bank_information_edit').hide();
    }
    
    let role = $app.user.role
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
    let telp = $app.user.telepon

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
    $('#telp').val(telp);

    $('#name_edit').val(name);
    $('#username_edit').val(username);
    $('#email_edit').val(email);
    $('#bank_edit').val(bank);
    $('#rekening_edit').val(rekening);
    $('#rekening_name_edit').val(rekening_name);
    $('#provinsi_edit').val(provinsi);
    $('#kabupaten_edit').val(kabupaten);
    $('#kecamatan_edit').val(kecamatan);
    $('#alamat_edit').val(alamat);
    $('#telp_edit').val(telp);
    $('#role_edit').val(role);

  });
</script>

<?= $this->endSection() ?>