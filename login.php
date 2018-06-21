<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Halaman Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <!-- Bootstrap 3.3.2 -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="assets/dist/css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <!-- <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    <!-- Theme style -->
    <link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" /
        <!-- Theme style -->
    

  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>LOGIN ADMIN</b>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <!-- <span><?php echo $id_user; ?></span> -->
        

        <form action="proses_login.php" id="form-login" method="post" accept-charset="utf-8">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" value="" name="password" id="password" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <div class="col-xs-4">
              <input type="submit" name="login" value="Login" id="submit-login" class="btn btn-primary btn-block btn-flat" />
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    </body>
    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    

  
</html>