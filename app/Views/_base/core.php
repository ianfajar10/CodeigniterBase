<?php $session = session() ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Milestone Coffee -
    <?= $title ?>
  </title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.ico" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/css/custom-datatables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?= $this->include('_base/_part/part_sidebar') ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?= $this->include('_base/_part/part_header') ?>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <?= $this->include('_base/_part/part_title') ?>
                <div style="text-align: justify;" class="p-1">
                  <?= $this->renderSection('content') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?= $this->include('_base/_part/part_footer') ?>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/user.js"></script>
  <script src="../assets/js/datatables.js"></script>
</body>

</html>
