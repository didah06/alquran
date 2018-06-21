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
<?php include "koneksi.php"; ?>
     <section class="content-header">
      <h1>
      <b>DATA AL-QUR'AN</b>
      </h1>
      <section class="content">
<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
<tr>
<td colspan="5">
<form method="post" action="">
<select name="SuraID">
<option value="" disabled="disabled">Pilih Surah</option>
 
 <?php
 $a="SELECT * FROM daftar_surat";
 $sql=mysql_query($a);
 while($data=mysql_fetch_array($sql)){
 ?>
 <option value="<?php echo $data['SuraID']?>"><?php echo $data['nama_surat']?></option>
 <?php
 }
 ?>
 </select>
 <input type="submit" value="cari"/>
 </form>
 </td>
 </tr>
 </table>
 <div class="box-body">
  <table id="example1" class="table table-bordered table-striped">
  <thead>
 <tr>
 <td style="border: none;padding: 4px;"><b>ID</b></td>
 <td style="border: none;padding: 4px;"><b>Terjemahan_ayat</b></td>
 <td style="border: none;padding: 4px;"><b>SuraID</b></td>
 <td style="border: none;padding: 4px;"><b>No Ayat</b></td>
 </tr>
 </thead>
 <tbody>
 <?php
 if(isset($_POST['SuraID'])){
 $sql = "SELECT * from dokumen WHERE SuraID = ".$_POST['SuraID'];
 $q = mysql_query($sql);
 while($data = mysql_fetch_array($q)){
 ?>
 <tr>
 <td style="border: none;padding: 4px;"><?php echo $data['id'];?></td>
 <td style="border: none;padding: 4px;"><?php echo $data['terjemahan_ayat'];?></td>
 <td style="border: none;padding: 4px;"><?php echo $data['SuraID'];?></td>
 <td style="border: none;padding: 4px;"><?php echo $data['no_ayat'];?></td>
 </tr>
 <?php
 }
 }
 ?>
 </tbody>
 </table>
 </div>
 </section>
 </section>
 </div>
 </div>
 <footer class="main-class">
                 <div class="pull-right hidden-xs">
                 </div>
                 <Strong>Pengelompokkan K-Means</Strong>
                 </footer>
                 <?php include ('inc/footer'); ?>
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

 