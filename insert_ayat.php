<!DOCTYPE html>
<html>
  <head>
    <?php include('inc/head.php'); ?>

  </head>
  <body class="skin-blue">
  <!-- wrapper di bawah footer -->
    <div class="wrapper">
      
      <?php include('inc/head2.php'); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include('inc/sidebar.php') ?>
        <!-- /.sidebar -->
      </aside>

           <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <b>PRAPEMROSESAN</b>
        </h1>
          <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol> -->
        </section>

        <!-- Main content -->
        <section class="content">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Chat box -->
            <div class="box">
              <div class="box-header">
                <i class="fa fa-plus"></i>
                <h3 class="box-title">insert terjemahan ayat Al-Qur'an</h3>
              </div>
              <div class="box-body chat" id="chat-box">
                <!-- chat item -->
                <div class="item">
                  <form role="form" action="#" method="POST">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="">Terjemahan Ayat</label>
                        <textarea class="form-control" value="" id="" name="terjemahan_ayat" placeholder="" required></textarea>
                    </div>
                    
                      <button  class="btn btn-primary "><a class="btn btn-primary"  href="preprosesing.php">proses</a></button>
                      
                  </form>
                </div><!-- /.item -->
               
              </div><!-- /.chat -->
            </div><!-- /.box (chat box) -->
          </section><!-- /.Left col -->
            
            
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <!-- <b>Version</b> 2.0 -->
        </div>
        <strong>Pengelompokkan ayat Al-Qur'an dengan K-Means&copy;2018 <a href="#"></a></strong>
      </footer>
    </div><!-- ./wrapper -->
    <?php ('inc/footer.php'); ?>
  </body>
</html>