
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

   

      <!-- Content Header (Page header) -->

     <section class="content-header">
      <h1>
      <b>DATA TRAINING</b>
      </h1>
      <section class="content">
      
      <div class="row">
      
      <div class="col-md-12">
      <div class="box">
      
                <div class="box-title">
                  
                
                <div class="box-body">
                 <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>term</th>
                    <th>Count</th>
                    <th>Bobot</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      include("koneksi.php");
                      $query=mysql_query("select * from q_index") or die(mysql_error());
                      while($row=mysql_fetch_array($query))
                      {
                      ?>
                    <tr>
                      <td><?php echo $row['Id']; ?></td>
                      <td><?php echo $row['Term']; ?></td>
                      <td><?php echo $row['Count']; ?></td>
                      <td><?php echo $row['Weight']; ?></td>
                      
                    </tr>

                 <?php } ?>
                 </tbody>

                 </table>
                 <div class="row">
              <div class="col-md-4">
              <a href="proses.php" class="btn btn-success" type="button" id="btn-add">Back</a>
              </div>
               </div>
                 </div>
                 </div>
                 </div>
                 </div>
                 </section>
                 </div>
                 </div>
                 <footer class="main-class">
                 <div class="pull-right hidden-xs">
                 </div>
                 <Strong>Pengelompokkan K-Means</Strong>
                 </footer>

                 <?php include('inc/footer.php'); ?>

    <script src="assets/dist/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="assets/dist/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false


        });
      });
            //waktu flash data :v
      $(function(){
      $('#pesan-flash').delay(4000).fadeOut();
      $('#pesan-error-flash').delay(5000).fadeOut();
      });
    </script>
                 </body>
                 </html>