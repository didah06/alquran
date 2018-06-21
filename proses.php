<?php
include "koneksi.php";
?>


<!DOCTYPE html>
<html>
<head>
  <link href="assets/dist/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/stylesheet.css" rel="stylesheet" type="text/css" />
  
  <?php include('inc/head.php'); ?>
  
</head>
<body class="skin-blue">
  <!-- wrapper di bawah footer -->
  <div class="wrapper">

    <?php include('inc/head2.php'); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <?php include('inc/sidebar.php'); ?>
      <!-- /.sidebar -->
    </aside>


  <div class="content-wrapper">
    <section class="content">
      <div class="row" id="content-customer">
        <div class="col-md-8 col-xs-8" id="content-customer-body">
          <div class="box">
              
              <!-- /.box-header -->
              <div class="box-body">

                   <!-- Form Input Data-->
                    <form action="proses_teks.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                      <i class="fa fa-plus"></i>
                        <label>terjemahan ayat:</label>
                        <textarea class="form-control" rows="15" name="isi"></textarea>
                      </div>
                      <input type="hidden" name="query" value="q"></input>
                      <button name="submit" type="submit" class="btn btn-warning" value="Tambah">Preprocessing</button>
                    </form>
                    <!-- Akhir Form Input Data-->
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <ul class="pagination pagination-xs no-margin pull-right">
                </ul>
              </div>
            </div>    
        </div>
      </div>
    </section>
    
  <section class="content">
    <div class="row" id="content-customer">
      <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-file"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">&nbsp;</span>
              <a style="color: black" href="case_folding.php">
              <span class="info-box-number">
                case folding
              </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">&nbsp;</span>
              <a style="color: black" href="token.php">
              <span class="info-box-number">
                tokenisasi
              </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-file"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">&nbsp;</span>
              <a style="color: black" href="filtering.php">
              <span class="info-box-number">
                filtering
              </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">&nbsp;</span>
              <a style="color: black" href="hasil_stem.php">
              <span class="info-box-number">
                stemming
              </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-file"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">&nbsp;</span>
              <a style="color: black" href="pembobotan.php">
              <span class="info-box-number">
                pembobotan
              </span>
              </a>
            </div>
          </div>
        </div>
        </div>
        </div>
        </section>
  </div>
  <!-- Akhir dari Konten-->


  <!-- Awal dari Footer -->
   <?php
    include ('inc/footer.php');
  ?>
  <!-- Akhir dari Footer -->

<!-- jQuery 2.2.3 -->
<script src="assets/js/jquery.js"></script>

<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="assets/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#table-customer").DataTable();

  });
</script>

</body>
</html>

