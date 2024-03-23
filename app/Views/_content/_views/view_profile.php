<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 800px;
    margin: 20px auto;
    text-align: center;
  }

  .profile {
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
  }

  .profile img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin-bottom: 20px;
  }

  .profile h1 {
    margin-bottom: 10px;
  }

  .profile p {
    margin: 5px 0;
  }
</style>
<div>
  <span>
    <div class="container">
      <div class="profile">
        <h2 id="profile_name">
          </h1>
          <p id="profile_username">Email: example@example.com</p>
          <p id="profile_email">Alamat: Jalan Contoh No. 123</p>
          <p id="profile_reg_date">Telepon: 081234567890</p>
      </div>
    </div>
  </span>
</div>

<script>
  $(document).ready(function() {
    document.getElementById("profile_name").innerHTML = $app.user.name;
    document.getElementById("profile_username").innerHTML = 'Username: ' + $app.user.username;
    document.getElementById("profile_email").innerHTML = 'Email: ' + $app.user.email;
    document.getElementById("profile_reg_date").innerHTML = 'Tanggal Daftar: ' + $app.user.created_at;
  });
</script>

<?= $this->endSection() ?>