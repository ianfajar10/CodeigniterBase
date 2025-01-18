<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Checkout form example using Bootstrap 4">
  <link rel="shortcut icon" href="../assets/images/logos/favicon1.ico" type="image/png" />

  <?php if (!empty($products)): ?>
    <title>Checkout <?= $products[0]->name ?></title>
  <?php else: ?>
    <title>Keranjang Belanja</title>
  <?php endif; ?>

  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <style>
    .container {
      max-width: 960px;
    }

    .lh-condensed {
      line-height: 1.25;
    }
  </style>
</head>

<body>
  <?php if (!empty($products)): ?>
    <div class="container">
      <div class="row">
        <!-- Keranjang Belanja -->
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Keranjang Belanja</span>
          </h4>
          <ul class="list-group mb-3 sticky-top">
            <?php foreach ($products as $product): ?>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Nama Produk</h6>
                </div>
                <span class="text-muted"><?= $product->name; ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Harga</h6>
                </div>
                <span class="text-muted">Rp. <?= number_format($product->price, 0, ',', '.'); ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Kuantitas</h6>
                </div>
                <span class="text-muted"><?php echo $qty ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0">Ongkos Kirim (Rp)</h6>
                </div>
                <span id="shippingCost" class="text-muted">Rp 0</span>
              </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
              <div>
                <h6 class="my-0">Total Bayar (Rp)</h6>
              </div>
              <strong id="totalBayar"
                data-totalproduk="<?= number_format(array_reduce($products, function ($sum, $product) use ($qty) {
                                    return $sum + ($product->price * $qty);
                                  }, 0), 0, ',', ''); ?>">Rp. <?= number_format(array_reduce($products, function ($sum, $product) use ($qty) {
                                                                return $sum + ($product->price * $qty);
                                                              }, 0), 0, ',', '.'); ?></strong>
            </li>
          </ul>
        </div>

        <!-- Review Pesanan -->
        <div class="col-md-8 order-md-1">
          <h3 class="mb-3 text-center">Review Pesanan</h3>
          <h5 class="mb-3">Alamat Penerima</h5>
          <form method="POST" action="<?= site_url('/home/processPayment'); ?>">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="orderNo">No. Pesanan</label>
                <input type="text" class="form-control" id="orderNo" required="" readonly>
                <div class="invalid-feedback">Valid No. Pesanan is required.</div>
              </div>
              <div class="row mb-3">
                <?php
                $nameParts = explode(' ', $user['name']);

                $firstName = $nameParts[0];

                $lastName = end($nameParts);
                ?>

                <div class="col-md-6">
                  <label for="firstName">Nama Awal</label>
                  <input type="text" class="form-control" name="firstName" id="firstName" value="<?= htmlspecialchars($firstName); ?>" required="">
                  <div class="invalid-feedback">Nama awal yang benar diperlukan</div>
                </div>

                <div class="col-md-6">
                  <label for="lastName">Nama Akhir</label>
                  <input type="text" class="form-control" name="lastName" id="lastName" value="<?= htmlspecialchars($lastName); ?>" required="">
                  <div class="invalid-feedback">Nama akhir yang benar diperlukan</div>
                </div>

              </div>

            </div>
            <div class="mb-3">
              <label for="phone">Telepon</label>
              <input type="text" class="form-control" name="telepon" id="telepon" value="<?= $user['telepon']; ?>" placeholder="Nomor telepon">
            </div>
            <div class="mb-3">
              <label for="phone">Telepon</label>
              <input type="text" class="form-control" name="email" id="email" value="<?= $user['email']; ?>" placeholder="Nomor telepon">
            </div>

            <!-- Dropdown Provinsi, Kota, dan Kecamatan -->
            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="province">Provinsi</label>
                <select class="custom-select d-block w-100" id="province" required="">
                  <option value="">Pilih Provinsi</option>
                  <?php foreach ($provinces as $province): ?>
                    <option value="<?= $province->province_id; ?>" <?= ($user['provinsi'] == $province->province) ? 'selected' : ''; ?>>
                      <?= $province->province; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Perlu mengisi Provinsi.</div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="city">Kabupaten / Kota</label>
                <select class="custom-select d-block w-100" id="city" required="">
                  <option value="">Pilih Kota</option>
                </select>
                <div class="invalid-feedback">Perlu mengisi Kabupaten / Kota.</div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="district">Kecamatan</label>
                <input type="text" class="form-control" id="district" value="<?= $user['kecamatan']; ?>" placeholder="Kecamatan" required="">
                <div class="invalid-feedback">Perlu mengisi Kecamatan.</div>
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Alamat</label>
              <input type="text" class="form-control" id="address" value="<?= $user['alamat']; ?>" placeholder="Alamat" required="">
              <div class="invalid-feedback">Silahkan masukkan alamat pengiriman Anda dengan lengkap.</div>
            </div>

            <hr class="mb-4" style="border-top: 2px solid #333;">

            <!-- Layanan Pengiriman -->
            <h4 class="mb-3">Layanan Pengiriman</h4>
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="courier">Pilih Kurir</label>
                <select class="custom-select d-block w-100" id="courier" required="true">
                  <option value="">-Pilih Kurir-</option>
                  <option value="jne">JNE</option>
                  <option value="pos">POS Indonesia</option>
                  <option value="tiki">TIKI</option>
                </select>
              </div>
            </div>

            <hr class="mb-4" style="border-top: 2px solid #333;">

            <input type="hidden" class="form-control" name="orderNo" id="orderNo2" required="">
            <input type="hidden" class="form-control" name="total_payment" id="total_payment" value="">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Lanjut Bayar</button>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {


      function generateOrderNo() {
        var date = new Date();
        var year = date.getFullYear();
        var month = ("0" + (date.getMonth() + 1)).slice(-2);
        var day = ("0" + date.getDate()).slice(-2);
        var hours = ("0" + date.getHours()).slice(-2);
        var minutes = ("0" + date.getMinutes()).slice(-2);
        var seconds = ("0" + date.getSeconds()).slice(-2);

        return year + month + day + hours + minutes + seconds;
      }


      $('#orderNo').val(generateOrderNo());
      $('#orderNo2').val(generateOrderNo());


      $('#province').change(function() {
        var provinceId = $(this).val();
        if (provinceId) {
          $.get('<?= base_url('home/getCities') ?>/' + provinceId, function(data) {
            let cities = JSON.parse(data);
            $('#city').empty().append('<option value="">Pilih Kota</option>');
            cities.forEach(function(city) {
              $('#city').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
            });
          });
        }
      });


      $('#courier').change(function() {
        var origin = 151;
        var destination = $('#city').val();
        var weight = 1000;
        var courier = $(this).val();

        if (origin && destination && weight && courier) {
          $.post('<?= base_url('home/calculateShipping') ?>', {
            origin: origin,
            destination: destination,
            weight: weight,
            courier: courier
          }, function(data) {
            let result = JSON.parse(data);
            let cost = result[0].costs[0].cost[0].value;
            updateTotalBayar(cost);
            $('#shippingCost').text('Rp. ' + cost.toLocaleString('id-ID'));
          });
        }

        function updateTotalBayar(cost) {

          var totalProduk = $('#totalBayar').data('totalproduk').toString().replace(/\./g, '').replace(',', '.');


          totalProduk = parseFloat(totalProduk) || 0;

          var totalBayar = totalProduk + cost;

          $('#total_payment').val(totalBayar);
          $('#totalBayar').text('Rp. ' + totalBayar.toLocaleString('id-ID'));
        }

      });
    });
  </script>
</body>

</html>